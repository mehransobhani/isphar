<?php

namespace App\Classes\DataTable\Content;

use App\Classes\DataTable\DataTableInterface;
use App\Models\Content;
use Yajra\DataTables\DataTables;

class ContentDataTable implements DataTableInterface
{

    public function build()
    {
        $model = Content::query();
        return DataTables::of($model)
            ->addColumn('edit', function ($data) {
                return "<a class='btn btn-danger waves-effect waves-light' href='" . route('content.edit', $data->id) . "'>ویرایش</a>";
            })
            ->addColumn('image', function ($data) {
                return $data->image ? '<img style="width:100px;height:100px" src="' . asset('storage/contents/' . $data->image) . '" alt="Image" >' : " ";
            })
            ->rawColumns(['edit', "image"])
            ->make(true);
    }
}
