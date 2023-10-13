<?php
use Modules\Complaint\Http\Controllers\Admin\ComplaintController;
use \Modules\Complaint\Http\Controllers\Admin\DepartementController;
use Modules\Complaint\Http\Controllers\Admin\MyComplaintController;
use Modules\Complaint\Http\Controllers\Admin\SettingController;
use Modules\Complaint\Http\Controllers\Frontend\ComplaintController as FrontendComplaintController;
use Modules\Complaint\Http\Controllers\Frontend\TrackingController;

//Route department
Route::prefix('admin')->as('admin.')->middleware(['auth', 'auth.admin'])->group(function() {
    Route::get('departement', [DepartementController::class, 'index'])->name('departements.index');
    Route::get('departement/create', [DepartementController::class, 'create'])->name('departements.create');
    Route::post('departement/store', [DepartementController::class, 'store'])->name('departements.store');
    Route::get('departement/edit/{departement}', [DepartementController::class, 'edit'])->name('departements.edit');
    Route::put('departement/update/{departement}', [DepartementController::class, 'update'])->name('departements.update');
    Route::delete('departement/destroy/{departement}', [DepartementController::class, 'destroy'])->name('departements.destroy');
    Route::get('departement/fetch', [DepartementController::class, 'fetch'])->name('departements.fetch');
    Route::get('departement/{departement}/fetch-user', [DepartementController::class, 'fetchUser'])->name('departements.fetch-user');

    Route::post('departement/complaint-hander', [DepartementController::class, 'setHandlerPermission'])->name('departements.handler-permission');
    Route::resource('complaints/settings', SettingController::class)->only('index', 'store');
    Route::get('my-complaints/fetch', [MyComplaintController::class, 'fetch'])->name('my-complaints.fetch');
    Route::get('my-complaints', [MyComplaintController::class, 'index'])->name('my-complaints.index');
    Route::get('my-complaints/{complaint}', [MyComplaintController::class, 'show'])->name('my-complaints.show');
    Route::put('my-complaints/{complaint}/anwser', [MyComplaintController::class, 'answer'])->name('my-complaints.anwser');
    Route::get('/complaints/fetch', [ComplaintController::class, 'fetch'])->name('complaints.fetch');
    Route::post('/complaints/{complaint}/referral', [ComplaintController::class, 'referral'])->name('complaints.referral');
    Route::resource('complaints', ComplaintController::class);
    Route::post('/notification/read-all', [ComplaintController::class, 'readAll'])->name('complaints.readAll');
    Route::post('/notification/read-my-complaint', [ComplaintController::class, 'readMyComplaint'])->name('complaints.readMyComplaint');
});

//Route complaint
Route::prefix('complaint')->as('complaints.')->group(function() {
    Route::get('/create', [FrontendComplaintController::class, 'create'])->name('create');
    Route::post('/store', [FrontendComplaintController::class, 'store'])->name('store');
    Route::post('/upload', [FrontendComplaintController::class, 'upload'])->name('upload');
    Route::get('/traking', [TrackingController::class, 'index'])->name('tracking.index');
    Route::post('/traking', [TrackingController::class, 'proccess'])->name('tracking.proccess');
});

