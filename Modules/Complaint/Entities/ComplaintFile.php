<?php

namespace Modules\Complaint\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ComplaintFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'files'
    ];

    protected $casts = [
        'files' => 'array'
    ];

    // relationships
    public function complaint() 
    {
        return $this->belongsTo(Complaint::class);
    }
    
    protected static function newFactory()
    {
        return \Modules\Complaint\Database\factories\ComplaintFileFactory::new();
    }
}
