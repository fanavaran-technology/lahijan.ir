<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'title'
    ];

    // relations
    public function tags()
    {
        return $this->belongsToMany(News::class);
    }
}
