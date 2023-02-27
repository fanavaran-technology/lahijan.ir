<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Page extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    protected $fillable = [
        'title',
        'body',
        'slug',
        'user_id',
        'is_quick_access',
        'is_draft',
    ];

    const SEARCH_KEY = 'title';

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
        return route('page' , $this->slug);
    }

    // relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
