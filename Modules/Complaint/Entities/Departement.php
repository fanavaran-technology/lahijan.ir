<?php

namespace Modules\Complaint\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Departement extends Model
{
    use HasFactory;

    const HANDLER_PERMISSION = "complaint_handler";

    protected $fillable = ['title', 'description'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function userFails() 
    {
        return $this->hasMany(ComplaintUserFail::class);
    }

}
