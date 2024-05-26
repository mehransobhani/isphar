<?php

namespace App\Http\Controllers\Api;

use App\Classes\sms\Sms;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        $credentials = $request->only('mobile', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('auth-token')->plainTextToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }


    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:255|unique:users',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'mobile' => $request->email,
            'created_at' => date("Y-m-d H:i:s", time()),
            'password' => bcrypt($request->password),
        ]);

        $token = $user->createToken('Api')->accessToken;
        return response()->json(['token' => $token], 201);
    }

    public function forgotCodeVerify(Request $request)
    {
        $mobile=$request->mobile;
        $requestCode=$request->code;
        $user = User::where("mobile",$mobile)->first();
        $code=$user->reset_pwd_code;
        if($requestCode==$code)
        {
            return $this->apiResponse("success");
        }
        return $this->apiResponse("code not valid",400);
    }

    public function resetPassword(Request $request)
    {
        $newPassword=$request->newPassword;
        $code=$request->code;
        $mobile=$request->mobile;
        $user = User::where("mobile",$mobile)->where("reset_pwd_code",$code)->first();
        if(!$user)
            return $this->apiResponse("not find",400,"user not find");
        $user->update(["password"=>bcrypt($newPassword)]);
        return $this->apiResponse("success");
    }

    public function forgot(Request $request)
    {
        $code = rand(10000, 99999);
        $mobile = $request->mobile;
        $user = User::where("mobile",$mobile)->first();
        if(!$user)
            return $this->apiResponse("not find",400,"user not find");
        $user->update(["reset_pwd_code"=>$code , "reset_pwd_date"=>date("Y-m-d H:i:s", time())]);
        Sms::send($user->mobile,$code);
        return $this->apiResponse(["message"=>"sended"]);
    }
}
