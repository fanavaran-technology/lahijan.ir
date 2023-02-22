<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'video',
        'description'
    ];

    public function news()
    {
        return $this->belongsTo(News::class);
    }
}
