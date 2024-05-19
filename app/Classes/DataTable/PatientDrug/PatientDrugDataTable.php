<?php

namespace App\Classes\DataTable\PatientDrug;

use App\Classes\DataTable\DataTableInterface;
use App\Models\PatientDrug;
use Yajra\DataTables\DataTables;

class PatientDrugDataTable implements DataTableInterface
{

    public function build()
    {
        $model = PatientDrug::query()->with("user")->with("patient");
        return DataTables::of($model)
            ->editColumn('created_at', function ($data) {
                return verta($data->created_at)->format('Y/m/d-H:i');
            })
            ->editColumn('user_id', function ($data) {
                return  ($data->user->name);
            })->editColumn('patient_id', function ($data) {
                return  ($data->patient->fullname);
            })
            ->addColumn('edit', function ($data) {
                return "<a class='btn btn-danger waves-effect waves-light' href='" . route('patient_drug.edit', $data->id) . "'>ویرایش</a>";
            })
            ->rawColumns(['edit'])

            ->make(true);
    }
}
