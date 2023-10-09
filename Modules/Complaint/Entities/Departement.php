<?php

namespace Modules\Complaint\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Departement extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

}
