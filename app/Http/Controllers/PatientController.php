<?php

namespace App\Http\Controllers;

use App\Classes\DataTable\DataTableInterface;
use App\Models\Patient;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PatientController extends Controller
{
    private DataTableInterface $dataTable;

    public function __construct(DataTableInterface $dataTable)
    {
        $this->dataTable = $dataTable;
    }

    public function index()
    {
        return view("admin.patient.index");
    }

    public function edit(Patient $patient)
    {
        $model = $patient;
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
                "file_number" => $request->file_number,
                 "room_number" => $request->room_number,
                "bed_number" => $request->bed_number,
                "doctor" => $request->doctor,
                "cause" => $request->cause,
                "source" => $request->source,
                "source_number" => $request->source_number,
                "description" => $request->description,
            ]);
        return back()->with('success', 'بیمار با موفقیت ویرایش شد.');

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
            "file_number" => $request->file_number,
            "room_number" => $request->room_number,
            "bed_number" => $request->bed_number,
            "doctor" => $request->doctor,
            "cause" => $request->cause,
            "source" => $request->source,
            "source_number" => $request->source_number,
            "description" => $request->description,
            "created_date" => date("Y-m-d H:i:s", time())
        ]);
        return back()->with('success', 'بیمار با موفقیت ثبت شد.');


    }

    public function dataTable()
    {
        return $this->dataTable->build();
    }
}
