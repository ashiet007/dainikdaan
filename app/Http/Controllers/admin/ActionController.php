<?php

namespace App\Http\Controllers\Admin;
use App\User;
use App\UserProfile;
use App\GiveHelp;
use App\GetHelp;
use App\Setting;
use App\UserPreStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;

class ActionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index(Request $request)
    {
        $username = User::pluck('user_name','id');
        $requestData = $request->get('user_id');
        if(!empty($requestData))
        {
            $user = User::where('id', $requestData)->first();
            return view('admin.actions.block', compact('user','username'));
        }
        else
        {
            $user = null;
            return view('admin.actions.block', compact('username','user'));
        }
        
    }

    public function adminAction(Request $request)
    {
        $requestData = $request->all();
        if(!empty($requestData))
        {
            $id = $requestData['id'];
            $user = User::findOrFail($id);
            
            if($user->status == 'blocked')
            {
                $giveHelp = GiveHelp::where('user_id', $id)
                                       ->orderBy('id', 'DESC')
                                       ->first();
                if(!is_null($giveHelp))
                {
                    if($giveHelp->status == 'rejected')                      
                    {
                        $user->update([
                                   'status' => 'rejected'
                                  ]);
                    }
                    elseif ($giveHelp->status == 'accepted')
                    {
                       $user->update([
                                   'status' => 'active'
                                  ]); 
                    }
                    else
                    {
                        $giveHelp = GiveHelp::where('user_id', $id)
                            ->orderBy('id', 'ASC')
                            ->first();
                        if($giveHelp->status == 'pending')
                        {
                            $user->update([
                                'status' => 'pending'
                            ]);
                        }
                    }
                }                
                else
                {
                   $user->update([
                               'status' => 'pending'
                              ]); 
                }
                $flash_message = $user->name.' has been Unblocked!!!';
            }
            else
            {
                $user->update([
                       'status' => 'blocked'
                      ]);
                $flash_message = $user->name.' has been Blocked!!!';
            }
            $user = User::findOrFail($id);
        }
        return redirect()->route('action.index')->with('flash_message',$flash_message);        
    }

    public function linkAction()
    {
        $setting = Setting::first();
        return view('admin.actions.link',compact('setting'));
    }

    public function linkOnOff(Request $request)
    {
        if($request->has('link_status'))
        {
            $status = $request->link_status;
        }
        else{
            $status = 0;
        }
        $setting = Setting::first();
        $setting->update([
           'link_status' => $status
        ]);
        return redirect()->back()->with('flash_message','Link Status updated successfully');

    }
}