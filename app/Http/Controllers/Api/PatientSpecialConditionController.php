<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Patient;
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

        $model=Patient::findOrFail($request->patient_id);
        if($model->user_id!=userId())
        {
            return  $this->apiResponse("forbidden",403,"forbidden");
        }
        $request["user_id"] = userId();
        $request["created_at"] = createdAt();
        $model=PatientSpecialCondition::create($request->all());
        return $this->apiResponse(["message" => "Completed" , "id"=>$model->id]);
    }

    public function delete(Request $request)
    {
        $model=PatientSpecialCondition::findOrFail($request->id);
        if($model->user_id!=userId())
        {
            return $this->apiResponse(["message" => "Forbidden",403]);
        }
        $model->delete();
        return $this->apiResponse(["message" => "Completed"]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "id" => "required",
            "weight" => "required",
            "height" => "required",
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
        $inputs = removeNullFields($request->all());

        $model=PatientSpecialCondition::findOrFail($request->id);
        if($model->user_id!=userId())
        {
            return $this->apiResponse(["message" => "Forbidden",403]);
        }

        PatientSpecialCondition::where("id", $request->id)->update($inputs);
        return $this->apiResponse(["message" => "Completed"]);
    }
    public function get()
    {
        $data=PatientSpecialCondition::latest("id")->paginate();
        return $this->apiResponse(["data"=>$data]);
    }
}
