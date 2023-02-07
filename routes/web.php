<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\User\RoleController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Admin\Content\MenuController;
use App\Http\Controllers\Admin\Content\NewsController;
use App\Http\Controllers\Admin\Content\PageController;
use App\Http\Controllers\Admin\Content\PlaceController;
use App\Http\Controllers\Admin\Content\SliderController;
use App\Http\Controllers\Admin\Content\PublicCallController;

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
        Route::get('news/{news}/gallery', [NewsController::class, 'indexGallery'])->name('news.index-gallery');
        Route::post('news/{news}/create-gallery', [NewsController::class, 'createGallery'])->name('news.create-gallery');
        Route::delete('news/destroy-gallery/{gallery}', [NewsController::class, 'destroyGallery'])->name('news.destroy-gallery');
        
        // place routes
        Route::resource('places', PlaceController::class)->except('show');
        Route::get('places/{place}/gallery', [PlaceController::class, 'indexGallery'])->name('places.index-gallery');
        Route::post('places/{place}/create-gallery', [PlaceController::class, 'createGallery'])->name('places.create-gallery');
        Route::delete('places/destroy-gallery/{gallery}', [PlaceController::class, 'destroyGallery'])->name('places.destroy-gallery');
        
        // menu routes
        Route::resource('menus', MenuController::class)->except('show');

        // public call routes
        Route::resource('public-calls', PublicCallController::class)->except('show');
        
        // slider routes  
        Route::resource('sliders', SliderController::class)->except('show');
        Route::get('sliders/{slider}/is_draft', [SliderController::class, 'is_draft'])->name('sliders.is_draft');

        // page routes  
        Route::resource('pages', PageController::class)->except('show');
        Route::get('pages/{page}/is_draft', [PageController::class, 'is_draft'])->name('pages.is_draft');
        Route::get('pages/{page}/is_quick_access', [PageController::class, 'isQuickAccess'])->name('pages.is_quick_access');
        
    });

    // user module routes
    Route::prefix('user')->as('user.')->group(function () {
        Route::resource('users', UserController::class)->except('show');
        Route::post('change-password/{user}', [UserController::class, 'changePassword'])->name('change-password')->middleware('password.confirm');
        Route::get('permissions/{user}', [UserController::class, 'permissions'])->name('uesrs.permissions');
        Route::post('permissions/{user}/store', [UserController::class, 'permissionStore'])->name('users.permissions.store');

        //role
        Route::resource('roles', RoleController::class)->except('show');
        Route::get('roles/{role}/permission-form', [RoleController::class, 'permissionForm'])->name('roles.permission-form');
        Route::put('roles/{role}/permission-update', [RoleController::class, 'permissionUpdate'])->name('roles.permission-update');


        //permission
        // Route::resource('permission', PermissionController::class)->except('show');


    });

});

