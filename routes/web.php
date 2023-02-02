<?php

use App\Http\Controllers\Admin\Content\MenuController;
use App\Http\Controllers\Admin\Content\PlaceController;
use App\Http\Controllers\Admin\Content\PublicCallController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Content\NewsController;
use App\Http\Controllers\Admin\Content\SliderController;
use App\Http\Controllers\Admin\User\UserController;

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

require __DIR__.'/auth.php';

// admin routes
Route::prefix('admin')->as('admin.')->middleware(['auth' , 'auth.admin'])->group(function () {
    
    Route::get('/', fn() => view('admin.index'))->name('index');

    // content module routes
    Route::prefix('content')->as('content.')->group(function () {

        // news routes
        Route::resource('news', NewsController::class)->except('show');
        
        // place routes
        Route::resource('places', PlaceController::class)->except('show');
        
        // menu routes
        Route::resource('menus', MenuController::class)->except('show');

        // public call routes
        Route::resource('public-calls', PublicCallController::class)->except('show');
        
        // slider routes  
        Route::resource('sliders', SliderController::class)->except('show');
        Route::get('sliders/{slider}/is_draft', [SliderController::class, 'is_draft'])->name('sliders.is_draft');
        
    });

    // user module routes
    Route::prefix('user')->as('user.')->group(function () {
        Route::resource('users', UserController::class)->except('show');
        Route::post('change-password/{user}', [UserController::class, 'changePassword'])->name('change-password')->middleware('password.confirm');
    });

});

