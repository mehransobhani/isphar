<?php

namespace App\Http\Controllers;

use App\Classes\DataTable\DataTableInterface;
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

    public function update(Request $request)
    {
        $this->validate($request, [
            "password" => "required",
            "mobile" => "required",
        ]);

        User::where("id", $request->id)
            ->update([
                 "mobile" => $request->mobile,
                "password" => $request->password,
                "name" => $request->name,
                "tell" => $request->tell,
                "pharmacist_firstname" => $request->pharmacist_firstname,
                "pharmacist_lastname" => $request->pharmacist_lastname,
                "medical_code" => $request->medical_code,
                "sign_image" => $request->sign_image,
            ]);
        return back()->with('success', 'کاربر با موفقیت ویرایش شد.');

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "password" => "required",
            "mobile" => "required",
        ]);
        User::create([
            "mobile" => $request->mobile,
            "password" => $request->password,
            "name" => $request->name,
            "tell" => $request->tell,
            "pharmacist_firstname" => $request->pharmacist_firstname,
            "pharmacist_lastname" => $request->pharmacist_lastname,
            "medical_code" => $request->medical_code,
            "sign_image" => $request->sign_image,
            "created_at" => date("Y-m-d H:i:s", time())
        ]);
        return back()->with('success', 'کاربر با موفقیت ثبت شد.');


    }

    public function dataTable()
    {
        return $this->dataTable->build();
    }
}
