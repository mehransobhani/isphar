<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'fullname' => 'required|string',
            'national_code' => 'required|size:10|unique:patients|numeric',
            'birth_date' => 'required|date',
            'gender' => 'required|in:man,woman',
            'admission_date' => 'required|date',
            'file_number' => 'required|string',
            'room_name' => 'required|string',
        ];
    }

    public function store()
    {
        $data=$this->input();
        unset($data["_token"]);
        $data["created_date"]=date("Y-m-d H:i:s", time());
        $data["admission_date"]=Shamsi2Miladi($data["admission_date"] );
        $data["birth_date"]=Shamsi2Miladi($data["birth_date"],"Y/m/d");
        return $data;
    }
    public function update()
    {
        $data=$this->input();
        unset($data["_token"]);
        unset($data["_method"]);

        $data["admission_date"]=Shamsi2Miladi($data["admission_date"] );
        $data["birth_date"]=Shamsi2Miladi($data["birth_date"] );
        return $data;
    }

    public function authorize(): bool
    {
        return true;
    }
}
