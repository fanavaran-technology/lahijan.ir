<?php

namespace Modules\Complaint\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'national_code',
        'phone_number',
        'main_st',
        'auxiliary_st',
        'alley',
        'deadend',
        'builing_name',
        'postal_code',
        'tracking_code',
        'subject',
        'description',
    ];

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }


    // relationships
    public function files() 
    {
        return $this->hasMany(ComplaintFile::class);
    }

    public static function generateTrackingCode()
    {
        $randomNumber = rand(111111111, 999999999);

        while (Complaint::where('tracking_code', $randomNumber)->exists()) {
            $randomNumber = rand(111111111, 999999999);
        }

        return $randomNumber;
    }


}
