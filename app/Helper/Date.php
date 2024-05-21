<?php


use Morilog\Jalali\Jalalian;

function Shamsi2Miladi($date , $format='Y/m/d H:i:s')
{
    return Jalalian::fromFormat($format, P2E($date))->toCarbon()->format($format);
}
