<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mayor extends Model
{
    use HasFactory;

    protected $fillable = [
      'full_name',
      'birthdate',
      'image',
      'place_birth',
      'recruitment',
      'term_responsibility',
      'status',
    ];
}
