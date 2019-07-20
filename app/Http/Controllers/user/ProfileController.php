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
        $user = new User;
        $userDetail = $user->getUserDetails($id);
        return view('user.profile.viewProfile', compact('userDetail'));
    }

    public function viewSponsor()
    {
        $sponsorId = Auth::User()->sponsor_id;
        $user = new User;
        $sponsorDetails = $user->getSponsorDetails($sponsorId);
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
                alert()->success('Password updated successfully', 'Success')->persistent("Close");
                return redirect()->back();
            }
            catch (\Illuminate\Database\QueryException $e)
            {
                alert()->error($e->getMessage(), 'Error')->persistent("Close");
                return redirect()->back()->withInput();
            }
        }
        else
        {
            alert()->error('Current Password is Incorrect', 'Error')->persistent("Close");
            return redirect()->back()->withInput();
        }

    }
}