<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerTheater extends Model
{
    use HasFactory;

    protected $fillable = [
        'alt',
        'image',
        'status'
    ];
}
