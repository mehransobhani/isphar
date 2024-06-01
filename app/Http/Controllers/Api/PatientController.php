<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::latest("id")->paginate();
        return $this->apiResponse(["data" => $patients]);
    }

    public function find($id)
    {
        $patient = Patient::findOrFail($id);
        return $this->apiResponse(["data" => $patient]);
    }

    public function search(Request $request)
    {
        $query = $request->q;
        $patient = Patient::whereRaw("fullname like ?", "%{$query}%")->paginate();
        return $this->apiResponse(["data" => $patient]);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        Patient::findOrFail($id)->delete();
        return $this->apiResponse(["message" => "Completed"]);
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string',
            'national_code' => 'required|size:10|unique:patients',
            'birth_date' => 'required|date',
            'gender' => 'required|in:man,woman',
            'admission_date' => 'required|date',
            'file_number' => 'required|string',
            'room_name' => 'required|string',
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(['error' => $validator->errors()], 422);
        }
        $request["created_date"] = createdAt();
        Patient::create($request->all());
        return $this->apiResponse(["message" => "Completed"]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|string',
            'fullname' => 'required|string',
            'national_code' => 'required|size:10',
            'birth_date' => 'required|date',
            'gender' => 'required|in:man,woman',
            'admission_date' => 'required|date',
            'file_number' => 'required|string',
            'room_name' => 'required|string',
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(['error' => $validator->errors()], 422);
        }
        Patient::where("id", $request->id)->update($request->all());
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
        Patient::where("id", $request->id)->update(["tarkhis"=>1]);
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
        Patient::where("id", $request->id)->update(["dead"=>1]);
        return $this->apiResponse(["message" => "Completed"]);
    }
}
