<?php

namespace App\Classes\DataTable\DrpReport;

use App\Classes\DataTable\DataTableInterface;
use App\Models\DrpReport;
use Yajra\DataTables\DataTables;

class DrpReportDataTable implements DataTableInterface
{

    public function build()
    {
        $model = DrpReport::query()->with("user")->with("patient");
        return DataTables::of($model)

            ->editColumn('created_at', function ($data) {
            return verta($data->created_at)->format('Y/m/d-H:i');
        })
            ->addColumn('edit', function ($data) {
                return "<a class='btn btn-danger waves-effect waves-light' href='" . route('drp-report.edit', $data->id) . "'>ویرایش</a>";
            })
            ->rawColumns(['edit'])

            ->make(true);
    }
}
