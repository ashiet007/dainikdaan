<?php

namespace App\Http\Controllers;
use App\User;
use App\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
   public function about()
   {
       return view('about');
   }

    public function plan()
    {
        return view('plan');
    }

    public function contact()
    {
        return view('contact');
    }

    public function block()
    {
        return view('block');
    }

    public function getDistricts(Request $request)
    {
        $requestData = $request->all();
        if(!empty($requestData))
        {
            $stateId = $requestData['state_id'];
            $data = District::select('id','name')->where('state_id',$stateId)->get();
            $districts = array();
            foreach ($data as $value)
            {
                $key = $value->id;
                $name = $value->name;
                $districts[$key] = $name;
            }
            return response()->json(['success'=>'true','districts' => $districts]);
        }
        else
        {
            return response()->json(['success' =>'false']);
        }

    }

    public function getSponsorDetails(Request $request)
    {
        if($request->has('sponsorId'))
        {
            $requestData = $request->all();
            $sponsorId = $requestData['sponsorId'];
            $sponsor = User::select('name')->where('user_name',$sponsorId)->first();
            if(!empty($sponsor))
            {
                return response()->json(['success'=>'true','sponsorName' => $sponsor->name]);
            }
            else
            {
                return response()->json(['error' => 'Invalid Sponsor'], 401);
            }
        }
        else
        {
            return response()->json(['error' => 'Something went wrong!'], 401);
        }
    }

    public function sendOtp(Request $request)
    {
        $otp = rand(100000,999999);
        $mobNo = $request->get('number');
        $message = 'HELLO DEAR SIR/MADAM YOUR MOBILE CONFIRMATION CODE IS '.$otp.'.THANKS, WWW.DAINIKDAAN.IN.';
        sendMessage($mobNo, $message);
        session(['otp' => $otp]);
        return response()->json(['success'=>'true','message' => 'An OTP has been sent to your Mobile number','otp' => $otp]);
    }

    public function verifyOtp(Request $request)
    {
        if(session()->get('otp') == $request->get('otp'))
        {
            return response()->json(['success'=>'true','message' => 'Mobile Number Verified Successfully']);
        }
        else
        {
            return response()->json(['error'=>'OTP did not match'],401);
        }
    }
}
