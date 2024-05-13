<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    
    if (Auth::check()) {
    
        $role = Auth::user()->role;
        
        switch ($role) {
            case 'admin':
                return redirect()->route('admin.index');
                break;
            case 'user':
                return redirect()->route('user.index');
                break;
            
            default:
                return redirect()->route('home'); // Redirect default jika peran tidak ditemukan
        }
    } else {
        
        return view('welcome');
    }
});

Auth::routes();

//Login


// //Admin View
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/create', [App\Http\Controllers\AdminController::class, 'create'])->name('admin.create');
    Route::post('/admin/store', [App\Http\Controllers\AdminController::class, 'store'])->name('admin.store');
    Route::get('/admin/pendaftar', [App\Http\Controllers\BiodataController::class, 'index'])->name('admin.pendaftar');
    Route::get('/admin/payment', [App\Http\Controllers\PaymentController::class, 'index'])->name('admin.payment');
    Route::get('/admin/semua-akun', [App\Http\Controllers\AdminController::class, 'semuaAkun'])->name('admin.semuaUser');

    Route::get('/admin/settings', [App\Http\Controllers\AdminController::class, 'settings'])->name('admin.settings');
    Route::get('/admin/settings/manageadmin', [App\Http\Controllers\AdminController::class, 'manageAdmin'])->name('admin.manageAdmin');
    Route::delete('/admin/{id}', [App\Http\Controllers\AdminController::class, 'destroy'])->name('admin.destroy');

    //Pengumuman
    Route::get('/admin/pengumuman', [App\Http\Controllers\PengumumanController::class, 'index'])->name('admin.pengumuman.index');
    Route::get('/admin/pengumuman/create',[App\Http\Controllers\PengumumanController::class,'create'])->name('admin.pengumuman.create');
    Route::post('/admin/pengumuman/store',[App\Http\Controllers\PengumumanController::class,'store'])->name('admin.pengumuman.store');
    Route::put('/admin/pengumuman/{id}',[App\Http\Controllers\PengumumanController::class,'update'])->name('admin.pengumuman.update');
    Route::delete('/admin/pengumuman/{id}', [App\Http\Controllers\PengumumanController::class,'destroy'])->name('admin.pengumuman.destroy');

    //Admin Management
    Route::get('/admin/settings/tambah-admin', [App\Http\Controllers\AdminController::class, 'create'])->name('admin.createAdmin');

    //School
    Route::get('/admin/settings/school/', [App\Http\Controllers\SchoolController::class, 'index'])->name('admin.school.index');
    Route::get('/admin/settings/school/create', [App\Http\Controllers\SchoolController::class, 'create'])->name('admin.school.create');
    Route::post('/admin/settings/school/store', [App\Http\Controllers\SchoolController::class, 'store'])->name('admin.school.store');
    Route::get('/admin/settings/school/{id}', [App\Http\Controllers\SchoolController::class, 'edit'])->name('admin.school.edit');
    Route::put('/admin/school/{id}', [App\Http\Controllers\SchoolController::class, 'update'])->name('admin.school.update');
    Route::delete('/admin/school/{id}', [App\Http\Controllers\SchoolController::class, 'destroy'])->name('admin.school.destroy');

    //Payment
    
    Route::post('admin/payments/{payment}/approve', [App\Http\Controllers\PaymentController::class, 'approvePayment'])->name('admin.payments.approve');
    Route::post('admin/payments/{payment}/reject', [App\Http\Controllers\PaymentController::class, 'rejectPayment'])->name('admin.payments.reject');
    Route::get('storage/{user_id}/PaymentProofs/{paymentProof}', [App\Http\Controllers\PaymentController::class,'showPaymentProof'])->name('payment.proof');
    Route::get('/admin/payments/all',[App\Http\Controllers\PaymentController::class,'semuaPayment'])->name('admin.payments.all');


    //Manage Akun & Pendaftar
    Route::get('/user/create', [App\Http\Controllers\UserController::class, 'create'])->name('admin.tambahUser');
    Route::post('/user', [App\Http\Controllers\UserController::class, 'store'])->name('admin.tambahUser.store');
    Route::get('/user/{user}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('admin.editUser');
    Route::get('/user/{user}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('admin.editUser');
    Route::put('/user/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('admin.updateUser');
    Route::delete('/user/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->name('admin.deleteUser');
    Route::post('/users/{user}/reset-password', [App\Http\Controllers\UserController::class, 'resetPassword'])->name('admin.resetPasswordUser');

    //Biodata
    Route::get('/admin/biodata/edit/{biodata}', [App\Http\Controllers\BiodataController::class, 'edit'])->name('user.biodata.edit');
    Route::put('/admin/biodata/update/{biodata}', [App\Http\Controllers\BiodataController::class],'update')->name('user.biodata.update');

    //File Berkas
    Route::get('storage/{user_id}/biodata/{filename}', [App\Http\Controllers\BiodataController::class, 'showBiodataFile'])->name('admin.biodata.file');
    Route::post('admin/biodata/{biodata}/accept', [App\Http\Controllers\BiodataController::class, 'acceptBiodata'])->name('admin.biodata.accept');
    Route::post('admin/biodata/{biodata}/reject', [App\Http\Controllers\BiodataController::class, 'rejectBiodata'])->name('admin.biodata.reject');
    Route::get('/admin/biodata/edit/{biodata}',[App\Http\Controllers\BiodataController::class,'edit'])->name('admin.biodata.edit');
    Route::put('/admin/biodata/{biodata}',[App\Http\Controllers\BiodataController::class,'update'])->name('admin.biodata.update');
    Route::get('/admin/pendaftar/all',[App\Http\Controllers\BiodataController::class,'allCalonSiswa'])->name('admin.biodata.allCalonSiswa');
    //Hasil Tes
    Route::post('/admin/apply-hasiltes', [App\Http\Controllers\RegistrationController::class,'applyStatusTes'])->name('admin.apply-status.test');
    Route::get('/admin/analytic',[App\Http\Controllers\AnalyticController::class, 'index'])->name('admin.analytics');
    Route::get('/daily-registrations', [App\Http\Controllers\AnalyticController::class, 'dailyRegistrations'])->name('daily.registrations');
    Route::get('/weekly-registrations', [App\Http\Controllers\AnalyticController::class, 'weeklyRegistrations'])->name('weekly.registrations');
    Route::get('/academic-year', [App\Http\Controllers\AnalyticController::class, 'academicYear'])->name('academic.year');
    Route::get('/download/biodata/{filename}', [App\Http\Controllers\BiodataController::class, 'downloadAdministrasi'])->name('admin.biodata.download');

    //Survey
    Route::get('/admin/survey',[App\Http\Controllers\SurveyController::class, 'index'])->name('admin.survey.index');
    Route::get('/admin/survey/tambah-survey',[App\Http\Controllers\SurveyController::class,'create'])->name('admin.survey.create');
    Route::post('/admin/survey/store',[App\Http\Controllers\SurveyController::class, 'store'])->name('admin.survey.store');
    Route::put('/admin/survey/{id}',[App\Http\Controllers\SurveyController::class,'update'])->name('admin.survey.update');
    Route::delete('/admin/survey/{id}',[App\Http\Controllers\SurveyController::class,'destroy'])->name('admin.survey.destroy');
   
});


Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
    

    //User View
    Route::get('/user/pengumuman', [App\Http\Controllers\PengumumanController::class, 'index'])->name('user.pengumuman');
    Route::view('/user/pengumuman/empty','user.pengumumanEmpty-user')->name('user.pengumuman-empty');
    Route::get('/user/pengisian-biodata', [App\Http\Controllers\BiodataController::class, 'create'])->name('user.biodata.create');
    Route::post('/user/pengisian-biodata/store',[App\Http\Controllers\BiodataController::class,'store'])->name('user.biodata.store');
    Route::post('/user/pengisian-biodata/save',[App\Http\Controllers\BiodataController::class,'saveProgress'])->name('user.biodata.save');
    Route::get('/user/payment', [App\Http\Controllers\PaymentController::class, 'index'])->name('user.payment');
    Route::post('/getKota',[App\Http\Controllers\BiodataController::class,'getKota'])->name('getKota');
    Route::post('/getKecamatan',[App\Http\Controllers\BiodataController::class,'getKecamatan'])->name('getKecamatan');

    //Payment
    Route::post('/user/payment/store',[App\Http\Controllers\PaymentController::class,'store'])->name('user.payment.store');
    Route::get('/user/survey',[App\Http\Controllers\SurveyController::class, 'index'])->name('user.survey.index');
    Route::post('/user/survey/store',[App\Http\Controllers\AnswerController::class, 'store'])->name('user.answer.store');

});
