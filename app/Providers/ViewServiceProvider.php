<?php

namespace App\Providers;

use App\Models\Content\Menu;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('app.layouts.includes.navbar', function ($view) {
            $menus = Menu::all();

            $view->with(
                [
                    'menus' => $menus,
                ]
            );
        });
    }
}
