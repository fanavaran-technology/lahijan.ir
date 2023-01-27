<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slider extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'alt' ,
        'image' ,
        'url' , 
        'status',
        'published_at'
    ];

    
}
