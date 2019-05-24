<?php

namespace App\Http\Controllers\User;
use App\User;
use App\UserDetail;
use App\GiveHelp;
use App\GetHelp;
use App\Message;
use App\News;
use App\UserPreStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $id = Auth::User()->id;
        $userDetail = User::with('userDetails')->findOrFail($id);
        if($userDetail->status != 'blocked' &&  $userDetail->status != 'rejected')
        {

            $assignedGiveHelps = GiveHelp::with('getHelps.user.userDetails.userBank','getHelps.user.userDetails.userState','getHelps.user.userDetails.userDistrict')
                ->where('user_id', $id)
                ->where(function ($query) {
                    $query->where('completion_state', 'partially-assigned')
                        ->orWhere('completion_state', 'assigned');
                })
                ->where('status', 'pending')
                ->orderBy('id','DESC')
                ->first();
            $assignedGetHelps = GetHelp::with(['giveHelps.user.userDetails','giveHelps.user.userDetails.userState','giveHelps.user.userDetails.userDistrict','giveHelps' => function ($query) {
                $query->where('give_get_helps.status', 'pending');
            }])
                ->where('user_id', $id)
                ->where(function ($query) {
                    $query->where('completion_state', 'partially-assigned')
                        ->orWhere('completion_state', 'assigned');
                })
                ->where('status', 'pending')
                ->orderBy('id','ASC')
                ->get();
            $news = News::where('type','horizontal')->first();
            return view('user.dashboard',compact('userDetail','assignedGiveHelps','assignedGetHelps','news'));
        }
        else
        {
            $status = $userDetail->status;
            return view('user.block', compact('status'));
        }
    }

    public function rejectHelp(Request $request)
    {
        $requestData = $request->all();
        $helpId = $requestData['give_help_id'];
        $id = $requestData['get_help_id'];
        $amt = $requestData['amount'];
        $senderId = $requestData['sender_id'];
        $getHelp = GetHelp::with(['giveHelps' => function($query) use($helpId)
        {
            $query->where('give_get_helps.give_help_id', '=', $helpId)
                ->where('give_get_helps.status', '=', 'pending');
        }
        ])
            ->findOrFail($id);
        $balance = $getHelp->balance + $amt;
        if($getHelp->amount == $balance)
        {
            $getHelp->update([
                'completion_state' => 'none',
                'balance' => $balance,
            ]);
        }
        else
        {
            $getHelp->update([
                'completion_state' => 'partially-assigned',
                'balance' => $balance,
            ]);
        }
        $getHelp->giveHelps()->updateExistingPivot($helpId, ['status' => 'rejected']);


        $giveHelp = GiveHelp::findOrFail($helpId);
        $userId = $giveHelp->user_id;
        $giveHelp->update([
            'status' => 'rejected',
        ]);
        $user = User::findOrFail($userId);
        if($user->status != 'blocked')
        {
            $userPreStatus = UserPreStatus::where('user_id',$userId)->first();
            if($userPreStatus)
            {
                $userPreStatus->update([
                   'status' => $user->status
                ]);
            }
            else
            {
                UserPreStatus::create([
                    'user_id' => $userId,
                    'status' => $user->status
                ]);
            }
            $user->update([
                'status' => 'rejected',
            ]);
        }
        $name = Auth()->User()->name;
        $user_name = Auth()->User()->user_name;
        $sender = User::with('userDetails')->findOrFail($senderId);
        $number = $sender->userDetails->mob_no;
        $message = 'DEAR DD USERNAME-'.$sender->user_name.' ,YOUR REQUEST HAS BEEN REJECTEED BY'.$user_name.','.$name.',WWW.DAINIKDAAN.IN THANKS.';
        sendMessage($number, $message);
        return redirect()->back()->with('flash_message', 'Help Rejected!!!');
    }
    public function acceptHelp(Request $request)
    {
        $requestData = $request->all();
        $id = $requestData['get_help_id'];
        $helpId = $requestData['give_help_id'];
        $senderId = $requestData['sender_id'];
        $getHelp = GetHelp::with(['giveHelps' => function($query) use($helpId)
        {
            $query->where('give_get_helps.give_help_id', '=', $helpId)
                ->where('give_get_helps.status', '=', 'pending');
        }
        ])
            ->findOrFail($id);
        $getHelp->giveHelps()->updateExistingPivot($helpId, ['status' => 'accepted']);

        $getHelpUpdated = GetHelp::with(['giveHelps' => function($query)
        {
            $query->where('give_get_helps.status', '=', 'pending');
        }
        ])
            ->find($id);
        if($getHelpUpdated->completion_state == 'assigned')
        {
            if($getHelpUpdated->giveHelps->isEmpty())
            {
                $getHelpUpdated->update([
                    'status' => 'accepted',
                ]);
            }
        }

        $giveHelp = GiveHelp::with(['getHelps' => function($query)
        {
            $query->where('give_get_helps.status', '=', 'pending');
        }
        ])
            ->findOrFail($helpId);

        if($giveHelp->completion_state == 'assigned' && $giveHelp->status != 'rejected')
        {
            if($giveHelp->getHelps->isEmpty())
            {
                $giveHelp->update([
                    'status' => 'accepted',
                ]);
                $userId = $giveHelp->user_id;
                $user = User::findOrFail($userId);
                if($user->status != 'blocked' && $user->status != 'rejected')
                {
                    $user->update([
                        'status' => 'active',
                    ]);
                }
            }

        }

        $name = Auth()->User()->name;
        $user_name = Auth()->User()->user_name;
        $sender = User::with('userDetails')->findOrFail($senderId);
        $number = $sender->userDetails->mob_no;
        $message = 'DEAR DD USERNAME-'.$sender->user_name.' ,YOUR REQUEST HAS BEEN ACCEPTED BY'.$user_name.','.$name.',HAVE A NICE DAY.WWW.DAINIKDAAN.IN , THANKS.';
        sendMessage($number, $message);
        return redirect()->back()->with('flash_message', 'Help Accepted!!!');
    }

    public function message(Request $request)
    {
        $requestData = $request->all();
        $sender_id = Auth::User()->id;
        Message::create([
            'sender_id' => $sender_id,
            'receiver_id' => $requestData['receiver_id'],
            'message' => $requestData['message'],
            'status' => 'unread'
        ]);
        return redirect()->route('user.index')->with('flash_message', 'Message Sent!!!');
    }

    public function extendTimer(Request $request)
    {
        $requestData = $request->all();
        $id = $requestData['get_help_id'];
        $helpId = $requestData['give_help_id'];
        $getHelp = GetHelp::with(['giveHelps' => function($query) use($helpId)
        {
            $query->where('give_get_helps.give_help_id', '=', $helpId);
        }
        ])
            ->findOrFail($id);
        $getHelp->giveHelps()->updateExistingPivot($helpId, ['extend_timer_count' => 1]);
        return redirect()->route('user.index')->with('flash_message', 'Timer Extended by 12 hours!!!');
    }

}
