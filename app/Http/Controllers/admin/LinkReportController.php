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
        $giveHelp = new GiveHelp;
        $acceptedLinks = $giveHelp->getAcceptedLinks();
        $acceptedData = array();
        foreach($acceptedLinks as $acceptedLink)
        {
            if(!$acceptedLink->getHelps->isEmpty())
            {
                foreach ($acceptedLink->getHelps as $getHelp)
                {
                    $data['user_name'] = $acceptedLink->user->user_name;
                    $data['name'] = $acceptedLink->user->name;
                    $data['amount'] = $getHelp->pivot->assigned_amount;
                    $data['rc_user_name'] = $getHelp->user->user_name;
                    $data['rc_name'] = $getHelp->user->name;
                    $data['created_date'] = $getHelp->pivot->updated_at->format('d, M Y h:i:s A');
                    $acceptedData[] = $data;
                }
            }
        }
        return view('admin.link-reports.accepted',compact('acceptedData'));
    }
    
    public function rejectedLink(Request $request)
    {
        $username = User::pluck('user_name','id')->toArray();
        $requestData = $request->all();
        $giveHelp = new GiveHelp;
        if(!empty($requestData))
        {
            $id = $request->user_id;
            $rejectedLinks = $giveHelp->getRejectedLinks($id);
        }
        else
        {
            $rejectedLinks = $giveHelp->getRejectedLinks();
        }
        $rejectedData = array();
        foreach($rejectedLinks as $rejectedLink)
        {
            if(!$rejectedLink->getHelps->isEmpty())
            {
                foreach ($rejectedLink->getHelps as $getHelp)
                {
                    $data['id'] = $rejectedLink->id;
                    $data['get_help_id'] = $getHelp->id;
                    $data['user_name'] = $rejectedLink->user->user_name;
                    $data['name'] = $rejectedLink->user->name;
                    $data['amount'] = $getHelp->pivot->assigned_amount;
                    $data['rc_user_name'] = $getHelp->user->user_name;
                    $data['rc_name'] = $getHelp->user->name;
                    $data['created_date'] = $getHelp->pivot->updated_at->format('d, M Y h:i:s A');
                    $rejectedData[] = $data;
                }
            }
        }
        return view('admin.link-reports.rejected',compact('rejectedData','username'));
        
    }
    public function pendingLink()
    {
        $giveHelp = new GiveHelp;
        $pendingLinks = $giveHelp->getPendingLinks();
        $pendingData = array();
        foreach($pendingLinks as $pendingLink)
        {
            if(!$pendingLink->getHelps->isEmpty())
            {
                foreach ($pendingLink->getHelps as $getHelp)
                {
                    $data['user_name'] = $pendingLink->user->user_name;
                    $data['name'] = $pendingLink->user->name;
                    $data['amount'] = $getHelp->pivot->assigned_amount;
                    $data['rc_user_name'] = $getHelp->user->user_name;
                    $data['rc_name'] = $getHelp->user->name;
                    $data['created_date'] = $getHelp->pivot->created_at->format('d, M Y h:i:s A');
                    $pendingData[] = $data;
                }
            }
        }
        return view('admin.link-reports.pending',compact('pendingData'));
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
          alert()->success('Link has been sent', 'Success')->persistent("Close");
          return redirect()->route('linkReport.rejectedLink');
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
            alert()->success('Help has been deleted', 'Success')->persistent("Close");
            return redirect()->back();
        }
    }

    public function sendersList()
    {
        $users = GiveHelp::with('user')
            ->notAssigned()
            ->pending()
            ->orderBy('match_order_date','DESC')
            ->get();
        return view('admin.link-reports.senders',compact('users'));
    }

    public function receiverList()
    {
        $users = GetHelp::with('user')
            ->notAssigned()
            ->pending()
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
        alert()->success('Order Updated Successfully', 'Success')->persistent("Close");
        return redirect()->back();
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
        alert()->success('Order Updated Successfully', 'Success')->persistent("Close");
        return redirect()->back();
    }

}