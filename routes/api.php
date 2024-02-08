<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\MovieController;
use App\Http\Controllers\Api\V1\CoverController;
use App\Http\Controllers\API\V1\RegisterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// // ---- . ---- ---- ---- ---- . ----
// // register & login:
// // ---- . ---- ---- ---- ---- . ----

// Route::controller(RegisterController::class)->group(function()
// {
//     Route::post('register', 'register');
//     Route::post('login', 'login');
//     Route::post('users', 'login')->name('index');
// });

// // ---- . ---- ---- ---- ---- . ----
// // user:
// // ---- . ---- ---- ---- ---- . ----

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::middleware('auth:sanctum')->group(function() {
//     Route::get('/users', [RegisterController::class, 'index'])->name('index');
// });

// Route::middleware('auth:sanctum')->controller(RegisterController::class)->group(function() {
//     Route::get('/users', 'index')->name('index');
// });

// ---- . ---- ---- ---- ---- . ----
// crud api:
// ---- . ---- ---- ---- ---- . ----

Route::group([
    'prefix' => 'v1', // api/v1
    'namespace' => 'App\Http\Controllers\Api\V1',
    'middleware' => 'auth:sanctum'
], function () {
    Route::apiResource('movies', MovieController::class);
    Route::apiResource('covers', CoverController::class);
});
