<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PatientDrug;
use App\Models\PatientSpecialCondition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PatientDrugController extends Controller
{
    public function insert(Request $request)
    {
        $params = faToEnNumbers($request->all());

        $params["created_at"]=createdAt();
        $params["user_id"]=userId();
        $validator = Validator::make($params, [
            'patient_id' => 'required|numeric',
             'name' => 'required|string',
             'type' => 'required|string|in:1,2',
             'dose_amount' => 'required|string',
             'usage_intervals' => 'required|in:Daily,BD,TDS,QID,Every Other Day,Weekly,Monthly,PRN,نا مشخص,سایر',
             'has_alert' => 'required|in:0,1',
             'last_dose_date' => 'date',
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(['error' => $validator->errors()], 422);
        }

        $model=PatientDrug::create($params);
        return $this->apiResponse(["message"=>"Completed" , "id"=>$model->id]);
    }
    public function delete(Request $request)
    {
        $id=$request->id;
        PatientDrug::findOrFail($id)->delete();
        return $this->apiResponse(["message"=>"Completed"]);
    }
    public function update(Request $request)
    {
        $params = faToEnNumbers($request->all());
        $validator = Validator::make($params, [
            'id' => 'required|numeric',
            'patient_id' => 'required|numeric',
            'name' => 'required|string',
            'type' => 'required|string|in:1,2',
            'dose_amount' => 'required|string',
            'usage_intervals' => 'required|in:Daily,BD,TDS,QID,Every Other Day,Weekly,Monthly,PRN,نا مشخص,سایر',
            'has_alert' => 'required|in:0,1',
            'last_dose_date' => 'date',

        ]);
        if ($validator->fails()) {
            return $this->apiResponse(['error' => $validator->errors()], 422);
        }
        $model=PatientDrug::findOrFail($params["id"]);
        if($model->user_id!=userId())
        {
            return $this->apiResponse(["message" => "Forbidden",403]);
        }
        PatientDrug::where("id",$params->id)->update($params);
        return $this->apiResponse(["message"=>"Completed"]);
    }
    public function get(Request $request)
    {
        $data=PatientDrug::where("patient_id", $request->patient_id)->latest("id")->get();
        return $this->apiResponse(["data"=>$data]);
    }
}
