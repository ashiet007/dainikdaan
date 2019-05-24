<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Contact;
use Illuminate\Http\Request;
class ContactController extends Controller
{

 public function store(Request $request)
    {
       $this->validate($request,[
			'name' => 'required|max:255',
			'email' =>'required|email|max:50',
      'subject' => 'max:255',
		  'message' => 'required|max:255',
		]);
        $requestData = $request->all();   
        Contact::create($requestData);
        return redirect('contact')->with('flash_message', 'Your Query has been submited!');   
  }
}