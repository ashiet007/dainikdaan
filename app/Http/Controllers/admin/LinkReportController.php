<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\UserDetail;
use App\GiveHelp;
use App\GetHelp;
use App\UserPreStatus;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
class LinkReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function accptedLink()
    {
        $perPage = 100;
        $accptedLinks = GiveHelp::with(['user','getHelps.user','getHelps'=> function($query)
                                      {
                                          $query->where('give_get_helps.status', '=', 'accepted');
                                      }
                                 ])
                                 ->where(function ($query) {
                                      $query->where('completion_state', 'partially-assigned')
                                            ->orWhere('completion_state', 'assigned');
                                  })
                                 ->orderBy('updated_at','DESC')
                                ->paginate($perPage);    
      return view('admin.link-reports.accepted',compact('accptedLinks'));
    }
    
    public function rejectedLink(Request $request)
    {
        $username = User::pluck('user_name','id')->toArray();
        $requestData = $request->all();
        $perPage = 100;
        if(!empty($requestData))
        {
            $id = $request->user_id;
            $rejectedLinks = GiveHelp::with(['user','getHelps.user','getHelps'=> function($query)
                                      {
                                          $query->where('give_get_helps.status', '=', 'rejected');
                                      }
                                 ])
                                 ->where(function ($query) {
                                      $query->where('completion_state', 'partially-assigned')
                                            ->orWhere('completion_state', 'assigned');
                                  })
                                 ->where('status', '=', 'rejected')
                                 ->where('user_id', $id)
                                 ->orderBy('updated_at','DESC')
                                ->paginate($perPage);    
            return view('admin.link-reports.rejected',compact('rejectedLinks','username'));
        }
        else
        {
            $rejectedLinks = GiveHelp::with(['user','getHelps.user','getHelps'=> function($query)
                                      {
                                          $query->where('give_get_helps.status', '=', 'rejected');
                                      }
                                 ])
                                 ->where(function ($query) {
                                      $query->where('completion_state', 'partially-assigned')
                                            ->orWhere('completion_state', 'assigned');
                                  })
                                 ->where('status', '=', 'rejected')
                                 ->orderBy('updated_at','DESC')
                                ->paginate($perPage);    
            return view('admin.link-reports.rejected',compact('rejectedLinks','username'));
        }
        
    }
    public function pendingLink()
    {
        $perPage = 100;
        $pendingLinks = GiveHelp::with(['user','getHelps.user','getHelps'=> function($query)
                                      {
                                          $query->where('give_get_helps.status', '=', 'pending');
                                      }
                                 ])
                                 ->where(function ($query) {
                                      $query->where('completion_state', 'partially-assigned')
                                            ->orWhere('completion_state', 'assigned');
                                  })
                                ->where('status', 'pending')
                                ->orderBy('updated_at','DESC')
                                ->paginate($perPage);    
        return view('admin.link-reports.pending',compact('pendingLinks'));
    }

    public function resendRejectedLink(Request $request)
    {
        $requestData = $request->all();
        if(!empty($requestData))
        {
            $getHelpId = $requestData['get_help_id'];
            $giveHelp = GiveHelp::with(['getHelps' => function($query) use($getHelpId)
                                  {
                                      $query->where('give_get_helps.get_help_id', '=', $getHelpId);
                                  }
                              ])
                            ->findOrFail($requestData['give_help_id']);
            $amt = $requestData['amount'];
            $balance = $giveHelp->balance + $amt;
            $user_id = $giveHelp->user_id;
            if($giveHelp->amount == $balance)
            {
                $giveHelp->update([
                          'completion_state' => 'none',
                          'balance' => $balance,
                          'status' => 'pending'
                         ]);
            }
            elseif($giveHelp->amount > $balance)
            {
                $giveHelp->update([
                          'completion_state' => 'partially-assigned',
                          'balance' => $balance,
                          'status' => 'pending'
                         ]);
            }
            $user = User::findOrFail($user_id);
            if($user->status == 'rejected')
            {
                $userPreStatus = UserPreStatus::where('user_id',$user_id)->first();
                if($userPreStatus)
                {
                    $user->update([
                        'status' => $userPreStatus->status
                    ]);
                }
                else
                {
                    $user->update([
                        'status' => 'pending'
                    ]);
                }
            }
            
          return redirect()->route('linkReport.rejectedLink')->with('flash_message','Link has been sent');
        }
    }

    public function deleteLink(Request $request)
    {
        $requestData = $request->all();
        if(!empty($requestData))
        {
            $getHelpId = $requestData['get_help_id'];
            $giveHelp = GiveHelp::with(['getHelps' => function($query) use($getHelpId)
                                  {
                                      $query->where('give_get_helps.get_help_id', '=', $getHelpId);
                                  }
                              ])
                            ->findOrFail($requestData['give_help_id']);
            $amt = $requestData['amount'];
            $balance = $giveHelp->balance + $amt;
            if($giveHelp->amount == $balance)
            {
                $giveHelp->update([
                          'completion_state' => 'none',
                          'balance' => $balance,
                         ]);
            }
            elseif($giveHelp->amount > $balance)
            {
                $giveHelp->update([
                          'completion_state' => 'partially-assigned',
                          'balance' => $balance,
                         ]);
            }
            $getHelp = GetHelp::findOrFail($getHelpId);
            $balance = $getHelp->balance + $amt;
            if($getHelp->amount == $balance)
            {
                $getHelp->update([
                          'completion_state' => 'none',
                          'balance' => $balance,
                         ]);
            }
            elseif($getHelp->amount > $balance)
            {
                $getHelp->update([
                          'completion_state' => 'partially-assigned',
                          'balance' => $balance,
                         ]);
            }
            $giveHelp->getHelps()->detach($getHelpId);
            return redirect()->back()->with('flash_message','help has been deleted');
        }
    }

    public function sendersList()
    {
        $users = GiveHelp::with('user')
            ->where('completion_state','none')
            ->where('status','pending')
            ->orderBy('match_order_date','DESC')
            ->get();
        return view('admin.link-reports.senders',compact('users'));
    }

    public function receiverList()
    {
        $users = GetHelp::with('user')
            ->where('completion_state','none')
            ->where('status','pending')
            ->orderBy('match_order_date','DESC')
            ->get();
        return view('admin.link-reports.receiver',compact('users'));
    }

    public function changeOrder(Request $request)
    {
        $requestData = $request->all();
        $timestamp = strftime('%Y-%m-%d %H:%M:%S', strtotime($requestData['match_order_date']));
        $requestData['match_order_date'] = $timestamp;
        $getHelp = GetHelp::where('id',$requestData['getHelpId'])->firstOrFail();
        $getHelp->update([
           'match_order_date'=> $requestData['match_order_date']
        ]);
        return redirect()->back()->with('flash_message','Order Updated Successfully');
    }

    public function changeOrderGive(Request $request)
    {
        $requestData = $request->all();
        $timestamp = strftime('%Y-%m-%d %H:%M:%S', strtotime($requestData['match_order_date']));
        $requestData['match_order_date'] = $timestamp;
        $giveHelp = GiveHelp::where('id',$requestData['giveHelpId'])->firstOrFail();
        $giveHelp->update([
            'match_order_date'=> $requestData['match_order_date']
        ]);
        return redirect()->back()->with('flash_message','Order Updated Successfully');
    }
}