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

    // set data before store to database
    public function setPublishedAtAttribute($published_at)
    {
        $correctPublishedAt = substr($published_at , 0, -3);
        $this->attributes['published_at'] = date('Y-m-d H:i:s', $correctPublishedAt);
    }

    // relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    // scopes
    public function scopeWherePublished($query)
    {
        $query->where('is_draft', 0)->where('published_at', '<=', now());
    }

    // accessors
    public function getPublishStatusAttribute()
    {
        return $this->published_at <= now() ? 'منتشر شده' : jalaliDate($this->published_at, "%Y/%m/%d H:i:s");
    }

    public function gallerizable()
    {
        return $this->morphMany(Gallery::class, 'gallerizable');
    }
}
