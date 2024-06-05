<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Drug;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DrugController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->q;
        $patient = Drug::whereRaw("fa_name like ?", "%{$query}%")->orWhereRaw("en_name like ?", "%{$query}%")->paginate();
        return $this->apiResponse(["data" => $patient]);
    }
    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'en_name' => 'required|string',
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(['error' => $validator->errors()], 422);
        }
        $request["created_at"]=createdAt();
        $model=Drug::create($request->all());
        return $this->apiResponse(['message' => "completed","id"=>$model->id]);
    }
}
