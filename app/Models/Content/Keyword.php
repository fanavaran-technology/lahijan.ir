<?php

namespace App\Models\Content;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
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

    protected $with = ['pages'];

    public function pages()
    {
        return $this->belongsToMany(Page::class);
    }
}
