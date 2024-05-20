<?php

namespace App\Http\Controllers;

use App\Classes\DataTable\DataTableInterface;
use App\Models\Patient;
use App\Models\PatientSpecialCondition;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

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

    public function update(Request $request)
    {
        $this->validate($request, [
            "id" => "required ",
            "weight" => "required",
            "user_id" => "required",
            "height" => "required",
            "patient_id" => "required",
        ]);

        PatientSpecialCondition::where("id", $request->id)
            ->update([
                "user_id" => $request->user_id,
                "patient_id" => $request->patient_id,
                "height" => $request->height,
                "weight" => $request->weight,
                "naresayi_koliavi" => $request->naresayi_koliavi??0,
                "masrafe_sigar" => $request->masrafe_sigar??0,
                "kambode_g6pd" => $request->kambode_g6pd??0,
                "naresayi_kabedi" => $request->naresayi_kabedi??0,
                "radiology" => $request->radiology??0,
                "masrafe_alcol" => $request->masrafe_alcol??0,
                "hasasiate_daruyi" => $request->hasasiate_daruyi??0,
                "hasasiate_daruyi_desc" => $request->hasasiate_daruyi_desc,
                "soe_masrafe_mavad" => $request->soe_masrafe_mavad??0,
                "soe_masrafe_mavad_desc" => $request->soe_masrafe_mavad_desc,
                "bardari" => $request->bardari??0,
                "bardari_weeks" => $request->bardari_weeks,
                "anti_biotic" => $request->anti_biotic??0,
                "anti_biotic_name" => $request->anti_biotic_name,
                "shirdehi" => $request->shirdehi??0,
                "vaksan" => $request->vaksan??0,
                "vaksan_name" => $request->vaksan_name,

            ]);
        return back()->with('success', 'بیمار با موفقیت ویرایش شد.');

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "weight" => "required",
            "user_id" => "required",
            "height" => "required",
            "patient_id" => "required",
        ]);
        PatientSpecialCondition::create([
            "user_id" => $request->user_id,
            "patient_id" => $request->patient_id,
            "height" => $request->height,
            "weight" => $request->weight,
            "naresayi_koliavi" => $request->naresayi_koliavi??0,
            "masrafe_sigar" => $request->masrafe_sigar??0,
            "kambode_g6pd" => $request->kambode_g6pd??0,
            "naresayi_kabedi" => $request->naresayi_kabedi??0,
            "radiology" => $request->radiology??0,
            "masrafe_alcol" => $request->masrafe_alcol??0,
            "hasasiate_daruyi" => $request->hasasiate_daruyi??0,
            "hasasiate_daruyi_desc" => $request->hasasiate_daruyi_desc,
            "soe_masrafe_mavad" => $request->soe_masrafe_mavad??0,
            "soe_masrafe_mavad_desc" => $request->soe_masrafe_mavad_desc,
            "bardari" => $request->bardari??0,
            "bardari_weeks" => $request->bardari_weeks,
            "anti_biotic" => $request->anti_biotic??0,
            "anti_biotic_name" => $request->anti_biotic_name,
            "shirdehi" => $request->shirdehi??0,
            "vaksan" => $request->vaksan??0,
            "vaksan_name" => $request->vaksan_name,
            "created_at" => date("Y-m-d H:i:s", time())
        ]);
        return back()->with('success', 'بیمار با موفقیت ثبت شد.');


    }

    public function dataTable()
    {
        return $this->dataTable->build();

    }
}
