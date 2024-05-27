<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PatientDrug;
use Illuminate\Http\Request;

class PatientDrugController extends Controller
{
    public function insert(Request $request)
    {
        PatientDrug::create($request->all());
        return $this->apiResponse(["message"=>"Completed"]);
    }
    public function delete($id)
    {
        PatientDrug::find($id)->delete();
        return $this->apiResponse(["message"=>"Completed"]);
    }
    public function update(Request $request)
    {
        PatientDrug::where("id",$request->id)->update($request->all());
        return $this->apiResponse(["message"=>"Completed"]);
    }
}
