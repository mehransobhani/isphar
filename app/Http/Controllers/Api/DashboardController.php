<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DrpReport;
use App\Models\Patient;
use App\Models\Post;

class DashboardController extends  Controller
{
    public function index()
    {
        $lastDrp=DrpReport::latest('id')->limit(5)->get();
        $lastPatient=Patient::latest('id')->limit(5)->get();
        $lastPost=Post::latest('id')->limit(5)->get();
        return $this->apiResponse(["lastDrps"=>$lastDrp,"lastPatients"=>$lastPatient,"lastPosts"=>$lastPost]);
    }
}
