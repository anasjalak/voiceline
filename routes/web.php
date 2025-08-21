<?php

use Illuminate\Support\Facades\Route;

 
use App\Http\Controllers\StudentController;

Route::get('/', [StudentController::class, 'searchForm'])->name('students.search.form');
Route::get('/students/results', [StudentController::class, 'search'])->name('students.search');

