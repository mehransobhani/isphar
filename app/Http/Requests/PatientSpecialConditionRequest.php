<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientSpecialConditionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "weight" => "required",
            "user_id" => "required",
            "height" => "required",
            "patient_id" => "required",
        ];
    }

    private function checkBoxHandle($data)
    {
        $data["naresayi_koliavi"]=$data["naresayi_koliavi"]??0;
        $data["masrafe_sigar"]=$data["masrafe_sigar"]??0;
        $data["kambode_g6pd"]=$data["kambode_g6pd"]??0;
        $data["naresayi_kabedi"]=$data["naresayi_kabedi"]??0;
        $data["radiology"]=$data["radiology"]??0;
        $data["masrafe_alcol"]=$data["masrafe_alcol"]??0;
        $data["hasasiate_daruyi"]=$data["hasasiate_daruyi"]??0;
        $data["soe_masrafe_mavad"]=$data["soe_masrafe_mavad"]??0;
        $data["bardari"]=$data["bardari"]??0;
        $data["anti_biotic"]=$data["anti_biotic"]??0;
        $data["shirdehi"]=$data["shirdehi"]??0;
        $data["vaksan"]=$data["vaksan"]??0;
        return $data;
     }
    public function store()
    {
        $data=$this->input();
        unset($data["_token"]);
        $data["created_at"]=date("Y-m-d H:i:s", time());
        $data=$this->checkBoxHandle($data);
        return $data;
    }
    public function update()
    {
        $data=$this->input();
        unset($data["_token"]);
        unset($data["_method"]);
        $data=$this->checkBoxHandle($data);
        return $data;
    }
    public function authorize(): bool
    {
        return true;
    }
}
