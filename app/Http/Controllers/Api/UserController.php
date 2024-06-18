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
        $user = myUser();

        $fieldsToUpdate = ["name", "pharmacist_firstname", "tell", "pharmacist_lastname", "medical_code", "personel_code"];

        $updateData = array_filter($request->only($fieldsToUpdate), function($value) {
            return !is_null($value) && $value !== '';
        });

        if ($request->file('sign_image')) {
            $fileName = time() . '.' . $request->image->extension();
            $request->file('sign_image')->storeAs('sign_image', $fileName, 'public');
            $updateData["sign_image"] = $fileName;
        }
        if (!empty($updateData)) {
            User::where('id', $user->id)->update($updateData);
        }
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
        $user = myUser();
        if (!Hash::check($request->password, $user->password)) {
            return $this->apiResponse(["message" => "current password is wrong !"], 400);
        }
        $user->update(["password" => bcrypt($request->newPassword)]);
        $token = $user->createToken('auth-token')->plainTextToken;
        return $this->apiResponse(['token' => $token]);
    }

    public function get(){
        $user = myUser();
        return $this->apiResponse(["data" => $user]);
    }
}
