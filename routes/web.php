<?php

use  App\Http\Controllers\{
    StudentController,
    DashboardRedirectController,
    AdminDashboardController,
    SupervisorDashboardController,ProfileController,
    UserDashboardController,
    AuthenticatedSessionController
};
use Illuminate\Support\Facades\Route;
 

Route::get('/', function () {
    return view('auth.login');
});
/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
*/
Route::middleware('auth')->group(function () {
    

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
      Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
});

require __DIR__.'/auth.php';

// بعد تسجيل الدخول: التوجيه حسب الدور
Route::get('/dashboard', DashboardRedirectController::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// لوحات الأدوار
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
        ->middleware('role:admin')
        ->name('admin.dashboard');

    Route::get('/supervisor/dashboard', [SupervisorDashboardController::class, 'index'])
        ->middleware('role:supervisor')
        ->name('supervisor.dashboard');

    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])
        ->middleware('role:user')
        ->name('user.dashboard');
});
 Route::get('/student', function () {
    return view('student');
})->name('student');


