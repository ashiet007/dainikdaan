<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\GetHelp;
use App\User;
use Illuminate\Http\Request;

class GetHelpWorkingController extends Controller
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
            $gethelps = GetHelp::with('user','giveHelps.user')
                                ->join('users', 'users.id', '=', 'get_helps.user_id')
                                ->where('type','working')
                                ->orderBy('created_at', 'DESC')
                                ->select('get_helps.*')->groupBy('get_helps.id')->distinct();
            if($status != null)
            {
                $gethelps->where('get_helps.status',$status);
            }                               
            if($keyword != null)
            {
                $gethelps->where(function ($query) use ($keyword) {
                          $query->where('users.name', 'LIKE', "%$keyword%")
                              ->orWhere('users.username', 'LIKE', "%$keyword%")
                              ->orWhere('user_id', 'LIKE', "%$keyword%")
                              ->orWhere('type', 'LIKE', "%$keyword%")
                              ->orWhere('amount', 'LIKE', "%$keyword%");
                          });
            }
            $gethelps = $gethelps->get();
        } else {
            $gethelps = GetHelp::with('user','giveHelps.user')->orderBy('created_at', 'DESC')->where('type','working')->get();
        }

        return view('admin.getHelpsWorking.index', compact('gethelps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $gethelp = null;
        $username = User::pluck('username','id')->toArray();
        return view('admin.getHelpsWorking.create', compact('username','gethelp'));
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
            'identity' => 'required',
            'type' => 'required'
        ]);       
        $requestData = $request->all();
        $amount = $requestData['amount'];
        if($amount <= 3000)
        {
            $modulo = $amount % 200;
            if($modulo == 0)
            {
                $requestData['status'] = 'pending';
                $requestData['balance'] = $requestData['amount'];
                $requestData['completion_state'] = 'none';       
                GetHelp::create($requestData);
                return redirect('admin/get-helps-working')->with('flash_message', 'GetHelp added!');
            }
            else
            {
                return redirect()->back()->with('flash_message', 'Amount must be multiple of 200!!!');
            }  
        }
        else
        {
            return redirect()->back()->with('flash_message', 'Amount can not be greater than 3000!!!');
        }         
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
        $gethelp = GetHelp::with('user')->findOrFail($id);

        return view('admin.getHelpsWorking.show', compact('gethelp'));
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
        $gethelp = GetHelp::with('user')->findOrFail($id);
        $username = User::where('id', $gethelp->user_id)->pluck('username','id')->toArray();

        return view('admin.getHelpsWorking.edit', compact('gethelp','username'));
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
            'identity' => 'required',
            'type' => 'required'
        ]);
        $requestData = $request->all();
        $gethelp = GetHelp::findOrFail($id);
        if(!empty($requestData['created_at']))
        {
            $timestamp = strftime('%Y-%m-%d %H:%M:%S', strtotime($requestData['created_at']));
            $requestData['created_at'] = $timestamp;
        }
        else
        {
           $requestData['created_at'] = $gethelp->created_at; 
        }      
        $gethelp->update($requestData);
        return redirect('admin/get-helps-working')->with('flash_message', 'GetHelp updated!');
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
        GetHelp::destroy($id);

        return redirect('admin/get-helps-working')->with('flash_message', 'GetHelp deleted!');
    }
}
