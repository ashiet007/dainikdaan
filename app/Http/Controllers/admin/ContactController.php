<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Contact;
use Illuminate\Http\Request;

class contactController extends Controller
{
	public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 100;

        if (!empty($keyword)) {
            $contact = contact::where('name', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->orWhere('subject', 'LIKE', "%$keyword%")
                ->orderBy('created_at','DESC')
                ->paginate($perPage);
        } else {
            $contact = contact::orderBy('created_at','DESC')->paginate($perPage);
        }

        return view('admin/contact.index', compact('contact'));
    }
    public function show($id)
    {
        $contact = Contact::findOrFail($id);

        return view('admin.contact.show', compact('contact'));
    }
    public function destroy($id)
    {
        Contact::destroy($id);
        return redirect('admin/contact')->with('flash_message', 'Contact deleted!');
    }

 } 