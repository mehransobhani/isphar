<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        $patients=Patient::latest("id")->paginate();
        return $this->apiResponse(["data"=>$patients]);
    }

    public function find($id)
    {
        $patient=Patient::find($id);
        return $this->apiResponse(["data"=>$patient]);
    }
    public function search(Request $request)
    {
        $query=$request->q;
        $patient=Patient::whereRaw("fullname","like %$query%")->paginate();
        return $this->apiResponse(["data"=>$patient]);
    }
    public function delete($id)
    {
        $patient=Patient::find($id)->delete();
        return $this->apiResponse(["message"=>"Completed"]);
    }

    public function insert(Request $request)
    {
        Patient::create($request->all());
        return $this->apiResponse(["message"=>"Completed"]);
    }
    public function update(Request $request)
    {
        Patient::where("id",$request->id)->update($request->all());
        return $this->apiResponse(["message"=>"Completed"]);
    }
    public function tarkhis(Request $request)
    {
         return $this->apiResponse(["message"=>"Completed"]);
    }
    public function dead(Request $request)
    {

        return $this->apiResponse(["message"=>"Completed"]);
    }
}
