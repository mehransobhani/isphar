<?php

namespace App\Http\Controllers;

use App\Classes\DataTable\DataTableInterface;
use App\Http\Requests\PatientRequest;
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

    public function update(PatientRequest $request , $id)
    {
        Patient::where("id", $id)->update($request->update());
        return back()->with('success', 'بیمار با موفقیت ویرایش شد.');
    }

    public function store(PatientRequest $request)
    {
        Patient::create($request->store());
        return back()->with('success', 'بیمار با موفقیت ثبت شد.');
    }

    public function dataTable()
    {
        return $this->dataTable->build();
    }
}
