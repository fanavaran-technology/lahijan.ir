<?php
use Modules\Complaint\Http\Controllers\Admin\ComplaintController;
use \Modules\Complaint\Http\Controllers\Admin\DepartementController;
use Modules\Complaint\Http\Controllers\Frontend\ComplaintController as FrontendComplaintController;

//Route department
Route::prefix('admin')->as('admin.')->middleware(['auth', 'auth.admin'])->group(function() {
    Route::get('departement', [DepartementController::class, 'index'])->name('departements.index');
    Route::get('/create', [DepartementController::class, 'create'])->name('departements.create');
    Route::post('/store', [DepartementController::class, 'store'])->name('departements.store');
    Route::get('/edit/{departement}', [DepartementController::class, 'edit'])->name('departements.edit');
    Route::put('/update/{departement}', [DepartementController::class, 'update'])->name('departements.update');
});

//Route complaint
Route::prefix('complaint')->as('complaints.')->group(function() {
    Route::get('/create', [FrontendComplaintController::class, 'index'])->name('create');
    Route::post('/store', [FrontendComplaintController::class, 'store'])->name('store');
    Route::post('/upload', [FrontendComplaintController::class, 'upload'])->name('upload');
});

Route::prefix('admin')->as('admin.')->middleware(['auth', 'auth.admin'])->group(function() {
    Route::get('complaint', [ComplaintController::class, 'index'])->name('complaints.index');
    Route::get('/edit/{complaint}', [ComplaintController::class, 'edit'])->name('complaints.edit');
});
