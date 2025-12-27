<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CoursesControllerApi;
use App\Http\Controllers\API\StudentControllerApi;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('api-courses', CoursesControllerApi::class);
    Route::apiResource('api-students', StudentControllerApi::class);
});

Route::get('/', function () {
    return response()->json(['message' => 'API root', 'status' => 'ok']);
});

Route::fallback(function () {
    return response()->json(['message' => 'Endpoint not found'], 404);
});