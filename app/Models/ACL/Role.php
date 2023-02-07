<?php

namespace App\Models\ACL;

use App\Models\User;
use App\Models\ACL\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'title',
        'description',  
    ];

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function permissions(){
        return $this->belongsToMany(Permission::class);
    }
}
