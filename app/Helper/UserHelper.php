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
    for($k=0; $k<count($array); $k++){
        if($array[$k]=="null"){
            unset($array[$k]);
        }
    }
    return array_values($array);
}