<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PatientController extends Controller
{
    public function index()
    {
        return view("admin.patient.index");
    }

    public function edit($id)
    {
        $model = Patient::find($id);
        return view("admin.patient.edit", compact("model"));
    }

    public function create()
    {
        return view("admin.patient.create");
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            "id" => "required ",
            "room_name" => "required",
            "fullname" => "required",
            "national_code" => "required",
            "birth_date" => "required",
            "gender" => "required",
            "admission_date" => "required",
            "file_number" => "required",
        ]);

        Patient::where("id", $request->id)
            ->update([
                "room_name" => $request->room_name,
                "fullname" => $request->fullname,
                "national_code" => $request->national_code,
                "birth_date" => $request->birth_date,
                "gender" => $request->gender,
                "admission_date" => $request->admission_date,
                "file_number" => $request->file_number
            ]);
        return back()->with('success', 'بیمار با موفقیت ثبت شد.');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "room_name" => "required",
            "fullname" => "required",
            "national_code" => "required",
            "birth_date" => "required",
            "gender" => "required",
            "admission_date" => "required",
            "file_number" => "required",
        ]);
        Patient::create([
            "room_name" => $request->room_name,
            "fullname" => $request->fullname,
            "national_code" => $request->national_code,
            "birth_date" => $request->birth_date,
            "gender" => $request->gender,
            "admission_date" => $request->admission_date,
            "file_number" => $request->file_number
        ]);
        return back()->with('success', 'بیمار با موفقیت ویرایش شد.');

    }

    public function dataTable()
    {
        $model = Patient::get();
        return DataTables::of($model)->editColumn('edit', function ($data) {
            return "<a class='btn btn-danger waves-effect waves-light' href='".route('patient.edit',$data->id)."'>ویرایش</a>";
        })
            ->rawColumns(['edit'])
            ->make(true);
    }
}
