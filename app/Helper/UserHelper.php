<?php
function userId()
{
    return auth()->user()->id;
}
function myUser()
{
    return auth()->user();
}
