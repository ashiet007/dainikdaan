<?php


namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JsValidator;
use Validator;
use Illuminate\Support\Facades\Auth;

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

    public function loginForm()
    {
        $validator = JsValidator::make($this->validationRules);
        return view('auth.admLogin',compact('validator'));
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
            return redirect()->intended('admin/dashboard');
        }
        else
        {
            alert()->error('Credentials do not match', 'Error')->persistent("Close");
            return redirect()->back();
        }
    }
}