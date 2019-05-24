<?php

namespace App\Http\Controllers\User;

use App\User;
use App\UserDetail;
use App\GiveHelp;
use App\GetHelp;
use App\UserFund;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function directIncome()
    {
        $username = Auth::User()->user_name;
        $id = Auth::User()->id;

        $income = totalIncome($username);
        $availableBalance = availableBalance($username,$id);
        $getHelps = GetHelp::where('user_id',$id)
            ->where('type','working')
            ->get();
        return view('user.income.withdraw',compact('income','availableBalance','getHelps'));
    }

    public function workingWithrawal(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required|numeric'
        ]);
        $id = Auth::User()->id;
        $maxAmount= 2000;
        if(Auth::User()->identity == 'fake')
        {
            $maxAmount = 10000;
        }
        $time = Carbon::now('Asia/Kolkata');
        $date = $time->format('Y-m-d');
        $workingAmountSum = GetHelp::where('user_id', $id)
            ->where('type', 'working')
            ->whereDate('created_at', '=', $date)
            ->sum('amount');
        $requestData = $request->all();
        if(!empty($requestData))
        {
            $balance = $requestData['balance'];
            $amount = $requestData['amount'];
            if($balance >= $amount)
            {
                if($workingAmountSum < $maxAmount)
                {
                    $workingAmountSum = $workingAmountSum + $amount;
                    if($workingAmountSum <= $maxAmount)
                    {
                        $modulo = $amount % 500;
                        if($modulo == 0)
                        {
                            GetHelp::create([
                                'user_id' => $id,
                                'amount' => $amount,
                                'identity' => 'real',
                                'status' => 'pending',
                                'type' => 'working',
                                'balance' => $amount,
                                'completion_state' => 'none',
                            ]);
                            return redirect()->route('income.direct')->with('flash_message', 'Withdrawal Created!!!');
                        }
                        else
                        {
                            return redirect()->route('income.direct')->with('flash_message', 'Withdrawal must be multiple of 500!!!');
                        }
                    }
                    else
                    {
                        return redirect()->route('income.direct')->with('flash_message', 'Working income withdrawal maximum limit 2000 per day. Please enter right amount!!!');
                    }
                }
                else
                {
                    return redirect()->route('income.direct')->with('flash_message', 'Maximum Limit Of Withdrawal has been Reached!!!');
                }
            }
            else
            {
                return redirect()->route('income.direct')->with('flash_message', 'You do not have enough balance for this withdrawal!!!');
            }

        }
        else
        {
            return redirect()->route('income.direct')->with('flash_message', 'Please Enter Valid Amount!!!');
        }
    }

    public function helpingIncome()
    {
        $perPage = 25;
        $id = Auth::User()->id;
        $getHelps = GetHelp::with('giveHelps')
            ->where('user_id', $id)
            ->where('type', 'helping')
            ->where(function ($query) {
                $query->where('completion_state', 'partially-assigned')
                    ->orWhere('completion_state', 'assigned');
            })
            ->orderBy('created_at','DESC')
            ->paginate($perPage);
        $income = 0;
        if(!$getHelps->isEmpty())
        {
            foreach ($getHelps as $getHelp)
            {
                foreach ($getHelp->giveHelps as $giveHelp)
                {
                    if($giveHelp->pivot->status == 'accepted')
                    {
                        $income = $income + $giveHelp->pivot->amount;
                    }
                }
            }
        }
        return view('user.earnings.helping',compact('getHelps','income'));
    }

    public function totalTransactions()
    {
        $id = Auth::User()->id;
        $perPage = 25;
        $getHelps = GetHelp::with('giveHelps')
            ->where('user_id', $id)
            ->where(function ($query) {
                $query->where('completion_state', 'partially-assigned')
                    ->orWhere('completion_state', 'assigned');
            })
            ->orderBy('created_at','DESC')
            ->paginate($perPage);
        return view('user.earnings.total',compact('getHelps'));
    }

}