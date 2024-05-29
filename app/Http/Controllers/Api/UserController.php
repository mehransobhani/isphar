<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function update(Request $request)
    {
        User::where("id", $request->id)->update($request->all());
        return $this->apiResponse(["message" => "Completed"]);
    }

    public function changePwd(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|string',
            'newPassword' => 'required|string',
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(['error' => $validator->errors()], 422);
        }
        $user =myUser();
        if (!Hash::check($request->password, $user->password)) {
            return $this->apiResponse(["message" => "current password is wrong !"], 400);
        }
        $user->update(["password" => bcrypt($request->newPassword)]);
        return $this->apiResponse(["message" => "Completed"]);
    }
}
