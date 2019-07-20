<?php


namespace App\Http\Controllers\admin;


use App\Http\Controllers\Controller;
use App\User;
use App\UserFund;
use Illuminate\Http\Request;

class FundController extends Controller
{

    public function addFundForm()
    {
        $users= User::select('user_name','name','id')->get();
        return view('admin.fund.add',compact('users'));
    }

    public function addFund(Request $request)
    {
        $requestData =$request->all();
        $requestData['type'] = 'credit';
        $requestData['purpose'] = 'admin-added';
        UserFund::create($requestData);
        alert()->success('Fund Added Successfully', 'Success')->persistent("Close");
        return redirect()->back();
    }

    public function fundList()
    {
        $fundsList = UserFund::with('user')
            ->where('type','credit')
            ->where('purpose','admin-added')
            ->orderBy('created_at','DESC')
            ->get();
        return view('admin.fund.list',compact('fundsList'));
    }
}