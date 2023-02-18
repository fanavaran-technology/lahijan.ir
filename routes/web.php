<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\User\RoleController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Admin\Content\MenuController;
use App\Http\Controllers\Admin\Content\NewsController;
use App\Http\Controllers\Admin\Content\PageController;
use App\Http\Controllers\Admin\User\ProfileController;
use App\Http\Controllers\Admin\Content\PlaceController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\Content\SliderController;
use App\Http\Controllers\Admin\Content\PublicCallController;
use App\Http\Controllers\Admin\User\ChangePasswordController;

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

// temporary
// TODO
Route::get('/' , fn() => view('app.index'))->name('home');
Route::get('/login-view' , fn() => view('app.auth.login'))->name('auth.login');
Route::get('/confirm-view' , fn() => view('app.auth.confirm-password'))->name('auth.confirm');

require __DIR__.'/auth.php';

// admin routes
Route::prefix('admin')->as('admin.')->middleware(['auth' , 'auth.admin'])->group(function () {
    
    Route::get('/', AdminDashboardController::class)->name('index');

    // content module routes
    Route::prefix('content')->as('content.')->group(function () {
        Route::resources([
            'news'          =>  NewsController::class,
            'places'        =>  PlaceController::class,
            'menus'         =>  MenuController::class,
            'public-calls'  =>  PublicCallController::class,
            'sliders'       =>  SliderController::class,
            'pages'         =>  PageController::class, 
        ] , ['except' => 'show']);

        // news gallery routes
        Route::get('news/{news}/gallery', [NewsController::class, 'indexGallery'])->name('news.index-gallery');
        Route::post('news/{news}/create-gallery', [NewsController::class, 'createGallery'])->name('news.create-gallery');
        Route::delete('news/destroy-gallery/{gallery}', [NewsController::class, 'destroyGallery'])->name('news.destroy-gallery');        
        // place gallery routes
        Route::get('places/{place}/gallery', [PlaceController::class, 'indexGallery'])->name('places.index-gallery');
        Route::post('places/{place}/create-gallery', [PlaceController::class, 'createGallery'])->name('places.create-gallery');
        Route::delete('places/destroy-gallery/{gallery}', [PlaceController::class, 'destroyGallery'])->name('places.destroy-gallery');        
        // change slider status route  
        Route::get('sliders/{slider}/status', [SliderController::class, 'status'])->name('sliders.status');
        Route::get('places/{place}/status', [PlaceController::class, 'status'])->name('places.status');
        Route::get('public-calls/{publicCall}/status', [PublicCallController::class, 'status'])->name('publicCalls.status');
        Route::get('menus/{menu}/status', [MenuController::class, 'status'])->name('menus.status');
        Route::get('news/{news}/draft', [NewsController::class, 'draft'])->name('news.is_draft');
        Route::get('news/{news}/pined', [NewsController::class, 'pined'])->name('news.is_pined');
        // change page status route  
        Route::get('pages/{page}/is_draft', [PageController::class, 'is_draft'])->name('pages.is_draft');
        Route::get('pages/{page}/is_quick_access', [PageController::class, 'isQuickAccess'])->name('pages.is_quick_access');
        
    });

    // user module routes
    Route::prefix('user')->as('user.')->group(function () {
        Route::resources([
            'users'          =>  UserController::class,
            'roles'          =>  RoleController::class,
        ] , ['except' => 'show']);

        Route::get('users/{user}/block', [UserController::class, 'block'])->name('users.is_block');

        Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::post('change-password/{user}', ChangePasswordController::class)->name('change-password');
    });

    // setting routes
    Route::resource('settings' , SettingController::class)->only('index' , 'store');
});

# public routes
# index route
Route::get("/", [HomeController::class, 'home'])->name('home');


