<?php

namespace App\Http\Controllers\User;
use App\CompanyPool;
use App\User;
use App\GiveHelp;
use App\GetHelp;
use App\Message;
use App\News;
use App\UserPreStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;

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
        $userDetail = User::with('userDetails','singleLineIncome')->findOrFail($id);

        $giveHelp = new GiveHelp;
        $assignedGiveHelps = $giveHelp->getAssignedHelps($id);
        $getHelp = new GetHelp;
        $assignedGetHelps = $getHelp->getAssignedHelps($id);
        $news = News::horizontal()->first();
        return view('user.dashboard',compact('userDetail','assignedGiveHelps','assignedGetHelps','news'));
    }

    public function rejectHelp(Request $request)
    {
        $requestData = $request->all();
        $helpId = $requestData['give_help_id'];
        $id = $requestData['get_help_id'];
        $amt = $requestData['amount'];
        $senderId = $requestData['sender_id'];
        DB::beginTransaction(); // <-- first line
        $saved = true;
        try
        {
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
                    $userPreStatus = UserPreStatus::create([
                        'user_id' => $userId,
                        'status' => $user->status
                    ]);
                }
                if($userPreStatus)
                {
                    $saved = true;
                }
                else
                {
                    $saved = false;
                }
                $user->update([
                    'status' => 'rejected',
                ]);
            }
            $name = Auth()->User()->name;
            $user_name = Auth()->User()->user_name;
            $sender = User::with('userDetails')->findOrFail($senderId);
            $number = $sender->userDetails->mob_no;
            $message = 'OUR MAGIC PARTNER- '.$sender->user_name.' ,HAS BEEN REJECTED BY ID- '.$user_name.','.$name.', WWW.MAGICBANDHAN.COM SORRY TO YOU.';
            if($saved)
            {
                if($getHelp && $giveHelp && $user)
                {
                    $saved = true;
                }
                else
                {
                    $saved = false;
                }
            }
        }
        catch (\Throwable $e)
        {
            alert()->error($e->getMessage(), 'Error')->persistent("Close");
            return redirect()->back();
        }
        if($saved)
        {
            sendMessage($number, $message);
            DB::commit(); // YES --> finalize it
            alert()->success('Help Rejected!!!', 'Success')->persistent("Close");
            return redirect()->back();
        }
        else
        {
            DB::rollBack(); // NO --> some error has occurred undo the whole thing
            alert()->error('Something went wrong', 'Error')->persistent("Close");
            return redirect()->back()->withInput();
        }
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
        DB::beginTransaction(); // <-- first line
        $saved = true;
        try
        {
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
                    $currentUserStatus = $user->status;
                    if($currentUserStatus == 'pending')
                    {
                        addSingleLineIncome();
                    }
                    if($user->status != 'blocked' && $user->status != 'rejected')
                    {
                        $user->update([
                            'status' => 'active',
                        ]);
                    }
                    CompanyPool::where('user_id',$user->id)
                                ->update([
                                   'status' => 'start'
                                ]);
                    if($user && $giveHelp && $getHelpUpdated)
                    {
                        $saved = true;
                    }
                    else
                    {
                        $saved = false;
                    }
                }

            }

            $name = Auth()->User()->name;
            $user_name = Auth()->User()->user_name;
            $sender = User::with('userDetails')->findOrFail($senderId);
            $number = $sender->userDetails->mob_no;
            $message = 'OUR MAGIC PARTNER- '.$sender->user_name.' ,HAS BEEN ACCEPTED BY ID-'.$user_name.','.$name.', GO AHEAD, WWW.MAGICBANDHAN.COM THANKS.';
            if($saved)
            {
                if($getHelp && $getHelpUpdated && $giveHelp)
                {
                    $saved = true;
                }
                else
                {
                    $saved = false;
                }
            }
        }
        catch (\Throwable $e)
        {
            alert()->error($e->getMessage(), 'Error')->persistent("Close");
            return redirect()->back();
        }
        if($saved)
        {
            sendMessage($number, $message);
            DB::commit(); // YES --> finalize it
            alert()->success('Help Accepted!!!', 'Success')->persistent("Close");
            return redirect()->back();
        }
        else
        {
            DB::rollBack(); // NO --> some error has occurred undo the whole thing
            alert()->error('Something went wrong', 'Error')->persistent("Close");
            return redirect()->back()->withInput();
        }

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
        alert()->success('Message Sent!!!', 'Success')->persistent("Close");
        return redirect()->route('user.index');
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
        alert()->success('Timer Extended by 12 hours!!!', 'Success')->persistent("Close");
        return redirect()->route('user.index');
    }

}
