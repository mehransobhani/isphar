<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DrpReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DrpReportController extends Controller
{
  
    public function index(Request $request)
    {
        if ($request->page == -1)
            $drpReport = DrpReport::with("patient")->latest("id")->get();
        else
            $drpReport = DrpReport::with("patient")->latest("id")->paginate();
        return $this->apiResponse(["data" => $drpReport]);
    }
    public function find($id)
    {
        $drpReport = DrpReport::with("patient")->with("patientDrug")->find($id);
        return $this->apiResponse(["data" => $drpReport]);
    }

    public function search(Request $request)
    {
        $q = $request->q;
        $drpReport = DrpReport::whereHas("patient", function ($query) use ($q) {
            $query->where('fullname', 'like', "%{$q}%")
                ->orWhere('national_code', 'like', "%{$q}%")
                ->orWhere('file_number', 'like', "%{$q}%");
        })->paginate();
        return $this->apiResponse(["data" => $drpReport]);
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required',
            'egfr_mdrd' => 'required',
            'egfr_ckd_epi' => 'required',
            'crcl' => 'required',
            'child_pough_score' => 'required',
            'source' => 'required',
            'form' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(['error' => $validator->errors()], 422);
        }
        $request["user_id"] = userId();
        $request["created_at"] = createdAt();
        $model = DrpReport::create($request->all());
        return $this->apiResponse(["message" => "Completed", "id" => $model->id]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required',
            'egfr_mdrd' => 'required',
            'egfr_ckd_epi' => 'required',
            'crcl' => 'required',
            'child_pough_score' => 'required',
            'source' => 'required',
            'form' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(['error' => $validator->errors()], 422);
        }
        DrpReport::where("id", $request->id)->update($request->all());
        return $this->apiResponse(["message" => "Completed"]);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        DrpReport::findOrFail($id)->delete();
        return $this->apiResponse(["message" => "Completed"]);
    }
}
