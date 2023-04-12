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
        return $this->belongsTo(InvestmentCategory::class, 'category_id');
    }

    public function setStartDateAttribute($start_date)
    {
        $correctStartDate = substr($start_date , 0, -3);
        $this->attributes['start_date'] = date('Y-m-d H:i:s', $correctStartDate);
    }

    public function setEndDateAttribute($end_date)
    {
        $correctEndDate = substr($end_date , 0, -3);
        $this->attributes['end_date'] = date('Y-m-d H:i:s', $correctEndDate);
    }

}
