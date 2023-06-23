<?php


use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\Clarification\ContractController;
use App\Http\Controllers\Admin\Clarification\PerssonelController;
use App\Http\Controllers\Admin\Clarification\SalaryController;
use App\Http\Controllers\Admin\Content\BannerTheaterController;
use App\Http\Controllers\Admin\Content\CouncilMemberController;
use App\Http\Controllers\Admin\Clarification\InvestmentCategoryController;
use App\Http\Controllers\Admin\Clarification\InvestmentController;
use App\Http\Controllers\Clarification\ClarificationController;
use App\Http\Controllers\Communication\CommunicationController as AppCommunicationController;
use App\Http\Controllers\FireStation\FireStationController;
use App\Http\Controllers\FireStation\FireSliderController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Content\HomeController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\User\RoleController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Admin\Content\MenuController;
use App\Http\Controllers\Admin\Content\NewsController;
use App\Http\Controllers\Admin\Content\PageController;
use App\Http\Controllers\Admin\Content\PlaceController;
use App\Http\Controllers\Admin\Content\PublicCallController;
use App\Http\Controllers\Admin\Content\SliderController;
use App\Http\Controllers\Admin\Content\TheaterController;
use App\Http\Controllers\Admin\Content\MayorController;
use App\Http\Controllers\Admin\Content\MayorSpeechController;
use App\Http\Controllers\Admin\Communication\CommunicationController;
use App\Http\Controllers\Admin\User\ChangePasswordController;
use App\Http\Controllers\Admin\User\ProfileController;
use App\Http\Controllers\Content\NewsController as PublicNewsController;
use App\Http\Controllers\Content\PageController as PublicPageController;
use App\Http\Controllers\Content\PlaceController as PublicPlaceController;
use App\Http\Controllers\Content\PublicCallController as indexPublicCallController;
use App\Http\Controllers\Content\SearchController as PublicSearchController;
use App\Http\Controllers\FireStation\FireSearchController;
use App\Http\Controllers\Content\TheaterController as PublicTheaterController;
use App\Http\Controllers\Content\CouncilMemberController as PublicCouncilMemberController;
use App\Http\Controllers\Content\MayorController as PublicMayorController;
use App\Http\Controllers\Clarification\InvestmentController as AppInvestmentController;
use Rap2hpoutre\LaravelLogViewer\LogViewerController;

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

    Route::get('/news', [ClarificationController::class, 'news'])->name('clarification.news');

    Route::resource('investments', AppInvestmentController::class)->parameters(['investments' => 'investment:slug'])->only('index', 'show');
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
            'theater' => TheaterController::class,
            'banner-theater' => BannerTheaterController::class,
            'council-members' => CouncilMemberController::class,
            'mayors' => MayorController::class,
            'mayor-speech' => MayorSpeechController::class,
            'fire-sliders' => FireSliderController::class,
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
        Route::get('fire-sliders/{fireSlider}/status', [FireSliderController::class, 'status'])->name('fire-sliders.status');
        Route::get('places/{place}/status', [PlaceController::class, 'status'])->name('places.status');
        Route::get('public-calls/{publicCall}/status', [PublicCallController::class, 'status'])->name('publicCalls.status');
        Route::get('menus/{menu}/status', [MenuController::class, 'status'])->name('menus.status');
        Route::get('news/{news}/draft', [NewsController::class, 'draft'])->name('news.is_draft');
        Route::get('news/{news}/pined', [NewsController::class, 'pined'])->name('news.is_pined');
        // change page status route
        Route::get('pages/{page}/is_draft', [PageController::class, 'is_draft'])->name('pages.is_draft');
        Route::get('pages/{page}/is_quick_access', [PageController::class, 'isQuickAccess'])->name('pages.is_quick_access');
        // change theater status route
        Route::get('theater/{theater}/status', [TheaterController::class, 'status'])->name('theater.status');
        Route::get('banner-theater/{theater}/status', [BannerTheaterController::class, 'status'])->name('banner-theater.status');
        // change mayor status route
        Route::get('mayors/{mayor}/status', [MayorController::class, 'status'])->name('mayor.status');
        Route::get('mayor-speech/{mayor}/status', [MayorSpeechController::class, 'status'])->name('mayor.status');

    });

    Route::prefix('clarification')->as('clarification.')->group(function () {
        Route::resources([
            'perssonels' => PerssonelController::class,
            'salaries' => SalaryController::class,
            'contracts' => ContractController::class,
            'investments' => InvestmentController::class,
            'investments/categories' => InvestmentCategoryController::class,
        ], ['except' => 'show']);

        Route::get('perssonels/{perssonel}/disable', [PerssonelController::class, 'disable'])->name('perssonels.disable');

        Route::post('file-import', [PerssonelController::class, 'fileImport'])->name('file-import');
    });

    Route::resource('communications', CommunicationController::class)->except('store', 'show', 'create');

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
Route::get('{news}/news', [PublicNewsController::class, 'showId'])->name('news.show-id');

Route::get('tags/{tag:title}', [PublicNewsController::class, 'tag'])->name('news.tag');

Route::resource('public-calls', indexPublicCallController::class)->parameters(['public-calls' => 'public-calls:slug'])->only('index', 'show');

Route::resource('places', PublicPlaceController::class)->parameters(['places' => 'place:slug'])->only('index', 'show');

Route::get('council-member', [PublicCouncilMemberController::class, 'show'] )->name('council-member.show');

Route::get('mayors', [PublicMayorController::class, 'show'] )->name('mayors.show');

//Fire Station
Route::get('fire-station' , [FireStationController::class , 'index'])->name('fire-station.index');
Route::get('fire-station/{news}' , [FireStationController::class , 'show'])->name('fire-station.show');


Route::resource('theaters', PublicTheaterController::class)->parameters(['theaters' => 'theater:slug'])->only('index', 'show');

Route::get('search', PublicSearchController::class)->name('search');

Route::get('fire-search', FireSearchController::class)->name('fire-search');

Route::get('/{page:slug}', PublicPageController::class)->name('page');



Route::resource('communications', AppCommunicationController::class)->only('create' , 'store');


                  



