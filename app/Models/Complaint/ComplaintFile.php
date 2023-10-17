<?php

namespace App\Models\Complaint;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ComplaintFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'files',
        'user_id'
    ];

    protected $casts = [
        'files' => 'array'
    ];

    // relationships
    public function complaint() 
    {
        return $this->belongsTo(Complaint::class);
    }
    
}