<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// ---- . ---- ---- ---- ---- . ----
// home:
// ---- . ---- ---- ---- ---- . ----

Route::get('/', function () {
    return view('welcome');
});

// ---- . ---- ---- ---- ---- . ----
// utils:
// ---- . ---- ---- ---- ---- . ----

// FATAL: THIS IS JUST A MOCK SETUP !!!
Route::get('/mockSetup', function () {
    $username = 'Admin';
    $credentials = [
        'email' => 'admin@admin.com',
        'password' => 'password'
    ];

    if (!Auth::attempt($credentials)) {
        $user = new \App\Models\User();

        $user->name = $username;
        $user->email = $credentials['email'];
        $user->password = $credentials['password'];

        $user->save();

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            $adminToken = $user->createToken('admin-token', ['create', 'update', 'delete']);
            $updateToken = $user->createToken('update-token', ['create', 'update']);
            $basicToken = $user->createToken('basic-token', ['none']);

            return [
                'admin' => $adminToken->plainTextToken,
                'update' => $updateToken->plainTextToken,
                'basic' => $basicToken->plainTextToken,
            ];
        }
    }
});
