<?php

namespace App\Http\Controllers;

use App\Classes\DataTable\DataTableInterface;
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
        $model=PatientDrug::with("Patient")->find($id);
        return  view("admin.patientDrug.view",compact("model"));
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

    public function update(Request $request ,$id)
    {
        $this->validate($request, [
            "id" => "required ",
            "type" => "required",
            "user_id" => "required",
            "name" => "required",
            "patient_id" => "required",
            "usage_intervals" => "required",
            "dose_amount" => "required",
            "has_alert" => "required",
            "description" => "required",
        ]);

        PatientDrug::where("id", $request->id)
            ->update([
                "type" => $request->type,
                "user_id" => $request->user_id,
                "name" => $request->name,
                "patient_id" => $request->patient_id,
                "usage_intervals" => $request->usage_intervals,
                "dose_amount" => $request->dose_amount,
                "has_alert" => $request->has_alert,
                "description" => $request->description,
                "drug_id" => $request->drug_id,
                "last_dose_date" => $request->last_dose_date,
                "doctor_order" => $request->doctor_order,

            ]);
        return back()->with('success', 'تلفیق دارویی بیمار با موفقیت ویرایش شد.');

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "type" => "required",
            "user_id" => "required",
            "name" => "required",
            "patient_id" => "required",
            "usage_intervals" => "required",
            "dose_amount" => "required",
            "has_alert" => "required",
            "description" => "required",
        ]);
        PatientDrug::create([
            "type" => $request->type,
            "user_id" => $request->user_id,
            "name" => $request->name,
            "patient_id" => $request->patient_id,
            "usage_intervals" => $request->usage_intervals,
            "dose_amount" => $request->dose_amount,
            "has_alert" => $request->has_alert,
            "description" => $request->description,
            "drug_id" => $request->drug_id,
            "last_dose_date" => $request->last_dose_date,
            "doctor_order" => $request->doctor_order,
            "created_date" => date("Y-m-d H:i:s", time())
        ]);
        return back()->with('success', 'تلفیق دارویی بیمار با موفقیت ثبت شد.');


    }

    public function dataTable()
    {
        return $this->dataTable->build();

    }
}
