<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\GiveHelp;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GiveHelpsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $status = $request->get('status');
        if($keyword != null || $status != null) {
            $givehelps = GiveHelp::with('user','getHelps.user')
                                ->join('users', 'users.id', '=', 'give_helps.user_id')
                                ->orderBy('created_at', 'DESC')
                                ->select('give_helps.*')->groupBy('give_helps.id')->distinct();
            if($status != null)
            {
                $givehelps->where('give_helps.status',$status);
            }                               
            if($keyword != null)
            {
                $givehelps->where(function ($query) use ($keyword) {
                          $query->where('users.name', 'LIKE', "%$keyword%")
                              ->orWhere('users.user_name', 'LIKE', "%$keyword%")
                              ->orWhere('user_id', 'LIKE', "%$keyword%")
                              ->orWhere('amount', 'LIKE', "%$keyword%");
                          });
            }
            $givehelps = $givehelps->get();
        } else {
            $givehelps = GiveHelp::with('user','getHelps.user')->orderBy('created_at', 'DESC')->get();
        }

        return view('admin.give-helps.index', compact('givehelps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $givehelp = null;
        $username = User::pluck('user_name','id')->toArray();
        return view('admin.give-helps.create', compact('username','givehelp',''));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required',
            'user_id' => 'required',
            'status' => 'required',
        ]);
        $requestData = $request->all();
        $requestData['balance'] = $requestData['amount'];
        $requestData['completion_state'] = 'none';
        GiveHelp::create($requestData);

        return redirect('admin/give-helps')->with('flash_message', 'GiveHelp added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $givehelp = GiveHelp::with('user')->findOrFail($id);

        return view('admin.give-helps.show', compact('givehelp'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $givehelp = GiveHelp::with('user')->findOrFail($id);
        $username = User::where('id', $givehelp->user_id)->pluck('user_name','id')->toArray();

        return view('admin.give-helps.edit', compact('givehelp','username',''));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'amount' => 'required',
            'user_id' => 'required',
            'status' => 'required',
        ]);        
        $requestData = $request->all();
        $givehelp = GiveHelp::findOrFail($id);
        if(!empty($requestData['created_at']))
        {
            $timestamp = strftime('%Y-%m-%d %H:%M:%S', strtotime($requestData['created_at']));
            $requestData['created_at'] = $timestamp;
        }
        else
        {
           $requestData['created_at'] = $givehelp->created_at; 
        }         
        $givehelp->update($requestData);

        return redirect('admin/give-helps')->with('flash_message', 'GiveHelp updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        GiveHelp::destroy($id);

        return redirect('admin/give-helps')->with('flash_message', 'GiveHelp deleted!');
    }
}
