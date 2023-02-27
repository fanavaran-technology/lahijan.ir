<?php
use Morilog\Jalali\Jalalian;

// get date function
if (!function_exists('jalaliDate')) {
    function jalaliDate($date, $format = "%Y/%m/%d")
    {
        return Jalalian::forge($date)->format($format);
    }
}

if (!function_exists('validateDate')) {
    function validateDate($date, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }
}