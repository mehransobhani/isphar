<?php

namespace App\Http\Controllers;

use App\Classes\DataTable\DataTableInterface;
use App\Http\Requests\PatientSpecialConditionRequest;
use App\Models\Patient;
use App\Models\PatientSpecialCondition;
use App\Models\User;

class PatientSpecialConditionController extends Controller
{
    private DataTableInterface $dataTable;

    public function __construct(DataTableInterface $dataTable)
    {
        $this->dataTable = $dataTable;
    }

    public function view($id)
    {
        $model=PatientSpecialCondition::with("Patient")->find($id);
        return  view("admin.patientSpecialCondition.view",compact("model"));
    }
    public function edit($id)
    {
        $model=PatientSpecialCondition::with("Patient")->find($id);
        $users=User::all();
        $patients=Patient::all();
        return  view("admin.patientSpecialCondition.edit",compact("model","users","patients"));
    }
    public function index()
    {
        return view("admin.patientSpecialCondition.index");
    }
    public function create()
    {
        $users=User::all();
        $patients=Patient::all();
        return view("admin.patientSpecialCondition.create",compact( "users","patients"));
    }

    public function update(PatientSpecialConditionRequest $request ,$id)
    {
        PatientSpecialCondition::where("id", $id)
            ->update($request->update());
        return back()->with('success', 'بیمار با موفقیت ویرایش شد.');

    }

    public function store(PatientSpecialConditionRequest $request)
    {
        PatientSpecialCondition::create($request->store());
        return back()->with('success', 'بیمار با موفقیت ثبت شد.');
    }

    public function dataTable()
    {
        return $this->dataTable->build();

    }
}
