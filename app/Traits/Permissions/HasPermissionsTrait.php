<?php

namespace App\Traits\Permissions;

use App\Models\ACL\Role;
use App\Models\ACL\Permission;

trait HasPermissionsTrait{

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    protected function permissions(){
        return $this->belongsToMany(Permission::class);
    }

    protected function hasPermission($permission)
    { 
        return (bool) $this->permissions->where('key' , $permission->key)->count();
    }

    public function hasPermissionTo($permission)
    {
        return $this->hasPermission($permission) || $this->hasPermissionThroughRole($permission);
    }

    public function hasPermissionThroughRole($permission)
    {
        foreach ($permission->roles as $role) {
            if ($this->roles->contains($role)) {
                return true;
            }
        }
        return false;
    }

    public function hasRole(...$roles)
    { 
        foreach($roles as $role)  {
            if($this->roles->contains('name' , $role))
            {
                return true;
            }
        }
        return false;
    }

 

}

?>