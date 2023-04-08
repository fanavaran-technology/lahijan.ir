<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Communication extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'full_name',
        'mobile',
        'description',
        'type',
        'address',
    ];

    const REQUEST_TYPES = [
        'انتقاد یا پیشنهاد',
        'درخواست',
        'ثبت شکایت',
        'تقدیر و تشکر'
    ];

}
