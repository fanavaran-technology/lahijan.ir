<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Url;

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

    // scopes
    public function scopeWherePublished($query)
    {
        $query->where('status', 1)->where('published_at', '<=', now());
    }

    // accessor 
    public function setUrlAttribute($url)
    {
        str_contains($url, URL::to('/')) ? 
            $this->attributes['url'] = str_replace(URL::to('/'), '', $url) : $this->attributes['url'] = $url;
    }
   


    
}
