<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\AuthController;


Route::redirect('/', '/login');

Route::get('/login', function () {
    return view('login');
})->name('login');

// Login moved from API to web controller
Route::post('/login', [AuthController::class, 'login'])->name('login.form');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('courses/export', [CoursesController::class, 'export'])->name('courses.export');
    Route::get('students/export', [StudentController::class, 'export'])->name('students.export');
    Route::resource('students', StudentController::class);
    Route::resource('courses', CoursesController::class);
});
