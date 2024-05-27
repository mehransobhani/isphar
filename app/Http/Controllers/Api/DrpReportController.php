<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DrpReport;
use Illuminate\Http\Request;

class DrpReportController extends Controller
{
    public function index()
    {
        $drpReport = DrpReport::latest("id")->paginate();
        return $this->apiResponse(["data" => $drpReport]);
    }

    public function insert(Request $request)
    {
        DrpReport::create($request->all());
        return $this->apiResponse(["message" => "Completed"]);
    }
    public function update(Request $request)
    {
        DrpReport::where("id",$request->id)->update($request->all());
        return $this->apiResponse(["message" => "Completed"]);
    }

    public function delete($id)
    {
        DrpReport::find($id)->delete();
        return $this->apiResponse(["message" => "Completed"]);
    }
}
