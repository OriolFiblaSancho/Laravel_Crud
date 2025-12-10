<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CoursesController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('courses/export', [CoursesController::class, 'export'])->name('courses.export');
Route::get('students/export', [StudentController::class, 'export'])->name('students.export');
Route::resource('students', StudentController::class);
Route::resource('courses', CoursesController::class);