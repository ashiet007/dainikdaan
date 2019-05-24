<?php


namespace App\Http\Controllers\user;

use App\User;
use App\UserDetail;
use App\UserPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function viewProfile()
    {
        $id = Auth::User()->id;
        $userDetail = User::with('userDetails.userState','userDetails.userDistrict','userDetails.userBank')->where('id',$id)->firstOrFail();
        return view('user.profile.viewProfile', compact('userDetail'));
    }

    public function viewSponsor()
    {
        $sponsorId = Auth::User()->sponsor_id;
        $sponsorDetails = User::with('userDetails')->where('user_name',$sponsorId)->firstOrFail();
        return view('user.profile.sponsor', compact('sponsorDetails'));
    }

    public function viewSecurity()
    {
        return view('user.profile.security');
    }

    public function changeSecurity(Request $request)
    {
        $this->validate($request,[
            'current_password' => 'required',
            'password' => 'required|string|min:6|confirmed'
        ]);
        $id = Auth::User()->id;
        $requestData = $request->all();
        $user = User::where('id',$id)->first();
        $userPassword = UserPassword::where('user_id',$id)->first();
        $oldPassword = $user->password;
        $currentPassword = $requestData['current_password'];
        if(Hash::check($currentPassword, $oldPassword))
        {
            $newPassword = Hash::make($requestData['password']);
            try
            {
                $user->update([
                    'password' => $newPassword
                ]);
                $userPassword->update([
                    'password' => $requestData['password']
                ]);
                return redirect()->back()->with('flash_message','Password updated successfully');
            }
            catch (\Illuminate\Database\QueryException $e)
            {
                return redirect()->back()->withErrors($e->getMessage())->withInput();
            }
        }
        else
        {
            return redirect()->back()->withErrors('Current Password is Incorrect')->withInput();
        }

    }
}