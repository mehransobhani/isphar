<?php

namespace App\Classes\DataTable\User;

use App\Classes\DataTable\DataTableInterface;
use App\Models\User;
use Yajra\DataTables\DataTables;

class UserDataTable implements DataTableInterface
{

    public function build()
    {
        $model = User::query();
        return DataTables::of($model)->editColumn('edit', function ($data) {
            return "<a class='btn btn-danger waves-effect waves-light' href='" . route('user.edit', $data->id) . "'>ویرایش</a>";
        })
            ->rawColumns(['edit'])
            ->make(true);
    }
}
