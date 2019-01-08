<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class SigninController extends Controller
{

    public function form()
    {
        return view('login');
    }

    public function attempt(Request $request)
    {
        $this->validate($request, [
            'username' => 'exists:users,username',
            'password' => 'required',
        ]);
        $attempts = [
            'username' => $request->username,
            'password' => $request->password,
        ];
        if (Auth::attempt($attempts, (bool) $request->remember)) {
            return redirect()->intended('/');
        }
        return redirect()->back();
    }

    public function out(Request $request) {
    	Auth::logout();
    }
}
