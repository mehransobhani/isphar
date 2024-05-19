<?php

namespace App\Classes\DataTable\PatientSpecialCondition;

use App\Classes\DataTable\DataTableInterface;
use App\Models\PatientSpecialCondition;
use Yajra\DataTables\DataTables;

class PatientSpecialConditionDataTable implements  DataTableInterface
{

    public function build()
    {
        $model = PatientSpecialCondition::query()->with("patient")->with("user");
        return DataTables::of($model)
            ->addColumn('edit', function ($data) {
                return "<a class='btn btn-danger waves-effect waves-light' href='" . route('PatientSpecialCondition.edit', $data->id) . "'>ویرایش</a>";
            })
            ->rawColumns(['edit'])

            ->make(true);
    }
}
