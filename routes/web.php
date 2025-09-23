<?php

use  App\Http\Controllers\{
    StudentController,
    DashboardRedirectController,TicketController,
    AdminDashboardController,
    SupervisorDashboardController,ProfileController,
    UserDashboardController,CallController,
    AuthenticatedSessionController
};
use App\Http\Controllers\SearchController;
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
// student section
 Route::get('/student', function () {
    return view('student');
})->name('student');

Route::post('/student-view', [StudentController::class, 'studentView'])->name('studentview');

// routes/web.php


Route::get('/search', [SearchController::class, 'search'])->name('search');


Route::post('/student/insert', [StudentController::class, 'insert'])->name('student.insert');

// go get std info from controller 
Route::get('/get-student/{id}', [StudentController::class, 'getStudent']);
Route::get('/search-ticket/{trackid}', [StudentController::class, 'getTicket']);


Route::get('/studentview/{stud_id}', [StudentController::class, 'getStudentData']);
 


// call section 
// routes/web.php
Route::prefix('calls')->group(function() {
    Route::post('/store', [CallController::class, 'store'])->name('calls.store');
    Route::get('/search-student', [CallController::class, 'searchStudent'])->name('calls.searchStudent');
     Route::get('/search-ticket', [CallController::class, 'searchTicket'])->name('calls.searchTicket');
  
});

Route::get('/calls/search', [CallController::class, 'search'])->name('calls.search');
Route::get('/calls/create', function () {
    return view('calls.create');
})->name('calls.create');

/// for tickets
Route::get('/ticket/view', [TicketController::class, 'view'])->name('ticket.view');

Route::get('/search-ticket/{ticketId}', [TicketController::class, 'search'])->name('ticket.search');
// for Voice Call submit
  Route::post('/voice-calls/store', [CallController::class, 'store'])
    ->name('voicecalls.store')
    ->middleware('auth');  
    