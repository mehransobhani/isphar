<?php
function userId()
{
    return auth()->user()->id;
}
function user()
{
    return auth()->user();
}
