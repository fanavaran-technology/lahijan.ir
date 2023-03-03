<?php

use App\Http\Controllers\Clarification\ClarificationController;
use App\Http\Controllers\Admin\Clarification\ContractController;
use App\Http\Controllers\Admin\Clarification\PerssonelController;
use App\Http\Controllers\Admin\Clarification\SalaryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Content\HomeController;
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
use App\Http\Controllers\Content\NewsController as PublicNewsController;
use App\Http\Controllers\Content\SearchController as PublicSearchController;
use App\Http\Controllers\Content\PublicCallController as indexPublicCallController;
use App\Http\Controllers\Content\placeController as PublicPlaceController;
use Rap2hpoutre\LaravelLogViewer\LogViewerController;
use App\Http\Controllers\Content\PageController as PublicPageController;

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
require __DIR__ .'/auth.php';

Route::prefix('shafaf')->group(function () {
    Route::get('/', [ClarificationController::class, 'index'])->name('clarification.index');
    Route::get('/salaries', [ClarificationController::class, 'salary'])->name('clarification.salary');
    Route::get('/salaries/{salarySubject:slug}', [ClarificationController::class, 'showSalary'])->name('clarification.salary.show');
    Route::get('/contracts', [ClarificationController::class, 'contract'])->name('clarification.contract');
    Route::get('/contracts/{contract:slug}', [ClarificationController::class, 'showContract'])->name('clarification.contract.show');
});

// admin routes
Route::prefix('admin')->as('admin.')->middleware(['auth', 'auth.admin'])->group(function () {

    Route::get('/', AdminDashboardController::class)->name('index');

    // content module routes
    Route::prefix('content')->as('content.')->group(function () {
        Route::resources([
            'news' => NewsController::class,
            'places' => PlaceController::class,
            'menus' => MenuController::class,
            'public-calls' => PublicCallController::class,
            'sliders' => SliderController::class,
            'pages' => PageController::class,
        ], ['except' => 'show']);

        // news gallery routes
        Route::get('news/{news}/gallery', [NewsController::class, 'indexGallery'])->name('news.index-gallery');
        Route::post('news/{news}/create-gallery', [NewsController::class, 'createGallery'])->name('news.create-gallery');
        Route::delete('news/destroy-gallery/{gallery}', [NewsController::class, 'destroyGallery'])->name('news.destroy-gallery');
        Route::post('news/upload-video' , [NewsController::class , 'uploadVideo'])->name('news.upload-video');
        Route::delete('news/{news}/destroy-video' , [NewsController::class , 'destroyVideo'])->name('news.destroy-video');
        Route::post('news/upload-video', [NewsController::class, 'uploadVideo'])->name('news.upload-video');
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

    Route::prefix('clarification')->as('clarification.')->group(function () {
        Route::resources([
            'perssonels' => PerssonelController::class,
            'salaries' => SalaryController::class,
            'contracts' => ContractController::class
        ], ['except' => 'show']);

        Route::get('perssonels/{perssonel}/disable', [PerssonelController::class, 'disable'])->name('perssonels.disable');

        Route::post('file-import', [PerssonelController::class, 'fileImport'])->name('file-import');


    });

    // user module routes
    Route::prefix('user')->as('user.')->group(function () {
        Route::resources([
            'users' => UserController::class,
            'roles' => RoleController::class,
        ], ['except' => 'show']);

        Route::get('users/{user}/block', [UserController::class, 'block'])->name('users.is_block');

        Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::post('change-password/{user}', ChangePasswordController::class)->name('change-password');
    });

    // setting routes
    Route::resource('settings', SettingController::class)->only('index', 'store');

    Route::get('logs', [LogViewerController::class, 'index'])->name('logs')->middleware('can:log');
});

# public routes
# index route
Route::get("/", [HomeController::class, 'home'])->name('home');

Route::resource('news', PublicNewsController::class)->parameters(['news' => 'news:slug'])->only('index', 'show');
Route::get('tags/{tag:title}', [PublicNewsController::class, 'tag'])->name('news.tag');

Route::resource('public-calls', indexPublicCallController::class)->parameters(['public-calls' => 'public-calls:slug'])->only('index', 'show');

Route::resource('places', PublicPlaceController::class)->parameters(['places' => 'place:slug'])->only('index', 'show');

Route::get('search', PublicSearchController::class)->name('search');

Route::get('/{page:slug}', PublicPageController::class)->name('page');

