<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\UserDetail;
use App\GiveHelp;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
class DownlineController extends Controller
{

    public function totalDownline(Request $request)
    {
        $requestData = $request->get('user_name');
        $perPage = 100;
        $username = User::pluck('user_name','user_name')->toArray();
        $teamDetails = null;
        if(!empty($requestData))
        {
            $teamDetails = getTotalTeam($requestData);
            return view('admin.downline.total',compact('teamDetails','username'));
        }
        else{
            return view('admin.downline.total',compact('teamDetails','username'));
        }
    }
    public function directTeam(Request $request)
    {
        $requestData = $request->get('user_name');
        $perPage = 100;
        $username = User::pluck('user_name','user_name')->toArray();
        $teamDetails = null;
        if(!empty($requestData))
        {
            $teamDetails = User::with('UserDetails')
                         ->where('sponsor_id', '=', $requestData)  
                         ->paginate($perPage);
            return view('admin.downline.direct',compact('teamDetails','username'));
        }
        else{
            return view('admin.downline.direct',compact('teamDetails','username'));
        }     
        
    }
    
    public function rejectedMembers(Request $request)
    {
        $requestData = $request->get('user_name');
        $perPage = 100;
        $username = User::pluck('user_name','user_name')->toArray();
        if(!empty($requestData))
        {
            $users = User::with('UserDetails')
                     ->where('user_name', '=', $requestData)
                     ->where('status', '=', 'rejected' )
                     ->orderBy('updated_at','DESC')  
                     ->paginate($perPage);
            return view('admin.downline.rejected',compact('users','username'));
        }     
        else
        {
            $users = User::with('UserProfiles')
                     ->where('status', '=', 'rejected' )
                     ->orderBy('updated_at','DESC')  
                     ->paginate($perPage);
            return view('admin.downline.rejected',compact('users','username'));
        }
      }

    public function blockedMembers(Request $request)
    {
        $requestData = $request->get('user_name');
        $perPage = 100;
        $username = User::pluck('user_name','user_name')->toArray();
        if(!empty($requestData))
        {
            $users = User::with('UserDetails')
                     ->where('user_name', '=', $requestData)
                     ->where('status', '=', 'blocked' )
                     ->orderBy('updated_at','DESC')  
                     ->paginate($perPage);
            return view('admin.downline.blocked',compact('users','username'));
        }     
        else
        {
            $users = User::with('UserDetails')
                     ->where('status', '=', 'blocked' )
                     ->orderBy('updated_at','DESC')  
                     ->paginate($perPage);
            return view('admin.downline.blocked',compact('users','username'));
        }
    }
}