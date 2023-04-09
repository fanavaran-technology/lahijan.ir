<?php

namespace App\Models\Clarification;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestmentCategory extends Model
{
    use HasFactory;

    protected $fillable = ['title'];


    public function investments() 
    {
        return $this->hasMany(Investment::class, 'category_id');
    }

}
