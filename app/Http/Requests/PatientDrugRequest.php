<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientDrugRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "type" => "required",
            "user_id" => "required",
            "name" => "required",
            "patient_id" => "required",
            "usage_intervals" => "required",
            "dose_amount" => "required",
            "has_alert" => "required",
            "description" => "required",
        ];
    }
    public function store()
    {
        $data=$this->input();
        unset($data["_token"]);
        $data["created_at"]=date("Y-m-d H:i:s", time());
        return $data;
    }
    public function update()
    {
        $data=$this->input();
        unset($data["_token"]);
        unset($data["_method"]);
        return $data;
    }
    public function authorize(): bool
    {
        return true;
    }
}
