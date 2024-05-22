<?php

namespace App\Http\Controllers;

use App\Classes\DataTable\DataTableInterface;
use App\Http\Requests\DrugRequest;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\PostCat;

class PostController extends Controller
{


    private DataTableInterface $dataTable;

    public function __construct(DataTableInterface $dataTable)
    {
        $this->dataTable = $dataTable;
    }

    public function edit($id)
    {
        $cats=PostCat::all();

        $model = Post::find($id);
        return view("admin.post.edit", compact("model","cats"));
    }

    public function delete($id)
    {
        Post::find($id)->delete();
        return redirect(route("postindex"));
    }

    public function index()
    {
        return view("admin.post.index");
    }

    public function create()
    {
        $cats=PostCat::all();
        return view("admin.post.create" , compact("cats"));
    }

    public function update(PostRequest $request, $id)
    {
        if($request->file('image')) {
            $fileName = time() . '.' . $request->image->extension();
            $request->file('image')->storeAs('post_cat', $fileName, 'public');
            $request["image"] = $fileName;
        }
        Post::where("id", $id)->update($request->update());
        return back()->with('success', 'بلاگ با موفقیت ویرایش شد.');
    }

    public function store(PostRequest $request)
    {
        if($request->file('image')) {
            $fileName = time() . '.' . $request->image->extension();
            $request->file('image')->storeAs('post_cat', $fileName, 'public');
            $request["image"] = $fileName;
        }
        Post::create($request->store());
        return back()->with('success', 'بلاگ با موفقیت ثبت شد.');
    }

    public function dataTable()
    {
        return $this->dataTable->build();
    }
}
