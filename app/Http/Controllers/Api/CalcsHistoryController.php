<?php

namespace App\Http\Controllers\Api;

use App\Classes\CalcTypes\CalcTypeValidate;
use App\Http\Controllers\Controller;
use App\Models\CalcsHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CalcsHistoryController extends Controller
{
    public function calc_insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|string',
            'result' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(['error' => $validator->errors()], 422);
        }
        $validate=(new CalcTypeValidate($request->type))->validate();
        if(!$validate)
        {
            return $this->apiResponse(['error' => 'type is not valid !'], 400);
        }
        $request["created_at"]=createdAt();
        $model=CalcsHistory::create($request->all());
        return $this->apiResponse(['message' => "completed","id"=>$model->id]);

    }
    public function crcl_history(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|string',
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(['error' => $validator->errors()], 422);
        }
        $validate=(new CalcTypeValidate($request->type))->validate();
        if(!$validate)
        {
            return $this->apiResponse(['error' => 'type is not valid !'], 400);
        }
        $CalcsHistory=CalcsHistory::where("type",$request->type)->latest("id")->limit(10)->get();
        return $this->apiResponse(['data' => $CalcsHistory]);

    }
}
