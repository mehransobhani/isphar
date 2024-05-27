<?php

namespace App\Classes\sms;

class Sms
{
    public static function send($receptor, $message)
    {
        $data = array("receptor" => $receptor, "token" => $message, "template" => config("sms_setting.template"));

        $url = "https://api.kavenegar.com/v1/".config("sms_setting.token")."/verify/lookup.json";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $jsonResponse = curl_exec($ch);
        curl_close($ch);
        return $jsonResponse;
    }
}
