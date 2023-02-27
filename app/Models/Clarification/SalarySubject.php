<?php

namespace App\Models\Clarification;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalarySubject extends Model
{
    use HasFactory , Sluggable;

    protected $fillable = [
        'title',
        'description'
    ];

    protected $with = ['perssonels'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function publicPath()
    {
        return route('clarification.salary.show' , $this->slug);
    }

    public function perssonels()
    {
        return $this->belongsToMany(Perssonel::class , 'perssonel_salary')->withPivot('amount');
    }

    public function getAmount($perssonel_id) {
        return $this->perssonels->where('id' , $perssonel_id)->first()->pivot->amount ?? '';
    }
}
