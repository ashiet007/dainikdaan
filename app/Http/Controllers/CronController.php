<?php


namespace App\Http\Controllers;

use App\Setting;
use App\User;
use App\GiveHelp;
use Carbon\Carbon;

class CronController extends Controller
{
    public function helpMatching()
    {
        $setting = Setting::first();
        $time = Carbon::now('Asia/Kolkata');
        $hour = $time->format('H');
        $t=date('d-m-Y');
        $day = date("D",strtotime($t));
//        if($setting->link_status == 1 && $day != 'Sun' && $hour >= 10 && $hour < 17)
        if(true)
        {
            helpMatchingCycle();
        }

        helpGeneration();
    }

    public function userStatusUpdate()
    {
        $users = User::get();
        foreach ($users as $user)
        {
            $id = $user->id;
            $giveHelp = GiveHelp::where('user_id', $id)
                ->orderBy('id', 'DESC')
                ->first();
            if(!is_null($giveHelp)) {
                if ($giveHelp->status == 'rejected') {
                    $user->update([
                        'status' => 'rejected'
                    ]);
                } elseif ($giveHelp->status == 'accepted') {
                    $user->update([
                        'status' => 'active'
                    ]);
                } else {
                    $giveHelp = GiveHelp::where('user_id', $id)
                        ->orderBy('id', 'ASC')
                        ->first();
                    if ($giveHelp->status == 'pending') {
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
        }
    }
}

