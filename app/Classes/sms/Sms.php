<?php

namespace App\Classes\sms;

use Illuminate\Support\Facades\Http;

class Sms
{
    public static function send($receptor, $message)
    {
        $data = [
            'receptor' => $receptor,
            'sender' => config("kavenegar.sender"),
            'message' => $message
        ];
        $result = Http::post("http://api.kavenegar.com/v1/" . config("kavenegar.token") . "/sms/send.json", $data);
        return $result->json();
    }
}
