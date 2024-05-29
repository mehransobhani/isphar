<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientDrugRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'patient_id' => 'required|numeric',
            "user_id" => "required|numeric",
            'name' => 'required|string',
            'type' => 'required|string|in:1,2',
            'dose_amount' => 'required|string',
            'usage_intervals' => 'required|in:Daily,BD,TDS,QID,Every Other Day,Weekly,Monthly,PRN,نا مشخص,سایر',
            'has_alert' => 'required|in:0,1',
            'description' => 'required|string',
            'last_dose_date' => 'date',

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
