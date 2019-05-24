<?php


namespace App\Http\Controllers\user;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class TeamController extends Controller
{
    public function registeredList()
    {
        $username = Auth::User()->user_name;
        $registerUsers = User::with('userDetails.userState','userDetails.userDistrict')
                            ->where('sponsor_id',$username)
                            ->where('status','pending')
                            ->where('identity','real')
                            ->get();
        return view('user.team.register',compact('registerUsers'));
    }

    public function activeList()
    {
        $username = Auth::User()->user_name;
        $activeUsers = User::with('userDetails.userState','userDetails.userDistrict')
            ->where('sponsor_id',$username)
            ->where('status','active')
            ->where('identity','real')
            ->get();
        return view('user.team.active',compact('activeUsers'));
    }
    public function directList()
    {
        $username = Auth::User()->user_name;

        $team = User::with('userDetails')->where('sponsor_id',$username)->get();
        return view('user.team.directTeam', compact('team'));
    }

    public function rejectedList()
    {
        $username = Auth::User()->user_name;
        $rejectedList = User::with('userDetails')->where('sponsor_id',$username)
            ->where('status','rejected')->get();
        return view('user.team.rejected',compact('rejectedList'));
    }
}