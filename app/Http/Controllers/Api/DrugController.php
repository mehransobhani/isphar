<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Drug;
use Illuminate\Http\Request;

class DrugController extends Controller
{
    public function search(Request $request)
    {
        $query=$request->q;
        $patient=Drug::whereRaw("fa_name","like %$query%")->paginate();
        return $this->apiResponse(["data"=>$patient]);
    }
}
