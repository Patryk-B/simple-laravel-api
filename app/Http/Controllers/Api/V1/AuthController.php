<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\V1\AuthRegisterRequest;

class AuthController extends Controller
{
    /**
     * registers a new user.
     */
    public function register(AuthRegisterRequest $request)
    {
        // Validate request:
        $validated = $request->validated(); // will throw `ValidationException` on invalid data.

        // create user:
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);

        // login user:
        $data['token'] = $user->createToken($user->email)->plainTextToken;
        $data['user'] = $user;

        // response:
        $response = [
            'status' => 'success',
            'message' => 'User is created successfully.',
            'data' => $data,
        ];

        // exit:
        return response()->json($response, 201);
    }

    /**
     * logins a user.
     */
    public function login(Request $request)
    {

    }

    /**
     * logouts a user.
     */
    public function logout(Request $request)
    {

    }
}
