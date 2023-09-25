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
        'description',
        'is_answered',
        'answer',
        'referenced_at',
        'answered_at'
    ];



}
