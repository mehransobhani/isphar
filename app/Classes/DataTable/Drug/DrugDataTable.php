<?php

namespace App\Classes\DataTable\Drug;

use App\Classes\DataTable\DataTableInterface;
use App\Models\Drug;
use Yajra\DataTables\DataTables;

class DrugDataTable  implements  DataTableInterface
{

    public function build()
    {
        $model = Drug::query();
        return DataTables::of($model)
            ->addColumn('edit', function ($data) {
                return "<a class='btn btn-danger waves-effect waves-light' href='" . route('drug.edit', $data->id) . "'>ویرایش</a>";
            })
            ->editColumn('created_at', function ($data) {
                return verta($data->created_at)->format('Y/m/d-H:i');
            })
            ->rawColumns(['edit'])

            ->make(true);
    }
}
