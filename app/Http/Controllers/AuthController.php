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
    public function profile()
    {
        $model=auth("admin")->user();
        return view("admin.auth.profile",compact("model"));

    }
    public function editPassword()
    {
        return view("admin.auth.resetPassword");
    }
    public function updateProfile(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'name' => ['required'],
        ]);
        $model=auth("admin")->user();
        $model->update(["email"=>$request->email,"name"=>$request->name]);
        return back()->with('success', 'پروفایل با موفقیت ویرایش شد.');


    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => ['required' ],
            'newPassword' => ['required'],
        ]);
        $model=auth("admin")->user();
        if(bcrypt($request->password)!=$model->password)
        {
            return back()->with('error', 'کلمه عبور نادرست است.');
        }

        $model->update(["password"=>bcrypt($request->newPassword)]);
        return back()->with('success', 'کلمه عبور با موفقیت ویرایش شد.');


    }

}
