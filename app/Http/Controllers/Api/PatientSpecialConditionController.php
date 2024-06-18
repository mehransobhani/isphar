<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PatientSpecialCondition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PatientSpecialConditionController extends Controller
{
    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "weight" => "required",
            "height" => "required",
            "patient_id" => "required",
            "naresayi_koliavi" => "required|in:1,0",
            "masrafe_sigar" => "required|in:1,0",
            "kambode_g6pd" => "required|in:1,0",
            "naresayi_kabedi" => "required|in:1,0",
            "radiology" => "required|in:1,0",
            "masrafe_alcol" => "required|in:1,0",
            "hasasiate_daruyi" => "required|in:1,0",
            "soe_masrafe_mavad" => "required|in:1,0",
            "anti_biotic" => "required|in:1,0",
            "vaksan" => "required|in:1,0",
            "peyvand_ozv" => "required|in:1,0",
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(['error' => $validator->errors()], 422);
        }
        $request["created_at"] = createdAt();
        $request["user_id"] = userId();
        $model=PatientSpecialCondition::create($request->all());
        return $this->apiResponse(["message" => "Completed" , "id"=>$model->id]);
    }

    public function delete(Request $request)
    {
        PatientSpecialCondition::findOrFail($request->id)->delete();
        return $this->apiResponse(["message" => "Completed"]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "id" => "required|numeric",
            "weight" => "required",
            "height" => "required",
            "patient_id" => "required|numeric",
            "naresayi_koliavi" => "required|in:1,0",
            "masrafe_sigar" => "required|in:1,0",
            "kambode_g6pd" => "required|in:1,0",
            "naresayi_kabedi" => "required|in:1,0",
            "radiology" => "required|in:1,0",
            "masrafe_alcol" => "required|in:1,0",
            "hasasiate_daruyi" => "required|in:1,0",
            "soe_masrafe_mavad" => "required|in:1,0",
            "anti_biotic" => "required|in:1,0",
            "vaksan" => "required|in:1,0",
            "peyvand_ozv" => "required|in:1,0",

        ]);
        if ($validator->fails()) {
            return $this->apiResponse(['error' => $validator->errors()], 422);
        }
        PatientSpecialCondition::where("id", $request->id)->update($request->all());
        return $this->apiResponse(["message" => "Completed"]);
    }
    public function get()
    {
        $data=PatientSpecialCondition::latest("id")->paginate();
        return $this->apiResponse(["data"=>$data]);
    }
}
