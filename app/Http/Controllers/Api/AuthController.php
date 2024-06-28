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
            return $this->apiResponse(['error' => $validator->errors()], 422);
        }
        $request->mobile = convertPersianArabicToEnglish($request->mobile);
        var_dump($request->mobile);
        $credentials = $request->only('mobile', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('auth-token')->plainTextToken;
            return $this->apiResponse(['token' => $token]);
        } else {
            return $this->apiResponse(['error' => 'Unauthorized'], 401);
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
            return $this->apiResponse(['error' => $validator->errors()], 422);
        }
        $user = User::create([
            'name' => $request->name,
            'mobile' => $request->email,
            'created_at' => date("Y-m-d H:i:s", time()),
            'password' => bcrypt($request->password),
        ]);
        $token = $user->createToken('Api')->accessToken;
        return $this->apiResponse(['token' => $token], 201);
    }

    public function forgotCodeVerify(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|string',
            'code' => 'required|string',
        ]);
        if ($validator->fails()) {
            $this->apiResponse(['error' => $validator->errors()], 422);
        }
        $mobile = $request->mobile;
        $requestCode = $request->code;
        $user = User::where("mobile", $mobile)->first();
        $code = $user->reset_pwd_code;
        if ($requestCode == $code) {
            return $this->apiResponse(['message' => "completed"]);
        }
        return $this->apiResponse(['message' => "The code is not valid"], 400);
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'newPassword' => 'required|string',
            'code' => 'required|string',
            'mobile' => 'required|string',
        ]);
        if ($validator->fails()) {
            $this->apiResponse(['error' => $validator->errors()], 422);
        }
        $newPassword = $request->newPassword;
        $code = $request->code;
        $mobile = $request->mobile;
        $user = User::where("mobile", $mobile)->where("reset_pwd_code", $code)->first();
        if (!$user)
            return $this->apiResponse(['message' => "The user not find"], 400);
        $user->update(["password" => bcrypt($newPassword) , 'reset_pwd_code'=>null ]);

        $token = $user->createToken('auth-token')->plainTextToken;
        return $this->apiResponse(['token' => $token]);
    }

    public function forgot(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|string',
        ]);
        if ($validator->fails()) {
            $this->apiResponse(['error' => $validator->errors()], 422);
        }
        $code = rand(10000, 99999);
        $mobile = $request->mobile;
        $user = User::where("mobile", $mobile)->first();
        if (!$user)
            return $this->apiResponse(['message' => "The user not find"], 400);
        $user->update(["reset_pwd_code" => $code, "reset_pwd_date" => date("Y-m-d H:i:s", time())]);
        Sms::send($user->mobile, $code);
        return $this->apiResponse(['message' => "completed"]);
    }
    public function profile(Request $request)
    {
        $user=myUser();
        return $this->apiResponse(['data' => $user]);
    }
}
