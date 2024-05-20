<?php

namespace App\Http\Controllers;

use App\Classes\DataTable\DataTableInterface;
use App\Http\Requests\DrpReportRequest;
use App\Models\DrpReport;
use App\Models\Patient;
use App\Models\User;

class DrpReportController extends Controller
{
    private DataTableInterface $dataTable;

    public function __construct(DataTableInterface $dataTable)
    {
        $this->dataTable = $dataTable;
    }

    public function edit($id)
    {
        $model = DrpReport::with("Patient")->find($id);
        $users = User::all();
        $patients = Patient::all();
        return view("admin.drpReport.edit", compact("model", "patients", "users"));
    }

    public function index()
    {
        return view("admin.drpReport.index");
    }

    public function create()
    {
        $users = User::all();
        $patients = Patient::all();
        return view("admin.drpReport.create", compact("patients", "users"));
    }

    public function update(DrpReportRequest $request, $id)
    {
        DrpReport::where("id", $id)->update($request->update());
        return back()->with('success', 'گزارش drp با موفقیت ویرایش شد.');
    }

    public function store(DrpReportRequest $request)
    {
        DrpReport::create($request->store());
        return back()->with('success', 'گزارش drp با موفقیت ثبت شد.');
    }

    public function dataTable()
    {
        return $this->dataTable->build();
    }
}
