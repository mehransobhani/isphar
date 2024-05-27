<?php

namespace App\Classes\sms;

use Illuminate\Support\Facades\Http;

class Sms
{
    public static function send($receptor, $message)
    {
        $data = array("receptor" => $receptor, "token" => $message, "template" => "");

        $url = "https://api.kavenegar.com/v1/".config("sms_setting.token")."/verify/lookup.json";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $jsonResponse = curl_exec($ch);
        curl_close($ch);
        dd($jsonResponse);



        $result = Http::post("http://api.kavenegar.com/v1/" . config("sms_setting.token") . "/verify/lookup.json", $data );
        dd($result->json());
        return $result->json();
    }
}
