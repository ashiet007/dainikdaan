<?php

namespace App\Http\Controllers\User;

use App\DailyGrowth;
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
                            ->working()
                            ->get();
        return view('user.income.withdraw',compact('income','availableBalance','getHelps'));
    }

    public function workingWithrawal(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required|numeric'
        ]);
        $id = Auth::User()->id;
        $isOnHold = checkUserforOnHold($id);
        if(!$isOnHold)
        {
            $maxAmount= 5000;
            if(Auth::User()->identity == 'fake')
            {
                $maxAmount = 10000;
            }
            $time = Carbon::now('Asia/Kolkata');
            $date = $time->format('Y-m-d');
            $workingAmountSum = GetHelp::where('user_id', $id)
                ->working()
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
                                alert()->success('Withdrawal Created!!!', 'Success')->persistent("Close");
                                return redirect()->route('income.direct');
                            }
                            else
                            {
                                alert()->error('Withdrawal must be multiple of 500!!!', 'Error')->persistent("Close");
                                return redirect()->route('income.direct');
                            }
                        }
                        else
                        {
                            alert()->error('Working income withdrawal maximum limit 5000 per day. Please enter right amount!!!', 'Error')->persistent("Close");
                            return redirect()->route('income.direct');
                        }
                    }
                    else
                    {
                        alert()->error('Maximum Limit Of Withdrawal has been Reached!!!', 'Error')->persistent("Close");
                        return redirect()->route('income.direct')->with('flash_message', '');
                    }
                }
                else
                {
                    alert()->error('You do not have enough balance for this withdrawal!!!', 'Error')->persistent("Close");
                    return redirect()->route('income.direct');
                }

            }
            else
            {
                alert()->error('Please Enter Valid Amount!!!', 'Error')->persistent("Close");
                return redirect()->route('income.direct');
            }
        }
        else
        {
            alert()->error('Your Account Put on hold, You can not withdraw money!!!', 'Error')->persistent("Close");
            return redirect()->route('income.direct');
        }
    }
}