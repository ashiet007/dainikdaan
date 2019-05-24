<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ValidationController extends Controller
{
    public function remoteValidation(Request $request)
    {
        $requestData = $request->all();
        $this->validate($request,[
            'user_name' =>'unique:users'
        ]);
    }

}