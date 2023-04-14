<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Route;

class BladeServiceProvider extends ServiceProvider
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
        Blade::if('active', function ($routeName) {
            return str_contains(Route::currentRouteName(), $routeName);
        });

        Blade::if('request', function ($param) {
            return request($param);
        });

        Blade::directive('recaptcha' , function() {
            return '
                <script src="https://www.google.com/recaptcha/api.js?hl={{ app()->getLocale() }}" async defer></script>
                <section class="g-recaptcha" data-sitekey="{{ env("GOOGLE_RECAPTCHA_SITE_KEY") }}"></section>
            ';
        });

    }
}
