<?php

use App\Http\Controllers\BiodataController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Login
Route::middleware(['auth'])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');

    Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
    Route::get('/user/dashboard', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
    Route::get('/admin/create', [App\Http\Controllers\AdminController::class, 'create'])->name('admin.create');
    Route::post('/admin/store', [App\Http\Controllers\AdminController::class, 'store'])->name('admin.store');
});

//Admin View
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/admin/pendaftar', [App\Http\Controllers\AdminController::class, 'pendaftarAdmin'])->name('admin.pendaftarAdmin');
Route::get('/admin/payment',[App\Http\Controllers\PaymentController::class, 'index']);
// Route::get('/analytic-admin',[App\Http\Controllers\PaymentController::class, 'index']);

// Route::get('/analytic-admin', function () {
//     $analyticData = \App\Models\PivotAdminUser::all();
//     return view('analytic-admin', ['analyticData' => $analyticData]);
// });
// Route::get('/pengumuman-admin',[App\Http\Controllers\PengumumanController::class, 'index']);
Route::get('/pengisian-biodata',[App\Http\Controllers\BiodataController::class,'index']);
Route::get('/pengumuman',[App\Http\Controllers\PengumumanController::class,'index']);
//User View
