<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DrpReportRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "egfr_mdrd" => "required|numeric",
            "user_id" => "required|numeric",
            "egfr_ckd_epi" => "required|numeric",
            "patient_id" => "required|numeric",
            "crcl" => "required|numeric",
            "child_pough_score" => "required|numeric",
            "source" => "required",
            "form" => "required",
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
