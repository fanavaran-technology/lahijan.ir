<?php

namespace App\Models\Clarification;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perssonel extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'job' ,
        'is_disable',
    ];

    public function salaries()
    {
        return $this->belongsToMany(SalarySubject::class , 'perssonel_salary');
    }

    public function getFullNameAttribute() {
        return "{$this->first_name} {$this->last_name}";
    }

    public function setBirthDateAttribute($birth_date)
    {
        $correct_birth_date = substr($birth_date , 0, -3);
        $this->attributes['birth_date'] = date('Y-m-d H:i:s', $correct_birth_date);
    }

    public function setEmployeementDateAttribute($employeement_date)
    {
        $correct_employeement_date = substr($employeement_date , 0, -3);
        $this->attributes['employeement_date'] = date('Y-m-d H:i:s', $correct_employeement_date);
    }
}
