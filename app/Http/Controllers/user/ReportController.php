<?php


namespace App\Http\Controllers\user;

use App\GiveHelp;
use App\GetHelp;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function provideHelpReport()
    {
        $id = Auth::User()->id;
        $perPage = 25;
        $giveHelps = GiveHelp::report($id)->paginate($perPage);
        return view('user.report.given', compact('giveHelps'));
    }

    public function receiveHelpReport()
    {
        $id = Auth::User()->id;
        $perPage = 25;
        $getHelps = GetHelp::report($id)->helping()->paginate($perPage);
        return view('user.report.taken', compact('getHelps'));
    }

    public function rejectedHelpReport()
    {
        $id = Auth::User()->id;
        $perPage = 25;
        $getHelps = GetHelp::with(['giveHelps' => function($query)
                {
                    $query->where('give_get_helps.status', '=', 'rejected');
                }
            ])
            ->where('user_id', $id)
            ->orderBy('created_at','DESC')
            ->paginate($perPage);
        $giveHelps = GiveHelp::with(['getHelps' => function($query)
                {
                    $query->where('give_get_helps.status', '=', 'rejected');
                }
            ])
            ->where('user_id', $id)
            ->orderBy('created_at','DESC')
            ->paginate($perPage);
        return view('user.report.rejected', compact('getHelps','giveHelps'));
    }
}