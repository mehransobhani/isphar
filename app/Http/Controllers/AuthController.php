<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function form()
    {
        if (!auth("admin")->check())
            return view("admin.auth.login");
       return redirect(route("user.index"));
    }

    public function login(Request $request)
    {
         $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
         if (Auth::guard("admin")->attempt($credentials,$request->remember??0)) {
            $request->session()->regenerate();

            return redirect()->intended(route("user.index"));
        }

        return back()->withErrors([
            'email' => 'نام کاربری یا رمز عبور نادرست است .',
        ])->onlyInput('email');
    }

    public function logout()
    {
        auth("admin")->logout();
        return redirect(route("login"));
    }
}
