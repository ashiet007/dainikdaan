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
        UserFund::create($requestData);
        return redirect()->back()->with('flash_message','Fund Added Successfully');
    }

    public function fundList()
    {
        $fundsList = UserFund::with('user')
            ->orderBy('created_at','DESC')
            ->get();
        return view('admin.fund.list',compact('fundsList'));
    }
}