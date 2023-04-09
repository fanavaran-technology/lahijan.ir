<?php

namespace App\Models\Clarification;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category_id',
        'image',
        'investor_task',
        'municipality_task',
        'description',
        'position',
        'file',
        'start_date',
        'end_date',
    ];

    public function category() 
    {
        return $this->hasMany(InvestmentCategory::class, 'category_id');
    }


}
