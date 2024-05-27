<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function update(Request $request)
    {
        User::where("id", $request->id)->update($request->all());
        return $this->apiResponse(["message" => "Completed"]);
    }

    public function changePwd(Request $request)
    {
        $user = auth()->user();
        if (!Hash::check($request->password, $user->password)) {
            return $this->apiResponse(["message" => "current password is wrong !"], 400);
        }
        $user->update(["password" => bcrypt($request->newPassword)]);
        return $this->apiResponse(["message" => "Completed"]);
    }
}
