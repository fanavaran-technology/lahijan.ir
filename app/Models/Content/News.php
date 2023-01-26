<?php

namespace App\Models\Content;

use App\Models\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use HasFactory , SoftDeletes , Sluggable;

    protected $fillable = [
        'title',
        'body',
        'image',
        'slug',
        'user_id',
        'published_at',
        'is_draft',
        'is_pined',
        'is_fire_station',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    // relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
