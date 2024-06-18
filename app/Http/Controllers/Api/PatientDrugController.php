<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PatientDrug;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PatientDrugController extends Controller
{
    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
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

        $request["created_at"]=createdAt();
        $request["user_id"]=userId();

        $model=PatientDrug::create($request->all());
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
        $validator = Validator::make($request->all(), [
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
        PatientDrug::where("id",$request->id)->update($request->all());
        return $this->apiResponse(["message"=>"Completed"]);
    }
    public function get()
    {
        $data=PatientDrug::latest("id")->paginate();
        return $this->apiResponse(["data"=>$data]);
    }
}
