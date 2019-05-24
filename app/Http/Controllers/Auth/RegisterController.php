<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\UserDetail;
use App\GiveHelp;
use App\Bank;
use App\State;
use App\District;
use App\UserPassword;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm(Request $request)
    {
        if($request->has('sponsor-id'))
        {
            $sponsorId = $request['sponsor-id'];
            $sponsorDetails = User::where('user_name',$sponsorId)->first()->toArray();
            $banks = Bank::all();
            $states = State::all();
            return view('auth.register', compact('banks','states','sponsorDetails'));
        }
        else
        {
            $sponsorDetails = array();
            $banks = Bank::all();
            $states = State::all();
            return view('auth.register', compact('banks','states','sponsorDetails'));
        }

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'sponsor_id' => 'required|exists:users,user_name',
            'name' => ['required','string','min:3','max:21','regex:/(^[a-zA-Z\\s]*$)/u'],
            'user_name' => 'required|string|min:3|max:255|alpha_num|unique:users|regex:/^[a-zA-Z]{3}[A-Z0-9a-z]*$/',
            'email' => 'required|string|email|max:255',
            'mob_no' => 'required|numeric|digits:10',
            'district_id' => 'required',
            'state_id' => 'required',
            'bank_id' => 'required',
            'account_no' => 'required|numeric',
            'account_type' => 'required|string|max:255',
            'ifsc_code' => ['required','string','max:255','regex:/(^([A-Z|a-z]{4}[0][A-Z0-9a-z]{6}$))/u'],
            'branch' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = array();
        $userDetails = array();
        $user['sponsor_id'] = $data['sponsor_id'];
        $user['name'] = strtoupper($data['name']);
        $user['user_name'] = strtolower($data['user_name']);
        $user['email'] = strtolower($data['email']);
        $user['password'] = bcrypt($data['password']);
        $user['status'] = 'pending';
        $user = User::create($user);
        $user->assignRole('User');
        $userDetails['mob_no'] = $data['mob_no'];
        $userDetails['alternate_mob_no'] = $data['alternate_mob_no'];
        $userDetails['state_id'] = $data['state_id'];
        $userDetails['district_id'] = $data['district_id'];
        $userDetails['bank_id'] = $data['bank_id'];
        $userDetails['account_no'] = $data['account_no'];
        $userDetails['account_type'] = $data['account_type'];
        $userDetails['ifsc_code'] = strtoupper($data['ifsc_code']);
        $userDetails['branch'] = strtoupper($data['branch']);
        $userDetails['gpay_no'] = $data['gpay_no'];
        $userDetails['paytm_no'] = $data['paytm_no'];
        $userDetails = UserDetail::create($userDetails);
        $user->userDetails()->save($userDetails);
        UserPassword::create([
            'user_id' => $user->id,
            'password'=> $data['password']
        ]);
        $number = $data['mob_no'];
        $message = 'THANKS FOR REGISTRATION YOUR USER ID-'.$data['user_name'].' AND PASSWORD-'.$data['password'].',PLEASE GO TO WWW.DAINIKDAAN.IN FOR  LOGIN PAGE.';
        sendMessage($number, $message);
        $giveHelp = GiveHelp::create([
            'amount' => '500',
            'balance' => '500',
            'status' => 'pending',
            'completion_state' => 'none'
        ]);
        $user->giveHelps()->save($giveHelp);
        return $user;

    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        return redirect($this->redirectPath())->with('message', 'Thanks for Registration! You Username and has been sent to your Mobile Number');
    }
}
