<?php
function userId()
{
    return auth()->user()->id;
}
function myUser()
{
    return auth()->user();
}
function removeNullFields($array){
    foreach($array as $key=>$value){
        if($value=="null"){
            unset($array[$key]);
        }
    }
    return $array;
}
function faToEnNumbers($params){
    $res = [];
    foreach($params as $key=>$value){
        $res[$key] = convertPersianArabicToEnglish($value);
    }
    return $res;
}

function convertPersianArabicToEnglish($input) {
    // Arrays mapping Persian and Arabic numerals to English numerals
    $persianNumbers = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    $arabicNumbers = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
    $englishNumbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

    // Replace Persian numerals with English numerals
    $output = str_replace($persianNumbers, $englishNumbers, $input);

    // Replace Arabic numerals with English numerals
    $output = str_replace($arabicNumbers, $englishNumbers, $output);

    return $output;
}