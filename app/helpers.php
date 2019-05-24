<?php
use App\User;
use App\State;
use App\GiveHelp;
use App\GetHelp;
use App\UserFund;
use App\DailyGrowth;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Carbon\Carbon;

function sendMessage($number, $message)
{
    $client = new GuzzleHttp\Client();
    $res = $client->request('GET', 'http://mysmsshop.in/http-api.php?username=radiomaker&password=Helpdd*999&senderid=DDHELP&route=1&number='.$number.'&message='.$message);
    $res->getStatusCode();
    // "200"

    $res->getBody();
    // {"type":"User"...'
}

function helpMatching()
{
    $giveHelp = GiveHelp::select('give_helps.*')->with('user.userDetails')
        ->join('users', 'users.id', '=', 'give_helps.user_id')
        ->where('users.status','!=','blocked')
        ->where('give_helps.status','=','pending')
        ->where(function ($query) {
            $query->where('completion_state', 'partially-assigned')
                ->orWhere('completion_state', 'none');
        })
        ->orderBY('match_order_date','ASC')
        ->first();
    $getHelp = GetHelp::select('get_helps.*')->with('user.userDetails')
        ->join('users', 'users.id', '=', 'get_helps.user_id')
        ->where('users.status','!=','blocked')
        ->where('get_helps.status','pending')
        ->where(function ($query) {
            $query->where('completion_state', 'partially-assigned')
                ->orWhere('completion_state', 'none');
        })
        ->orderBy('match_order_date','ASC')
        ->first();
    if(!is_null($giveHelp) && !is_null($getHelp))
    {

        do
        {
            $giveHelpBalance = 0;
            $getHelpBalance = 0;
            if($giveHelp->balance == $getHelp->balance)
            {
                $amount = $giveHelp->balance;
                $giveHelp->getHelps()->attach($getHelp->id,['assigned_amount' => $giveHelp->balance, 'status' => 'pending']);
                $giveHelp->update([
                    'balance' => $giveHelpBalance,
                    'completion_state' => 'assigned',
                ]);
                $getHelp->update([
                    'balance' => $getHelpBalance,
                    'completion_state' => 'assigned',

                ]);
                $senderNumber = $giveHelp->user->userDetails->mob_no;
                $receiverNumber = $getHelp->user->userDetails->mob_no;
                $senderMessage = 'DEAR DD ID- '.$giveHelp->user->user_name.' ,YOU HAVE GOT A LINK FOR PROVIDE HELP AMT-'.$amount.',PLEASE CONTACT-'.$receiverNumber.','.$getHelp->user->name.',WWW.DAINIKDAAN.IN THANKS.';
                $receiverMessage = 'DEAR DD ID- '.$getHelp->user->user_name.' ,YOU HAVE GOT A LINK FOR RECEIVE HELP AMT-'.$amount.',PLEASE CONTACT-'.$senderNumber.','.$giveHelp->user->name.',WWW.DAINIKDAAN.IN THANKS.';
                sendMessage($senderNumber, $senderMessage);
                sendMessage($receiverNumber, $receiverMessage);
            }
            elseif($giveHelp->balance > $getHelp->balance)
            {
                $amount = $getHelp->balance;
                $giveHelpBalance = $giveHelp->balance - $getHelp->balance;
                $giveHelp->getHelps()->attach($getHelp->id,['assigned_amount' => $getHelp->balance, 'status' => 'pending']);
                $giveHelp->update([
                    'balance' => $giveHelpBalance,
                    'completion_state' => 'partially-assigned',

                ]);
                $getHelp->update([
                    'balance' => $getHelpBalance,
                    'completion_state' => 'assigned',
                ]);
                $senderNumber = $giveHelp->user->userDetails->mob_no;
                $receiverNumber = $getHelp->user->userDetails->mob_no;
                $senderMessage = 'DEAR DD ID- '.$giveHelp->user->user_name.' ,YOU HAVE GOT A LINK FOR PROVIDE HELP AMT-'.$amount.',PLEASE CONTACT-'.$receiverNumber.','.$getHelp->user->name.',WWW.DAINIKDAAN.IN THANKS.';
                $receiverMessage = 'DEAR DD ID- '.$getHelp->user->user_name.' ,YOU HAVE GOT A LINK FOR RECEIVE HELP AMT-'.$amount.',PLEASE CONTACT-'.$senderNumber.','.$giveHelp->user->name.',WWW.DAINIKDAAN.IN THANKS.';
                sendMessage($senderNumber, $senderMessage);
                sendMessage($receiverNumber, $receiverMessage);
            }
            else
            {
                $amount = $giveHelp->balance;
                $getHelpBalance = $getHelp->balance - $giveHelp->balance;
                $giveHelp->getHelps()->attach($getHelp->id,['assigned_amount' => $giveHelp->balance, 'status' => 'pending']);
                $giveHelp->update([
                    'balance' => $giveHelpBalance,
                    'completion_state' => 'assigned',

                ]);
                $getHelp->update([
                    'balance' => $getHelpBalance,
                    'completion_state' => 'partially-assigned',
                ]);
                $senderNumber = $giveHelp->user->userDetails->mob_no;
                $receiverNumber = $getHelp->user->userDetails->mob_no;
                $senderMessage = 'DEAR DD ID- '.$giveHelp->user->user_name.' ,YOU HAVE GOT A LINK FOR PROVIDE HELP AMT-'.$amount.',PLEASE CONTACT-'.$receiverNumber.','.$getHelp->user->name.',WWW.DAINIKDAAN.IN THANKS.';
                $receiverMessage = 'DEAR DD ID- '.$getHelp->user->user_name.' ,YOU HAVE GOT A LINK FOR RECEIVE HELP AMT-'.$amount.',PLEASE CONTACT-'.$senderNumber.','.$giveHelp->user->name.',WWW.DAINIKDAAN.IN THANKS.';
                sendMessage($senderNumber, $senderMessage);
                sendMessage($receiverNumber, $receiverMessage);
            }
            $giveHelp = GiveHelp::select('give_helps.*')->with('user.userDetails')
                ->join('users', 'users.id', '=', 'give_helps.user_id')
                ->where('users.status','!=','blocked')
                ->where('give_helps.status','=','pending')
                ->where(function ($query) {
                    $query->where('completion_state', 'partially-assigned')
                        ->orWhere('completion_state', 'none');
                })
                ->orderBY('match_order_date','ASC')
                ->first();
            $getHelp = GetHelp::select('get_helps.*')->with('user.userDetails')
                    ->join('users', 'users.id', '=', 'get_helps.user_id')
                    ->where('users.status','!=','blocked')
                    ->where('get_helps.status','pending')
                    ->where(function ($query) {
                        $query->where('completion_state', 'partially-assigned')
                            ->orWhere('completion_state', 'none');
                    })
                    ->orderBy('match_order_date','ASC')
                    ->first();
        }
        while(!is_null($giveHelp) && !is_null($getHelp));
    }

}

function getDateTime($dateTime)
{
   $seconds = time() - strtotime($dateTime);
    $hours = floor($seconds / (60*60));
   return $hours;
}

function helpGeneration()
{
    $users = User::with('userDetails')->get();
    foreach($users as $user)
    {
        if($user->status != 'rejected' && $user->status != 'blocked' && $user->identity != 'fake')
        {
            $activeIds = getTotalDirectActiveTeam($user->user_name);
            $getHelpsCount = GetHelp::where('user_id',$user->id)
                              ->where('type','helping')
                              ->count();
            $modulo = $getHelpsCount%10;
            if($modulo == 0)
            {
                $lastGiveHelp = GiveHelp::where('user_id',$user->id)
                    ->orderBy('id','DESC')
                    ->first();
                if($lastGiveHelp)
                {
                    if($lastGiveHelp->status == 'accepted')
                    {
                        $lastGetHelp = GetHelp::where('user_id',$user->id)
                            ->where('type','helping')
                            ->orderBY('id','DESC')
                            ->first();
                        if($lastGetHelp)
                        {
                            if($lastGetHelp->status == 'accepted')
                            {
                                if($lastGiveHelp->created_at < $lastGetHelp->created_at)
                                {
                                    GiveHelp::create([
                                        'user_id' => $user->id,
                                        'amount' => 500,
                                        'status' => 'pending',
                                        'balance' => 500,
                                        'completion_state' => 'none',
                                    ]);
                                }
                                else if($lastGiveHelp->created_at > $lastGetHelp->created_at)
                                {
                                    $cycle = intval($getHelpsCount/10);
                                    $cycleNo = $cycle + 1;
                                    $neededActiveIds = $cycleNo * 2;
                                    if($activeIds >= $neededActiveIds)
                                    {
                                        $hours = getDateTime($lastGiveHelp->updated_at);
                                        if($hours >= 6)
                                        {
                                            GetHelp::create([
                                                'user_id' => $user->id,
                                                'amount' => 1000,
                                                'status' => 'pending',
                                                'type' => 'helping',
                                                'balance' => 1000,
                                                'completion_state' => 'none',
                                            ]);
                                        }
                                    }
                                }
                            }
                        }
                        else
                        {
                            $cycle = intval($getHelpsCount/10);
                            $cycleNo = $cycle + 1;
                            $neededActiveIds = $cycleNo * 2;
                            if($activeIds >= $neededActiveIds)
                            {
                                $hours = getDateTime($lastGiveHelp->updated_at);
                                if($hours >= 6)
                                {
                                    GetHelp::create([
                                        'user_id' => $user->id,
                                        'amount' => 1000,
                                        'status' => 'pending',
                                        'type' => 'helping',
                                        'balance' => 1000,
                                        'completion_state' => 'none',
                                    ]);
                                }
                            }
                        }
                    }
                }
            }
            else
            {
                $lastGiveHelp = GiveHelp::where('user_id',$user->id)
                        ->orderBy('id','DESC')
                        ->first();
                if($lastGiveHelp)
                {
                    if($lastGiveHelp->status == 'accepted')
                    {
                        $lastGetHelp = GetHelp::where('user_id',$user->id)
                            ->where('type','helping')
                            ->orderBY('id','DESC')
                            ->first();
                        if($lastGetHelp)
                        {
                            if($lastGetHelp->status == 'accepted')
                            {
                                if($lastGiveHelp->created_at < $lastGetHelp->created_at)
                                {
                                    GiveHelp::create([
                                        'user_id' => $user->id,
                                        'amount' => 500,
                                        'status' => 'pending',
                                        'balance' => 500,
                                        'completion_state' => 'none',
                                    ]);
                                }
                                else if($lastGiveHelp->created_at > $lastGetHelp->created_at)
                                {
                                    $cycle = intval($getHelpsCount/10);
                                    $cycleNo = $cycle + 1;
                                    $neededActiveIds = $cycleNo * 2;
                                    if($activeIds >= $neededActiveIds)
                                    {
                                        $hours = getDateTime($lastGiveHelp->updated_at);
                                        if($hours >= 6)
                                        {
                                            GetHelp::create([
                                                'user_id' => $user->id,
                                                'amount' => 1000,
                                                'status' => 'pending',
                                                'type' => 'helping',
                                                'balance' => 1000,
                                                'completion_state' => 'none',
                                            ]);
                                        }
                                    }
                                }
                            }
                        }
                        else
                        {
                            $cycle = intval($getHelpsCount/10);
                            $cycleNo = $cycle + 1;
                            $neededActiveIds = $cycleNo * 2;
                            if($activeIds >= $neededActiveIds)
                            {
                                $hours = getDateTime($lastGiveHelp->updated_at);
                                if($hours >= 6)
                                {
                                    GetHelp::create([
                                        'user_id' => $user->id,
                                        'amount' => 1000,
                                        'status' => 'pending',
                                        'type' => 'helping',
                                        'balance' => 1000,
                                        'completion_state' => 'none',
                                    ]);
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}

function totalTeam($totalTeam,$members, $level)
{
    if(!$members->isEmpty())
    {
        foreach ($members as $member)
        {
            $member->level = $level ;
        }
        foreach ($members as $member)
        {
            $username = $member->username;
            $totalTeam->push($member);
            $newmembers = User::with('userDetails')
                ->where('sponsor_id', '=', $username)
                ->orderBy('created_at','DESC')
                ->get();
            $level = $member->level;
            $level = $level + 1;
            $totalTeam = totalTeam($totalTeam, $newmembers, $level);
        }
    }
    return $totalTeam;
}

function getTotalTeam($username)
{
    $teamDetails = User::with('userDetails')
        ->where('sponsor_id', '=', $username)
        ->orderBy('created_at','DESC')
        ->get();
    $totalTeam = $teamDetails;
    if(!$teamDetails->isEmpty())
    {
        $level = 1;
        foreach ($teamDetails as $teamDetail)
        {
            $teamDetail->level = $level ;
        }
        foreach ($teamDetails as $teamDetail)
        {
            $username = $teamDetail->user_name;
            $members = User::with('userDetails')
                ->where('sponsor_id', '=', $username)
                ->orderBy('created_at','DESC')
                ->get();
            if(!$members->isEmpty())
            {
                $level = $teamDetail->level;
                $level = $level + 1;
                foreach ($members as $member)
                {
                    $member->level = $level ;
                }
                foreach ($members as $member)
                {
                    $username = $member->user_name;
                    $totalTeam->push($member);
                    $newmembers = User::with('userDetails')
                        ->where('sponsor_id', '=', $username)
                        ->orderBy('created_at','DESC')
                        ->get();
                    $level = $member->level;
                    $level = $level + 1;
                    $totalTeam = totalTeam($totalTeam,$newmembers, $level);
                }
            }

        }
    }
    return $totalTeam;
}

function getTotalDirectActiveTeam($username)
{
    $count = User::with('userDetails')
        ->where('sponsor_id', '=', $username)
        ->where('status','=','active')
        ->orderBy('created_at','DESC')
        ->count();
    return $count;
}

function getTotalDirectTeam($username)
{
    $totalDirectTeam = User::with('userDetails')
        ->where('sponsor_id', '=', $username)
        ->orderBy('created_at','DESC')
        ->get();
    return $totalDirectTeam;
}

function totalIncome($username)
{
    $members = User::where('sponsor_id',$username)
        ->get();
    $income = 0;
    foreach ($members as $member)
    {
        $giveHelp = GiveHelp::where('user_id',$member->id)
                            ->orderBy('id','ASC')
                            ->first();
        if($giveHelp)
        {
            if($giveHelp->status == 'accepted')
            {
                $income = $income + $giveHelp->amount * 0.2;
            }
        }
    }
    $id = Auth::User()->id;
    $addedFund = UserFund::where('user_id',$id)
        ->sum('amount');
    $dainikGrowth = DailyGrowth::where('user_id',$id)
        ->sum('amount');
    $income =$income+$addedFund + $dainikGrowth;
    return $income;
}

function availableBalance($username,$id)
{
    $income = totalIncome($username);
    $withdrawalAmount = GetHelp::where('user_id',$id)
        ->where('type','working')
        ->sum('amount');
    return $availableBalance = $income - $withdrawalAmount;
}

function getDetails($username)
{
    $data = User::with('userDetails')
                  ->where('user_name',$username)
                  ->first();
    return $data;

}

function dailyGrowth()
{
    $users = User::get();
    foreach ($users as $user)
    {
        if($user->status != 'rejected' && $user->status != 'blocked' && $user->identity != 'fake')
        {
            $id = $user->id;
            $giveHelp = GiveHelp::where('user_id',$id)
                                ->orderBy('id','ASC')
                                ->first();
            if($giveHelp)
            {
                if($giveHelp->status == 'accepted')
                {
                    $initialTimestamp = $giveHelp->updated_at;
                    $hours = getDateTime($initialTimestamp);
                    $days = floor($hours / (24));
                    $dailyGrowths = DailyGrowth::where('user_id',$id)->count();
                    if($dailyGrowths < 15)
                    {
                        $amount = 50;
                        $i = $days - $dailyGrowths;
                        for($i; $i>=1; $i--)
                        {
                            DailyGrowth::create([
                                'user_id' => $id,
                                'amount' => $amount
                            ]);
                        }
                    }
                }
            }
        }
    }
}

//public function newHelpMatching()
//{
//    $giveHelps = GiveHelp::with('user.userDetails')
//        ->where('status','=','pending')
//        ->where(function ($query) {
//            $query->where('completion_state', 'partially-assigned')
//                ->orWhere('completion_state', 'none');
//        })
//        ->orderBY('match_order_date','ASC')
//        ->get();
//    foreach ($giveHelps as $giveHelp)
//    {
//        $getHelps = GetHelp::with('user.userDetails')
//            ->where('status','pending')
//            ->where(function ($query) {
//                $query->where('completion_state', 'partially-assigned')
//                    ->orWhere('completion_state', 'none');
//            })
//            ->orderBy('match_order_date','ASC')
//            ->get();
//        foreach ($getHelps as $getHelp)
//        {
//            $status = true;
//            if($getHelp->type == 'helping')
//            {
//                $hours = getDateTime($getHelp->created_at);
//                if()
//            }
//        }
//    }
//}