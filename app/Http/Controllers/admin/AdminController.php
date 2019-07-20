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

        $newUsers = User::real()->pending()->get();
        $totalNewId = count($newUsers);

        $totalInActiveId = 0;
        $users = User::real()->get();
        foreach ($users as $user)
        {
            $giveHelp = GiveHelp::where('user_id',$user->id)
                                ->helping()
                                ->orderBy('id','ASC')
                                ->first();
            if($giveHelp)
            {
                if($giveHelp->status == 'pending' && $giveHelp->completion_state == 'assigned')
                {
                    $totalInActiveId++;
                }
            }
        }
        $totalActiveId = 0;
        $users = User::get();
        foreach ($users as $user)
        {
            $id = $user->id;
            $giveHelp = GiveHelp::where('user_id',$id)
                ->helping()
                ->first();
            if($giveHelp)
            {
                if($giveHelp->status == 'accepted')
                {
                    $totalActiveId = $totalActiveId + 1;
                }
            }
        }
        $totalBlockedId = User::blocked()->count();
        $totalSystemFund = GiveHelp::where('status', '!=','rejected')
                                   ->sum('amount');
        $giveHelps = GiveHelp::with('getHelps','user')
                            ->get();
                                    
        $totalAcceptedFund = 0;
        $totalRejectedFund = 0;
        $postRejectedFund = 0;
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
                        if(isset($giveHelp->user->pool_no))
                        {
                            $postRejectedFund = $postRejectedFund + $getHelp->pivot->assigned_amount;
                        }
                    }
                }
            }
        }
        $totalBalanceFund = GiveHelp::pending()
                                      ->notAssigned()
                                      ->sum('amount');

        $totalReceiverFund = 0;
        $getHelps = GetHelp::pending()->get();
        foreach ($getHelps as $getHelp) 
        {
            if($getHelp->completion_state == 'none')
            {
                $totalReceiverFund = $totalReceiverFund + $getHelp->amount;
            }
            elseif($getHelp->completion_state == 'partially-assigned')
            {
                $totalReceiverFund = $totalReceiverFund + $getHelp->balance;
            }
        } 
        $totalAddedFund = UserFund::where('purpose','admin-added')->sum('amount');
        $news = News::where('type','horizontal')->first();
        return view('admin.dashboard', compact('totalSystemId','totalActiveId','totalNewId','totalInActiveId','totalInActiveId','totalBlockedId','totalSystemFund','totalAcceptedFund','totalRejectedFund','totalBalanceFund','totalAddedFund','postRejectedFund','totalReceiverFund','news'));
    }
}
