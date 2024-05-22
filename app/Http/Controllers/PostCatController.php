<?php

namespace App\Http\Controllers;

use App\Classes\DataTable\DataTableInterface;
use App\Http\Requests\DrugRequest;
use App\Http\Requests\PostCatRequest;
use App\Models\PostCat;

class PostCatController extends Controller
{

    private DataTableInterface $dataTable;

    public function __construct(DataTableInterface $dataTable)
    {
        $this->dataTable = $dataTable;
    }

    public function edit($id)
    {
        $model = PostCat::find($id);
        return view("admin.postCat.edit", compact("model"));
    }

    public function delete($id)
    {
        PostCat::find($id)->delete();
        return redirect(route("postCat.index"));
    }

    public function index()
    {
        return view("admin.postCat.index");
    }

    public function create()
    {
        return view("admin.postCat.create");
    }

    public function update(PostCatRequest $request, $id)
    {
        if($request->file('image')) {
            $fileName = time() . '.' . $request->image->extension();
            $request->file('image')->storeAs('post_cat', $fileName, 'public');
            $request["image"] = $fileName;
        }
        PostCat::where("id", $id)->update($request->update());
        return back()->with('success', 'دسته بندی بلاگ با موفقیت ویرایش شد.');
    }

    public function store(PostCatRequest $request)
    {
        if($request->file('image')) {
            $fileName = time() . '.' . $request->image->extension();
            $request->file('image')->storeAs('post_cat', $fileName, 'public');
            $request["image"] = $fileName;
        }
        PostCat::create($request->store());
        return back()->with('success', 'دسته بندی بلاگ با موفقیت ثبت شد.');
    }

    public function dataTable()
    {
        return $this->dataTable->build();
    }
}
