<?php


function P2E($input)
{
    $persianDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    $englishDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

    return str_replace($persianDigits, $englishDigits, $input);
}
function Dash2Slash($input)
{
   return str_replace("-","/",$input);
}
