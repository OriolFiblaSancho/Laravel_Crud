<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CoursesControllerApi;
use App\Http\Controllers\API\StudentControllerApi;

Route::apiResource('courses', CoursesControllerApi::class);
Route::apiResource('students', StudentControllerApi::class);

Route::fallback(function () {
    return response()->json(['message' => 'Endpoint not found'], 404);
});