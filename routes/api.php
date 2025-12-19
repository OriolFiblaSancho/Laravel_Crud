<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CoursesControllerApi;
use App\Http\Controllers\API\StudentControllerApi;
use Illuminate\Http\Request;

Route::apiResource('api-courses', CoursesControllerApi::class);
Route::apiResource('api-students', StudentControllerApi::class)->middleware('auth:sanctum');

Route::post('/tokens/create', function (Request $request) {
    $token = $request->user()->createToken('api-token');
    return ['token' => $token->plainTextToken];
});

Route::fallback(function () {
    return response()->json(['message' => 'Endpoint not found'], 404);
});