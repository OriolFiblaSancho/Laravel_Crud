<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CoursesController;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('students', StudentController::class);
Route::resource('courses', CoursesController::class);