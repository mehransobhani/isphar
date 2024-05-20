<?php

namespace App\Http\Controllers;

use App\Classes\DataTable\DataTableInterface;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private DataTableInterface $dataTable;

    public function __construct(DataTableInterface $dataTable)
    {
        $this->dataTable = $dataTable;
    }

    public function index()
    {
        return view("admin.user.index");
    }

    public function edit($id)
    {
        $model = User::find($id);
        return view("admin.user.edit", compact("model"));
    }

    public function create()
    {
        return view("admin.user.create");
    }

    public function update(UserRequest $request , $id)
    {
        User::where("id",$id)
            ->update($request->update());
        return back()->with('success', 'کاربر با موفقیت ویرایش شد.');

    }

    public function store(UserRequest $request)
    {
        User::create($request->store());
        return back()->with('success', 'کاربر با موفقیت ثبت شد.');


    }

    public function dataTable()
    {
        return $this->dataTable->build();
    }
}
