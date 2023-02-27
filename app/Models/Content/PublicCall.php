<?php

namespace App\Models\Content;

use App\Models\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PublicCall extends Model
{
    use HasFactory , SoftDeletes , Sluggable;

    protected $fillable = [
        'title',
        'description',
        'published_at',
        'event_date',
        'image',
        'slug',
        'status',
        'user_id',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function publicPath()
    {
        return route('public-calls.show' , $this->slug);
    }


    const SEARCH_KEY = 'title';

    // set data before store to database
    public function setPublishedAtAttribute($published_at)
    {
        $correctPublishedAt = substr($published_at , 0, -3);
        $this->attributes['published_at'] = date('Y-m-d H:i:s', $correctPublishedAt);
    }

    public function setEventDateAttribute($event_date)
    {
        $correctEventDate = substr($event_date , 0, -3);
        $this->attributes['event_date'] = date('Y-m-d H:i:s', $correctEventDate);
    }

    // relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

     // accessors
     public function getPublishStatusAttribute()
     {
         return $this->published_at < now() ? 'منتشر شده' : jalaliDate($this->published_at, "%Y/%m/%d H:i:s");
     }
}
