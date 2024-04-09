<?php


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
Route::get('/admin/semua-akun',[App\Http\Controllers\AdminController::class, 'semuaAkun'])->name('admin.semuaUser');
Route::get('/pengisian-biodata',[App\Http\Controllers\BiodataController::class,'index']);
Route::get('/admin/settings',[App\Http\Controllers\AdminController::class,'settings'])->name('admin.settings');
Route::get('/admin/settings/manageadmin', [App\Http\Controllers\AdminController::class,'manageAdmin'])->name('admin.manageAdmin');
Route::get('/admin/pengumuman',[App\Http\Controllers\PengumumanController::class,'index'])->name('admin.pengumuman.index');
Route::get('/admin/settings/tambah-admin',[App\Http\Controllers\AdminController::class,'create'])->name('admin.createAdmin');


//School
Route::get('/admin/settings/school/',[App\Http\Controllers\SchoolController::class,'index'])->name('admin.school.index');
Route::get('/admin/settings/school/{id}',[App\Http\Controllers\SchoolController::class,'edit'])->name('admin.school.edit');
// Route::put('/admin/settings/school/',[App\Http\Controllers\SchoolController::class,'update'])->name('admin.school.update');
// Route::post('/admin/settings/school/', [App\Http\Controllers\SchoolController::class, 'store'])->name('admin.school.store');
Route::put('/admin/school/{id}', [App\Http\Controllers\SchoolController::class,'update'])->name('admin.school.update');

//Manage Akun & Pendaftar
Route::get('/user/create',[App\Http\Controllers\UserController::class,'create'])->name('admin.tambahUser');
Route::post('/user',[App\Http\Controllers\UserController::class,'store'])->name('admin.tambahUser.store');

Route::get('/user/{user}/edit', [App\Http\Controllers\UserController::class,'edit'])->name('admin.editUser');
Route::get('/user/{user}/edit', [App\Http\Controllers\UserController::class,'edit'])->name('admin.editUser');
Route::put('/user/{user}', [App\Http\Controllers\UserController::class,'update'])->name('admin.updateUser');
Route::delete('/user/{user}',[App\Http\Controllers\UserController::class, 'destroy'])->name('admin.deleteUser');
Route::post('/users/{user}/reset-password',[App\Http\Controllers\UserController::class, 'resetPassword'])->name('admin.resetPasswordUser');

//User View
Route::get('/user/pengumuman', [App\Http\Controllers\PengumumanController::class,'index'])->name('user.pengumuman');
Route::get('/user/payment', [App\Http\Controllers\PaymentController::class,'index'])->name('user.payment');


//Setting
