<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCatRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "title"=>"required",
            "alias"=>"required"
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
