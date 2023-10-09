<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Modules\Complaint\Entities\Notification;
use Spatie\Backup\Notifications\Notifiable;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        view()->composer('admin.layouts.includes.navbar', function ($view){
            $view->with('notifications', Notification::where('read_at', null)->get());
        });
    }
}
