<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JsValidator;
use Validator;

class LoginController extends Controller
{
    /**
     * Define your validation rules in a property in
     * the controller to reuse the rules.
     */
    protected $validationRules = [
        'user_name' => 'required|exists:users,user_name|max:255',
        'password' => 'required|min:6',
    ];
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */

    public function showLoginForm()
    {
        $validator = JsValidator::make($this->validationRules);
        return view('auth.login',compact('validator'));
    }

    public function authenticate(Request $request)
    {
        $validation = Validator::make($request->all(), $this->validationRules);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation->errors());
        }
        $credentials = $request->only('user_name', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('user/dashboard');
        }
        else
        {
            alert()->error('credentials do not match', 'Error')->persistent("Close");
            return redirect()->back();
        }
    }
}