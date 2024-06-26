<?php

namespace App\Http\Controllers\Api;

use App\Classes\PatientHistory\PatientHistoryBuilder;
use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Artisan;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        Artisan::call("optimize:clear");
        Artisan::call("cache:clear");
        Artisan::call("route:clear");
        if ($request->page == -1) {
            $patients = Patient::with("drpReport")->latest("id")->get();
            foreach ($patients as $patient) {
                $patient->drugs = $patient->patientDrug;
                $patient->talfigh_paziresh = $patient->patientDrug->isNotEmpty();
                $patient->talfigh_paziresh_date = $patient->patientDrug->isNotEmpty() ? $patient->patientDrug->max("created_at") : null;
                unset($patient["patientDrug"]);
            }
        } else {
            $patients = Patient::with("drpReport")->latest("id")->paginate();
            $patients->getCollection()->transform(function ($patient) {
                $patient->drugs = $patient->patientDrug;
                $patient->talfigh_paziresh = $patient->patientDrug->isNotEmpty();
                $patient->talfigh_paziresh_date = $patient->patientDrug->isNotEmpty() ? $patient->patientDrug->max("created_at") : null;
                unset($patient["patientDrug"]);
                return $patient;
            });
        }

        return $this->apiResponse(["data" => $patients]);
    }

    public function find($id)
    {
        $patient = Patient::with(["PatientSpecialCondition", "patientDrug"])
            ->with(["patientHistory"=> function ($query) {
                return $query->with("user:id,name");
            }])
            ->with("drpReport")
            ->findOrFail($id);
        return $this->apiResponse(["data" => $patient]);
    }

    public function search(Request $request)
    {
        $query = $request->q;
        $patient = Patient::with("drpReport")->
        where('fullname', 'like', "%{$query}%")
            ->orWhere('national_code', 'like', "%{$query}%")
            ->orWhere('file_number', 'like', "%{$query}%")
            ->latest('id')
            ->paginate();
        return $this->apiResponse(["data" => $patient]);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        PatientHistoryBuilder::delete($id);
        Patient::findOrFail($id)->delete();
        return $this->apiResponse(["message" => "Completed"]);
    }

    public function insert(Request $request)
    {
        $params = faToEnNumbers($request->all());
        $validator = Validator::make($params, [
            'fullname' => 'required|string',
            'national_code' => 'required|size:10|unique:patients',
            'birth_date' => 'required|date',
            'gender' => 'required|in:man,woman',
            'admission_date' => 'required|date',
            'file_number' => 'required|string',
            'room_name' => 'required|string',
            'age' => 'required|string',
            'section_name' => 'required|string',
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(['error' => $validator->errors()], 422);
        }
        $params["created_date"] = createdAt();
        $params["user_id"] = myUser()->id;
        $Patient = Patient::create($params);
        PatientHistoryBuilder::insert($Patient->id);
        return $this->apiResponse(["message" => "Completed", "id" => $Patient->id]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|string',
            'fullname' => 'nullable|string',
            'national_code' => 'nullable|size:10',
            'birth_date' => 'nullable|date',
            'gender' => 'nullable|in:man,woman',
            'admission_date' => 'nullable|date',
            'file_number' => 'nullable|string',
            'room_name' => 'nullable|string',
            'age' => 'nullable|string',
            'section_name' => 'nullable|string',
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(['error' => $validator->errors()], 422);
        }
        $model=Patient::findOrFail($request->id);
        if($model->user_id!=userId())
        {
            return  $this->apiResponse("forbidden",403,"forbidden");
        }
        Patient::where("id", $request->id)->update($request->all());
        PatientHistoryBuilder::update($request->id);

        return $this->apiResponse(["message" => "Completed"]);
    }

    public function tarkhis(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|string',
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(['error' => $validator->errors()], 422);
        }
        $model=Patient::findOrFail($request->id);
        if($model->user_id!=userId())
        {
            return  $this->apiResponse("forbidden",403,"forbidden");
        }
        Patient::where("id", $request->id)->update(["tarkhis" => 1]);
        PatientHistoryBuilder::tarkhis($request->id);
        return $this->apiResponse(["message" => "Completed"]);
    }

    public function dead(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|string',
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(['error' => $validator->errors()], 422);
        }
        $model=Patient::findOrFail($request->id);
        if($model->user_id!=userId())
        {
            return  $this->apiResponse("forbidden",403,"forbidden");
        }
        Patient::where("id", $request->id)->update(["dead" => 1]);
        PatientHistoryBuilder::dead($request->id);

        return $this->apiResponse(["message" => "Completed"]);
    }
}
