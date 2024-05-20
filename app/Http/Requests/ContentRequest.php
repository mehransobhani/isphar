<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "location" => "required",
            "alias" => "required"
        ];
    }

    private function checkBoxHandle($data)
    {
        $data["has_title"]=$data["has_title"]??0;
        $data["has_subtitle"]=$data["has_subtitle"]??0;
        $data["has_content"]=$data["has_content"]??0;
        $data["has_image"]=$data["has_image"]??0;

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
