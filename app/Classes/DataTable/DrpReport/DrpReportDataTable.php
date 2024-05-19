<?php

namespace App\Classes\DataTable\DemoRequest;

use App\Classes\DataTable\DataTableInterface;
use App\Models\DrpReport;
use Yajra\DataTables\DataTables;

class DrpReportDataTable implements DataTableInterface
{

    public function build()
    {
        $model = DrpReport::query();
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
