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
        'response'
    ];

    const REQUEST_TYPES = [
        'انتقاد یا پیشنهاد',
        'درخواست',
        'شکایت',
        'تقدیر و تشکر'
    ];

    public function getType()
    {
        return self::REQUEST_TYPES[(int) $this->type];
    }

}
