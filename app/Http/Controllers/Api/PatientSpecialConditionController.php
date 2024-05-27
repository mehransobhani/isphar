<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PatientSpecialCondition;
use Illuminate\Http\Request;

class PatientSpecialConditionController extends Controller
{
    public function insert(Request $request)
    {
        PatientSpecialCondition::create($request->all());
        return $this->apiResponse(["message"=>"Completed"]);
    }
    public function delete($id)
    {
        PatientSpecialCondition::find($id)->delete();
        return $this->apiResponse(["message"=>"Completed"]);
    }
    public function update(Request $request)
    {
        PatientSpecialCondition::where("id",$request->id)->update($request->all());
        return $this->apiResponse(["message"=>"Completed"]);
    }
}
