<?php

namespace App\Models\Content;

use App\Models\Content\Gallery;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Place extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    protected $fillable = [

        'title',
        'image',
        'description',
        'location',
        'slug',
        'status'
    ];


    const SEARCH_KEY = 'title';

    protected $casts = [
        'image' => 'array',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    // temporary
    // TODO
    public function publicPath()
    {
        return route('news.show' , $this->id);
    }

    public function gallerizable()
    {
        return $this->morphMany(Gallery::class, 'gallerizable');
    }
}
