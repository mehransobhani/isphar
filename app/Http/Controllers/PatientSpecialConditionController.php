<?php

namespace App\Http\Controllers;

use App\Models\PatientSpecialCondition;

class PatientSpecialConditionController extends Controller
{
    public function view($id)
    {
        $model=PatientSpecialCondition::with("Patient")->find($id);
        return  view("admin.patientSpecialCondition.view",compact("model"));
    }
    public function edit($id)
    {
        $model=PatientSpecialCondition::with("Patient")->find($id);
        return  view("admin.patientSpecialCondition.edit",compact("model"));
    }
}
