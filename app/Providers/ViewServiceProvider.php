<?php

namespace App\Providers;

use App\Models\Communication;
use App\Models\Content\Menu;
use App\Models\Content\News;
use Illuminate\Support\ServiceProvider;
use Modules\Complaint\Entities\Notification;

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
        view()->composer('app.layouts.includes.top-nav', function ($view) {
            $latestNews = News::latest()->take(3)->wherePublished()->get();
            $view->with(
                [
                    'latestNews' => $latestNews,
                ]
            );
        });

        view()->composer('app.layouts.includes.navbar', function ($view) {
            $menus = Menu::all();
            $view->with(
                [
                    'menus' => $menus,
                ]
            );
        });

        view()->composer('admin.*', function ($view) {
            $communications = Communication::where('response', null)->take(10)->get();
            $myComplaintsCount = auth()->user()->complaints()->whereNull('answer')->count();
            $view->with(
                [
                    'communications' => $communications,
                    'myComplaintsCount' => $myComplaintsCount
                ]
            );
        });
    }
}
