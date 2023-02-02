<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = ['alt' , 'image' , 'gallerizable_id' , 'gallerizable_type'];
    
    # relationships
    public function gallerizable()
    {
        return $this->morphTo();
    }
}
