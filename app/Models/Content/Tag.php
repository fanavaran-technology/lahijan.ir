<?php

namespace App\Models\Content;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory , Sluggable;

    protected $fillable = [
        'title'
    ];

    public function sluggable(): array
    {
        return [
            'title' => [
                'source' => 'title'
            ]
        ];
    }

    protected $with = ['news'];

    public function publicPath() 
    {
        return route('news.tag' , $this->title);    
    }

    public function news()
    {
        return $this->belongsToMany(News::class);
    }
}
