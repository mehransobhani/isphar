<?php

namespace App\Classes\DataTable\DemoRequest;

use App\Classes\DataTable\DataTableInterface;
use App\Models\DemoRequest;
use Yajra\DataTables\DataTables;

class DemoRequestDataTable implements DataTableInterface
{

    public function build()
    {
        $model = DemoRequest::query();
        return DataTables::of($model)
            ->editColumn('is_followed_up', function ($data) {
                return $data->is_followed_up ? "بله" : "خیر";
            })
            ->editColumn('created_at', function ($data) {
                return verta($data->created_at)->format('Y/m/d-H:i');
            })->editColumn('delete', function ($data) {
                return
                    "<form  action='" . route("demoRequest.delete", $data->id) . "' method='delete'>
                           <button class='btn btn-danger waves-effect waves-light' >حذف</button>
                     </form>";
            })
            ->rawColumns(['is_followed_up', 'delete'])
            ->make(true);
    }
}
