<?php

namespace Modules\Complaint\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = ['data' => 'array'];


}
