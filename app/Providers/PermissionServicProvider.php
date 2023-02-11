<?php

namespace App\Providers;

use Exception;
use App\Models\ACL\Permission;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;
use Database\Seeders\PermissionSeeder;
use Illuminate\Support\ServiceProvider;


class PermissionServicProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        try {

            Permission::get()->map(function ($permission) {
            Gate::define($permission->key, function ($user) use ($permission){
                    return $user->is_admin ? true : $user->hasPermissionTo($permission);
                });
            });

        } catch (Exception $e) {
            report($e);
            return false;
        }

        
        
    }
}

    
