<?php

namespace App\Http\Controllers;

use App\Models\PatientSpecialCondition;
use Yajra\DataTables\DataTables;

class PatientSpecialConditionController extends Controller
{
    public function view($id)
    {
        $model=PatientSpecialCondition::with("Patient")->find($id);
        return  view("admin.patientSpecialCondition.view",compact("model"));
    }
    public function edit($id)
    {
        $model=PatientSpecialCondition::with("Patient")->find($id);
        return  view("admin.patientSpecialCondition.edit",compact("model"));
    }
    public function index()
    {
        return view("admin.patientSpecialCondition.index");
    }
    public function create()
    {
        return view("admin.patientSpecialCondition.create");
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
                "naresayi_koliavi" => $request->naresayi_koliavi,
                "masrafe_sigar" => $request->masrafe_sigar,
                "kambode_g6pd" => $request->kambode_g6pd,
                "naresayi_kabedi" => $request->naresayi_kabedi,
                "radiology" => $request->radiology,
                "masrafe_alcol" => $request->masrafe_alcol,
                "hasasiate_daruyi" => $request->hasasiate_daruyi,
                "hasasiate_daruyi_desc" => $request->hasasiate_daruyi_desc,
                "soe_masrafe_mavad" => $request->soe_masrafe_mavad,
                "soe_masrafe_mavad_desc" => $request->soe_masrafe_mavad_desc,
                "bardari" => $request->bardari,
                "bardari_weeks" => $request->bardari_weeks,
                "anti_biotic" => $request->anti_biotic,
                "anti_biotic_name" => $request->anti_biotic_name,
                "shirdehi" => $request->shirdehi,
                "vaksan" => $request->vaksan,
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
            "naresayi_koliavi" => $request->naresayi_koliavi,
            "masrafe_sigar" => $request->masrafe_sigar,
            "kambode_g6pd" => $request->kambode_g6pd,
            "naresayi_kabedi" => $request->naresayi_kabedi,
            "radiology" => $request->radiology,
            "masrafe_alcol" => $request->masrafe_alcol,
            "hasasiate_daruyi" => $request->hasasiate_daruyi,
            "hasasiate_daruyi_desc" => $request->hasasiate_daruyi_desc,
            "soe_masrafe_mavad" => $request->soe_masrafe_mavad,
            "soe_masrafe_mavad_desc" => $request->soe_masrafe_mavad_desc,
            "bardari" => $request->bardari,
            "bardari_weeks" => $request->bardari_weeks,
            "anti_biotic" => $request->anti_biotic,
            "anti_biotic_name" => $request->anti_biotic_name,
            "shirdehi" => $request->shirdehi,
            "vaksan" => $request->vaksan,
            "vaksan_name" => $request->vaksan_name,
            "created_date" => date("Y-m-d H:i:s", time())
        ]);
        return back()->with('success', 'بیمار با موفقیت ثبت شد.');


    }

    public function dataTable()
    {
        $model = PatientSpecialCondition::with("PatientSpecialCondition")->get();
        return DataTables::of($model)
            ->make(true);
    }
}
