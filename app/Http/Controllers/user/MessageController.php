<?php

namespace App\Http\Controllers\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $id = Auth::User()->id;
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $messages = Message::with('user')->where('message', 'LIKE', "%$keyword%")
                                             ->where('receiver_id', $id)
                                             ->orderBy('created_at', 'DESC')
                                             ->paginate($perPage);
        } else {
            $messages = Message::with('user')->where('receiver_id', $id)
                                             ->orderBy('created_at', 'DESC')
                                             ->paginate($perPage);
        }

        return view('user.messages.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('user.messages.create');
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
			'name' => 'required'
		]);
        $requestData = $request->all();
        
        Message::create($requestData);

        return redirect('user/messages')->with('flash_message', 'Message added!');
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
        $messages = Message::with('user')->findOrFail($id);
        $id = Auth::User()->id;
        if($messages->receiver_id != $id)
        {
           return redirect()->back()->with('flash_message','You are not Authorized to view this Message');
        }
        $messages->update([
                'status' => 'read'
               ]);

        return view('user.messages.show', compact('messages'));
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
        $messages = Message::findOrFail($id);

        return view('user.messages.edit', compact('messages'));
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
			'name' => 'required'
		]);
        $requestData = $request->all();
        
        $messages = Message::findOrFail($id);
        $messages->update($requestData);

        return redirect('user/messages')->with('flash_message', 'Message updated!');
    }

    /**
     * Remove the specified resource from storage.
     
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Message::destroy($id);

        return redirect('user/messages')->with('flash_message', 'Message deleted!');
    }
}
