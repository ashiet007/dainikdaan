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
                'email' =>'email|max:50',
                'subject' => 'max:255',
                'message' => 'required|max:255',
            ]);
            $requestData = $request->all();
            Contact::create($requestData);
            alert()->success('Your Query Has been Submited', 'Success')->persistent("Close");
            return redirect('contact');
      }
}