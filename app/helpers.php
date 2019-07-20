<?php
use App\User;
use App\UserDetail;
use App\State;
use App\GiveHelp;
use App\GetHelp;
use App\UserFund;
use App\HelpSetting;
use App\CompanyPool;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Carbon\Carbon;

function sendMessage($number, $message)
{
    $client = new GuzzleHttp\Client();
    $res = $client->request('GET', 'http://mysmsshop.in/http-api.php?username=radiomaker&password=Helpdd*999&senderid=MAGICB&route=1&number='.$number.'&message='.$message);
    $res->getStatusCode();
    // "200"

    $res->getBody();
    // {"type":"User"...'
}

function helpMatchingCycle()
{
    $giveHelps = GiveHelp::select('give_helps.*')->with('user.userDetails')
        ->join('users', 'users.id', '=', 'give_helps.user_id')
        ->where('users.status','!=','blocked')
        ->where('give_helps.status','=','pending')
        ->where('type', 'helping')
        ->where(function ($query) {
            $query->where('completion_state', 'partially-assigned')
                ->orWhere('completion_state', 'none');
        })
        ->orderBY('match_order_date','ASC')
        ->get();
    if(count($giveHelps))
    {
        foreach ($giveHelps as $giveHelp)
        {
            $getHelps = GetHelp::select('get_helps.*')->with('user.userDetails')
                ->join('users', 'users.id', '=', 'get_helps.user_id')
                ->where('users.status','!=','blocked')
                ->where('get_helps.status','pending')
                ->where(function ($query) {
                    $query->where('completion_state', 'partially-assigned')
                        ->orWhere('completion_state', 'none');
                })
                ->orderBy('match_order_date','ASC')
                ->get();
            if(count($getHelps))
            {
                foreach ($getHelps as $getHelp)
                {
                    helpAssign($giveHelp, $getHelp);
                    break;
                }
            }
        }
    }
}

function helpAssign($giveHelp, $getHelp)
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
        $senderMessage = 'OUR MAGIC PARTNER- '.$giveHelp->user->user_name.' ,YOU HAVE GOT A LINK FOR PROVIDE HELP AMT- '.$amount.' ,PLEASE CONT- '.$receiverNumber.','.$getHelp->user->name.',WWW.MAGICBANDHAN.COM THANKS.';
        $receiverMessage = 'OUR MAGIC PARTNER - '.$getHelp->user->user_name.' ,YOU HAVE GOT A LINK FOR RECEIVE HELP AMT-'.$amount.' ,PLEASE CONT- '.$senderNumber.','.$giveHelp->user->name.' ,WWW.MAGICBANDHAN.COM THANKS.';
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
        $senderMessage = 'OUR MAGIC PARTNER- '.$giveHelp->user->user_name.' ,YOU HAVE GOT A LINK FOR PROVIDE HELP AMT- '.$amount.' ,PLEASE CONT- '.$receiverNumber.','.$getHelp->user->name.',WWW.MAGICBANDHAN.COM THANKS.';
        $receiverMessage = 'OUR MAGIC PARTNER - '.$getHelp->user->user_name.' ,YOU HAVE GOT A LINK FOR RECEIVE HELP AMT-'.$amount.' ,PLEASE CONT- '.$senderNumber.','.$giveHelp->user->name.' ,WWW.MAGICBANDHAN.COM THANKS.';
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
        $senderMessage = 'OUR MAGIC PARTNER- '.$giveHelp->user->user_name.' ,YOU HAVE GOT A LINK FOR PROVIDE HELP AMT- '.$amount.' ,PLEASE CONT- '.$receiverNumber.','.$getHelp->user->name.',WWW.MAGICBANDHAN.COM THANKS.';
        $receiverMessage = 'OUR MAGIC PARTNER - '.$getHelp->user->user_name.' ,YOU HAVE GOT A LINK FOR RECEIVE HELP AMT-'.$amount.' ,PLEASE CONT- '.$senderNumber.','.$giveHelp->user->name.' ,WWW.MAGICBANDHAN.COM THANKS.';
        sendMessage($senderNumber, $senderMessage);
        sendMessage($receiverNumber, $receiverMessage);
    }
}

function getDateTime($dateTime)
{
   $seconds = time() - strtotime($dateTime);
   $hours = $seconds / (60*60);
   return sprintf('%0.2f', $hours);
}

function helpGeneration()
{
    $users = User::with('userDetails','singleLineIncome')->get();
    $helpSettings = HelpSetting::orderBy('order_no','DESC')->get();
    foreach($users as $user)
    {
        if($user->status != 'rejected' && $user->status != 'blocked' && $user->identity != 'fake')
        {
            $activeIds = getTotalDirectActiveTeam($user->user_name);
            $lastGiveHelp = GiveHelp::where('user_id', $user->id)
                ->where('type', 'helping')
                ->orderBy('id', 'DESC')
                ->first();
            if ($lastGiveHelp) {
                if ($lastGiveHelp->status == 'accepted') {
                    $lastGetHelp = GetHelp::where('user_id', $user->id)
                        ->where('type', 'helping')
                        ->orderBy('id', 'DESC')
                        ->first();
                    if ($lastGetHelp) {
                        if ($lastGetHelp->status == 'accepted') {
                            if ($lastGiveHelp->created_at < $lastGetHelp->created_at) {
                                GiveHelp::create([
                                    'user_id' => $user->id,
                                    'amount' => 500,
                                    'status' => 'pending',
                                    'balance' => 500,
                                    'type' => 'helping',
                                    'completion_state' => 'none',
                                ]);
                            } else if ($lastGiveHelp->created_at > $lastGetHelp->created_at) {
                                $isOnHold = checkUserforOnHold($user->id);
                                if(!$isOnHold)
                                {
                                    if($user->singleLineIncome->amount >= 1000)
                                    {
                                        GetHelp::create([
                                            'user_id' => $user->id,
                                            'amount' => 1000,
                                            'status' => 'pending',
                                            'type' => 'helping',
                                            'balance' => 1000,
                                            'completion_state' => 'none',
                                        ]);
                                        $user->singleLineIncome->update([
                                            'amount' => 0,
                                            'status' => 'stop'
                                        ]);
                                        break;
                                    }
                                }
                            }
                        }
                    } else {
                        $isOnHold = checkUserforOnHold($user->id);
                        if(!$isOnHold)
                        {
                            if($user->singleLineIncome->amount >= 1000)
                            {
                                GetHelp::create([
                                    'user_id' => $user->id,
                                    'amount' => 1000,
                                    'status' => 'pending',
                                    'type' => 'helping',
                                    'balance' => 1000,
                                    'completion_state' => 'none',
                                ]);
                                $user->singleLineIncome->update([
                                    'amount' => 0,
                                    'status' => 'stop'
                                ]);
                                break;
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
                            ->where('type','helping')
                            ->orderBy('id','ASC')
                            ->first();
        if($giveHelp)
        {
            if($giveHelp->status == 'accepted')
            {
                $income = $income + 100;
            }
        }
    }
    $id = Auth::User()->id;
    $addedFund = UserFund::where('user_id',$id)
        ->where('type','credit')
        ->sum('amount');
    $income =$income+$addedFund ;
    return $income;
}

function helpingIncome()
{
    $id = Auth::User()->id;
    $gethelp = new GetHelp;
    $totalHelpingIncome = $gethelp->totalHelpingIncome($id);
    return $totalHelpingIncome;
}

function sumOfIncomes($username)
{
    $workingIncome = totalIncome($username);
    $totalHelpingIncome = helpingIncome();
    $sum = $workingIncome + $totalHelpingIncome;
    return $sum;
}

function availableBalance($username,$id)
{
    $income = totalIncome($username);
    $withdrawalAmount = GetHelp::where('user_id',$id)
        ->where('type','working')
        ->sum('amount');
    $deductedBalance = UserFund::where('user_id',$id)
        ->where('type','debit')
        ->sum('amount');
    return $availableBalance = $income - ($withdrawalAmount + $deductedBalance) ;
}

function getDetails($username)
{
    $data = User::with('userDetails')
                  ->where('user_name',$username)
                  ->first();
    return $data;

}

function checkUserforOnHold($id)
{
    $detail = UserDetail::where('user_id',$id)
                        ->select('mob_no','account_no')
                        ->first();
    $users = UserDetail::with('user')
                ->join('users','users.id','=','user_details.user_id')
                ->select('user_details.*')
                ->where(function ($query) use ($detail) {
                    $query->where('mob_no', '=', $detail->mob_no)
                        ->orWhere('account_no', '=', $detail->account_no);
                })
                ->where('users.status', '=', 'rejected')
                ->get();
    $count = count($users);
    if($count > 0)
        return true;
    else
        return false;
}

function addSingleLineIncome()
{
    $companyPool = CompanyPool::with('user')
                                    ->start()
                                    ->get();
    foreach ($companyPool as $data)
    {
        if($data->user->status == 'active')
        {
            $activeIds = getTotalDirectActiveTeam($data->user->user_name);
            $helpSettings = HelpSetting::orderBy('order_no','DESC')->get();
            foreach ($helpSettings as $helpSetting)
            {
                if ($activeIds >= $helpSetting->needed_active_ids )
                {
                    $amount =  $data->amount + $helpSetting->income_per_id;
                    $data->update([
                        'amount' => $amount
                    ]);
                    break;
                }
            }
        }
    }
}