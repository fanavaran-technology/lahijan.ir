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

    protected $with = ['news'];

    // relations
    public function news()
    {
        return $this->belongsToMany(News::class);
    }
}
