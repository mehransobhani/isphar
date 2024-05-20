<?php

namespace App\Classes\DataTable\Content;

use App\Classes\DataTable\DataTableInterface;
use App\Models\Content;
use Yajra\DataTables\DataTables;

class ContentDataTable  implements  DataTableInterface
{

    public function build()
    {
        $model = Content::query();
        return DataTables::of($model)
            ->addColumn('edit', function ($data) {
                return "<a class='btn btn-danger waves-effect waves-light' href='" . route('content.edit', $data->id) . "'>ویرایش</a>";
            })

            ->rawColumns(['edit'])

            ->make(true);
    }
}
