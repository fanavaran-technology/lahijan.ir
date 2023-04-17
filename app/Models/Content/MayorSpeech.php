<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MayorSpeech extends Model
{
    use HasFactory;

    protected $table = 'mayors_speech';


    protected $fillable = [
        'full_name',
        'image',
        'description',
        'status',
    ];
}
