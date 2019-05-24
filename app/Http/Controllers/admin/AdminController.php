<?php

namespace App\Http\Controllers\Admin;
use App\News;
use App\User;
use App\UserDetail;
use App\GiveHelp;
use App\GetHelp;
use App\UserFund;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $totalSystemId = User::count();
        $totalActiveId = 0;
        $totalInActiveId = 0;
        $totalNewId = 0;
        $users = User::get();
        foreach ($users as $user)
        {
            $id = $user->id;
            $giveHelp = GiveHelp::where('user_id',$id)
                ->first();
            if($giveHelp)
            {
                if($giveHelp->status == 'accepted')
                {
                    $totalActiveId = $totalActiveId + 1;
                }
                elseif ($giveHelp->status == 'pending' && $giveHelp->completion_state == 'assigned')
                {
                    $totalInActiveId = $totalInActiveId + 1;
                }
                elseif($giveHelp->status == 'pending' && $giveHelp->completion_state == 'none')
                {
                    $totalNewId = $totalNewId + 1;
                }
            }
        }
        $totalBlockedId = User::where('status', 'blocked')
                               ->count();
        $totalSystemFund = GiveHelp::where('status', '!=','rejected')
                                   ->sum('amount');
        $giveHelps = GiveHelp::with('getHelps')
                            ->get();
                                    
        $totalAcceptedFund = 0;
        $totalRejectedFund = 0;
        foreach($giveHelps as $giveHelp)
        {
            foreach($giveHelp->getHelps as $getHelp)
            {
                if($getHelp->pivot->status == 'accepted')
                {
                    $totalAcceptedFund = $totalAcceptedFund + $getHelp->pivot->assigned_amount;
                }
                elseif($getHelp->pivot->status == 'rejected')
                {
                    if($giveHelp->status == 'rejected')
                    {
                        $totalRejectedFund = $totalRejectedFund + $getHelp->pivot->assigned_amount;
                    }
                }
            }
        }
        $totalBalanceFund = $giveHelps->where('status','pending')
                                      ->where('completion_state','none')
                                      ->sum('amount');
        $totalAddedFund = UserFund::sum('amount');
        $news = News::where('type','horizontal')->first();
        return view('admin.dashboard', compact('totalSystemId','totalActiveId','totalNewId','totalInActiveId','totalInActiveId','totalBlockedId','totalSystemFund','totalAcceptedFund','totalRejectedFund','totalBalanceFund','totalAddedFund','news'));
    }
}
