<?php

namespace App\Models\Content;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Place extends Model
{
    use HasFactory , SoftDeletes , Sluggable;

    protected $fillable = [
        'title' , 
        'image' ,
        'description' ,
        'location' , 
        'slug',
        'status'
    ];

    protected $casts = [
        'image' => 'array' ,
    ];
    
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
