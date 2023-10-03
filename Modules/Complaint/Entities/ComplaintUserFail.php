<?php

namespace Modules\Complaint\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class ComplaintUserFail extends Model
{
    use HasFactory;

    protected $table = "complaint_user_fails";

    protected $fillable = [
        'complaint_id',
        'user_id',
        'departement_id'
    ];

    // relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function complaint()
    {
        return $this->belongsTo(Complaint::class);
    }

    public function departement() 
    {
        return $this->belongsTo(Departement::class);
    } 

    
    protected static function newFactory()
    {
        return \Modules\Complaint\Database\factories\ComplaintUserFailFactory::new();
    }
}
