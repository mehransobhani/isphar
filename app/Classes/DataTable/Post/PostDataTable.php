<?php

namespace App\Classes\DataTable\Post;

use App\Classes\DataTable\DataTableInterface;
use App\Models\Drug;
use Yajra\DataTables\DataTables;

class PostDataTable  implements  DataTableInterface
{

    public function build()
    {
        $model = Drug::query();
        return DataTables::of($model)
            ->addColumn('edit', function ($data) {
                return "<a class='btn btn-danger waves-effect waves-light' href='" . route('post.edit', $data->id) . "'>ویرایش</a>";
            })
            ->editColumn('created_at', function ($data) {
                return verta($data->created_at)->format('Y/m/d-H:i');
            })
            ->editColumn('delete', function ($data) {
                return
                    "<form  action='" . route("post.delete", $data->id) . "' method='delete'>
                           <button class='btn btn-danger waves-effect waves-light' >حذف</button>
                     </form>";
            })
            ->rawColumns(['edit','delete'])


            ->make(true);
    }
}
