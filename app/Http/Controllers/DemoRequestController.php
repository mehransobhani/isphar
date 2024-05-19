<?php

namespace App\Http\Controllers;

use App\Models\DemoRequest;
use Yajra\DataTables\DataTables;

class DemoRequestController extends Controller
{
    public function index()
    {
        return view("admin.demoRequest.index");
    }

    public function dataTable()
    {
        $model=DemoRequest::get();
        return DataTables::of($model)->editColumn('is_followed_up', function ($data) {
            return $data->is_followed_up?"بله":"خیر";
        })
            ->rawColumns(['is_followed_up'])
            ->make(true);
    }
}
