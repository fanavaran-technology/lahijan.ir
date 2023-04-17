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

    public function publicPath()
    {
        return route('sliders' , $this->url);
    }

    // accessors
    public function getPublishStatusAttribute()
    {
        return $this->published_at <= now() ? 'منتشر شده' : jalaliDate($this->published_at, "%Y/%m/%d H:i:s");
    }

    // scopes
    public function scopeWherePublished($query)
    {
        $query->where('status', 1)->where('published_at', '<=', now());
    }

    // accessor
    public function setUrlAttribute($url)
    {
        str_contains($url, request()->root()) ?
            $this->attributes['url'] = str_replace(request()->root(), '', $url) : $this->attributes['url'] = $url;
    }


}
