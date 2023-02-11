<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gallery extends Model
{
    use HasFactory ;

    protected $fillable = ['alt' , 'image' , 'gallerizable_id' , 'gallerizable_type'];
    
    # relationships
    public function gallerizable()
    {
        return $this->morphTo();
    }
}
