<?php

namespace App\Http\Controllers;

use App\Classes\DataTable\DataTableInterface;
use App\Http\Requests\PatientDrugRequest;
use App\Models\Patient;
use App\Models\PatientDrug;
use App\Models\User;
use Illuminate\Http\Request;

class PatientDrugController extends Controller
{
    private DataTableInterface $dataTable;

    public function __construct(DataTableInterface $dataTable)
    {
        $this->dataTable = $dataTable;
    }

    public function view($id)
    {
        $models=PatientDrug::with("Patient")->where("patient_id",$id)->get();
        return  view("admin.patientDrug.view",compact("models"));
    }
    public function edit($id)
    {
        $users=User::all();
        $patients=Patient::all();
        $model=PatientDrug::find($id);
        return  view("admin.patientDrug.edit",compact("model" , "patients" , "users"));
    }
    public function index()
    {
        return view("admin.patientDrug.index");
    }
    public function create()
    {
        $users=User::all();
        $patients=Patient::all();
        return view("admin.patientDrug.create",compact("patients" , "users"));
    }

    public function update(PatientDrugRequest $request ,$id)
    {
        PatientDrug::where("id", $id)
            ->update($request->update());
        return back()->with('success', 'تلفیق دارویی بیمار با موفقیت ویرایش شد.');
    }

    public function store(PatientDrugRequest $request)
    {
        PatientDrug::create($request->store());
        return back()->with('success', 'تلفیق دارویی بیمار با موفقیت ثبت شد.');
    }

    public function dataTable()
    {
        return $this->dataTable->build();

    }
}
