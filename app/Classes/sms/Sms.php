<?php

namespace App\Classes\sms;

use Illuminate\Support\Facades\Http;

class Sms
{
    public static function send($receptor, $message)
    {
        $data = [
            'receptor' => $receptor,
            'sender' => config("sms_setting.sender"),
            'message' => $message
        ];
        $result = Http::post("http://api.kavenegar.com/v1/" . config("sms_setting.token") . "/sms/send.json", $data);
        return $result->json();
    }
}
