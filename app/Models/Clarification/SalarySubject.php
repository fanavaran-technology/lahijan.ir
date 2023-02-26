<?php

namespace App\Models\Clarification;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalarySubject extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description'
    ];

    public function perssonels()
    {
        return $this->belongsToMany(Perssonel::class , 'perssonel_salary')->withPivot('amount');
    }

    public function getAmount($perssonel_id) {
        return $this->perssonels->where('id' , $perssonel_id)->first()->pivot->amount ?? '';
    }
}
