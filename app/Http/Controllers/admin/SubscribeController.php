<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Subscribe;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
	public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $subscribe = Subscribe::where('email', 'LIKE', "%$keyword%")
                                  ->orWhere('name', 'LIKE', "%$keyword%")
                                  ->orderBy('created_at','DESC')
                ->paginate($perPage);
        } else {
            $subscribe = Subscribe::orderBy('created_at','DESC')->paginate($perPage);
        }

        return view('admin.subscribe.index', compact('subscribe'));
    }
    public function destroy($id)
    {
        Subscribe::destroy($id);
        return redirect('admin/subscribe')->with('flash_message', 'Subscription deleted!');
    }

 }