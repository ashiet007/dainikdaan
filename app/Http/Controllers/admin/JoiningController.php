<?php
namespace App\Http\Controllers\Admin;

use App\User;
use App\UserDetail;
use App\GiveHelp;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
class JoiningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index(Request $request)
    {
        $requestData = $request->all();
        $perPage = 100;
        if(!empty($requestData))
        {
            $users = User::with('userDetails')
                     ->whereDate('created_at', '>=', $requestData['start_date'])
                     ->whereDate('created_at', '<=', $requestData['end_date'])
                     ->orderBy('created_at', 'DESC')  
                     ->paginate($perPage);
            return view('admin.joining.index',compact('users'));
        }     
        else
        {
            $users = null;
            return view('admin.joining.index',compact('users'));
        }
    }

    public function newJoining()
    {
        $users = User::with('userDetails','giveHelps')
                            ->get();
        return view('admin.joining.newJoining',compact('users'));
    }
}
