<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "room_name" => "required",
            "fullname" => "required",
            "national_code" => "required",
            "birth_date" => "required",
            "gender" => "required",
            "admission_date" => "required",
            "file_number" => "required",
        ];
    }

    public function store()
    {
        $data=$this->input();
        unset($data["_token"]);
        $data["created_date"]=date("Y-m-d H:i:s", time());
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
