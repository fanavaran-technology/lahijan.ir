<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Content\NewsController;
use App\Http\Controllers\Admin\Content\SliderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// admin routes
Route::prefix('admin')->as('admin.')->group(function () {
    
    Route::get('/', fn() => view('admin.index'));

    Route::prefix('content')->as('content.')->group(function () {

        // news routes
        Route::resource('news', NewsController::class)->except('show');
        // slider routes  

        Route::resource('sliders', SliderController::class)->except('show');
        Route::get('sliders/{slider}/status', [SliderController::class, 'status'])->name('sliders.status');

        
    });
});