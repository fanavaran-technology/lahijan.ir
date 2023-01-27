<?php
use Morilog\Jalali\Jalalian;

// get date function
if (!function_exists('jalaliDate'))
{
    function jalaliDate($date,$format = "%Y/%m/%d")
    {
        return Jalalian::forge($date)->format($format);
    }
}