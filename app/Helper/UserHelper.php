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
    var_dump($array);
    foreach($array as $key=>$value){
        if($value=="null"){
            unset($array[$key]);
        }
    }
    return array_values($array);
}