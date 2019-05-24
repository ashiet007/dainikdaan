<?php


namespace App\Http\Controllers;

use App\Setting;
use App\User;
use App\GiveHelp;

class CronController extends Controller
{
    public function helpMatching()
    {
        $setting = Setting::first();
        if($setting->link_status == 1)
        {
            helpMatching();
        }

        helpGeneration();
        dailyGrowth();
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

