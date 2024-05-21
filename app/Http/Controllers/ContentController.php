<?php

namespace App\Http\Controllers;

use App\Classes\DataTable\DataTableInterface;
use App\Http\Requests\ContentRequest;
use App\Models\Content;
use Illuminate\Support\Facades\Auth;

class ContentController extends Controller
{
    private DataTableInterface $dataTable;

    public function __construct(DataTableInterface $dataTable)
    {
        $this->dataTable = $dataTable;
    }

    public function edit($id)
    {
        $model = Content::find($id);
        return view("admin.content.edit", compact("model"));
    }

    public function index()
    {
        return view("admin.content.index");
    }

    public function update(ContentRequest $request, $id)
    {
        if($request->file('image')) {
            $fileName = time() . '.' . $request->image->extension();
            $request->file('image')->storeAs('contents', $fileName, 'public');
            $request["image"] = $fileName;
        }
         Content::where("id", $id)->update($request->update());
        return back()->with('success', 'محتوای سایت با موفقیت ویرایش شد.');
    }

    public function dataTable()
    {
        return $this->dataTable->build();
    }
}
