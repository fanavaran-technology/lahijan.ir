<?php
use Modules\Complaint\Http\Controllers\Admin\ComplaintController;
use Modules\Complaint\Http\Controllers\Frontend\ComplaintController as FrontendComplaintController;
use Modules\Complaint\Http\Controllers\Admin\ComplaintController as AdminComplaintController;

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



//admin complaint
Route::prefix('complaint')->group(function() {
    Route::get('/index', [AdminComplaintController::class, 'index'])->name('complaints.index');
    Route::post('/store', [FrontendComplaintController::class, 'store'])->name('complaints.store');
});

Route::prefix('complaint')->as('complaints.')->group(function() {
    Route::get('/create', [FrontendComplaintController::class, 'index'])->name('create');
    Route::post('/store', [FrontendComplaintController::class, 'store'])->name('store');
    Route::post('/upload', [FrontendComplaintController::class, 'upload'])->name('upload');


});


Route::prefix('admin')->as('admin.')->middleware(['auth', 'auth.admin'])->group(function() {
    Route::get('complaint', [ComplaintController::class, 'index'])->name('complaints.index');
});
