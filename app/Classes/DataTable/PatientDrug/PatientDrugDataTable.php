<?php

namespace App\Classes\DataTable\PatientDrug;

use App\Classes\DataTable\DataTableInterface;
use App\Models\PatientDrug;
use Yajra\DataTables\DataTables;

class PatientDrugDataTable implements DataTableInterface
{

    public function build()
    {
        $model = PatientDrug::query();
        return DataTables::of($model)
            ->editColumn('is_followed_up', function ($data) {
            return $data->is_followed_up ? "بله" : "خیر";
        })
            ->editColumn('created_at', function ($data) {
            return verta($data->created_at)->format('Y/m/d-H:i');
        })
            ->rawColumns(['is_followed_up'])
            ->make(true);
    }
}
