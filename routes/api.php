<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController as AuthControllerV1;
use App\Http\Controllers\Api\V1\MovieController as MovieControllerV1;

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

// ---- . ---- ---- ---- ---- . ----
// user:
// ---- . ---- ---- ---- ---- . ----

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// ---- . ---- ---- ---- ---- . ----
// auth: public:
// ---- . ---- ---- ---- ---- . ----

// public `auth` routes (default):
Route::group([
    'namespace' => 'App\Http\Controllers\Api\V1',
], function() {
    Route::post('/register', [AuthControllerV1::class, 'register']);
    Route::post('/login', [AuthControllerV1::class, 'login']);
});

// public `auth` routes (V1):
Route::group([
    'prefix' => 'v1',
    'namespace' => 'App\Http\Controllers\Api\V1',
], function() {
    Route::post('/register', [AuthControllerV1::class, 'register']);
    Route::post('/login', [AuthControllerV1::class, 'login']);
});

// ---- . ---- ---- ---- ---- . ----
// auth: protected:
// ---- . ---- ---- ---- ---- . ----

// protected `auth` routes (default):
Route::group([
    'namespace' => 'App\Http\Controllers\Api\V1',
    'middleware' => 'auth:sanctum'
], function() {
    Route::post('/logout', [AuthControllerV1::class, 'logout']);
});

// protected `auth` routes (V1):
Route::group([
    'prefix' => 'v1',
    'namespace' => 'App\Http\Controllers\Api\V1',
    'middleware' => 'auth:sanctum'
], function() {
    Route::post('/logout', [AuthControllerV1::class, 'logout']);
});

// ---- . ---- ---- ---- ---- . ----
// movies:
// ---- . ---- ---- ---- ---- . ----

// protected `movie` routes (default):
Route::group([
    'namespace' => 'App\Http\Controllers\Api\V1',
    'middleware' => 'auth:sanctum'
], function () {
    Route::apiResource('movies', MovieControllerV1::class);
});

// protected `movie` routes (V1):
Route::group([
    'prefix' => 'v1',
    'namespace' => 'App\Http\Controllers\Api\V1',
    'middleware' => 'auth:sanctum'
], function () {
    Route::apiResource('movies', MovieControllerV1::class);
});
