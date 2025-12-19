<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CoursesControllerApi;
use App\Http\Controllers\API\StudentControllerApi;

Route::apiResource('api-courses', CoursesControllerApi::class)->middleware('auth:sanctum');
Route::apiResource('api-students', StudentControllerApi::class)->middleware('auth:sanctum');

Route::post('/login', [App\Http\Controllers\API\AuthControllerApi::class, 'login']);

Route::fallback(function () {
    return response()->json(['message' => 'Endpoint not found'], 404);
});