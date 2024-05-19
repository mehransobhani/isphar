<?php

namespace App\Classes\DataTable\PatientSpecialCondition;

use App\Classes\DataTable\DataTableInterface;
use App\Models\PatientSpecialCondition;
use Yajra\DataTables\DataTables;

class PatientSpecialConditionDataTable implements  DataTableInterface
{

    public function build()
    {
        $model = PatientSpecialCondition::with("PatientSpecialCondition")->query();
        return DataTables::of($model)
            ->make(true);
    }
}
