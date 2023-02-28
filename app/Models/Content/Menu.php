<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\URL;

class Menu extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'title' ,
        'parent_id' ,
        'url' ,
        'status'
    ];

    protected $with = ['childrens'];

    public function publicPath()
    {
        return route('home');
    }

    public function setUrlAttribute($url)
    {
        str_contains($url, URL::to('/')) ?
            $this->attributes['url'] = str_replace(URL::to('/'), '', $url) : $this->attributes['url'] = $url;
    }

    // relations
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id' , 'id');
    }

    public function childrens()
    {
        return $this->hasMany(Menu::class, 'parent_id' , 'id');
    }


    // accessor
    public function getParentMenuAttribute()
    {
        return $this->parent_id ? $this->parent->title : 'ندارد';
    }
}
