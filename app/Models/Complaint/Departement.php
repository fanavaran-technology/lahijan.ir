<?php

namespace App\Models\Complaint;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

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

    public function complaints() {
        return $this->HasMany(Complaint::class);
    }

}
