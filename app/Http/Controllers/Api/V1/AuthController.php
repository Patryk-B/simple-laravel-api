<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\V1\UserResource;
use App\Http\Requests\V1\AuthLoginRequest;
use App\Http\Requests\V1\AuthLogoutRequest;
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

        // Response:
        $data['token'] = $user->createToken($user->email, ['*'])->plainTextToken;
        $data['user'] = new UserResource($user);
        $response = [
            'status' => 'success',
            'message' => 'User created successfully.',
            'data' => $data,
        ];

        // exit:
        $response = response()->json($response, 201);
        return $response;
    }

    /**
     * logins a user.
     */
    public function login(AuthLoginRequest $request)
    {
        // Validate request:
        $validated = $request->validated(); // will throw `ValidationException` on invalid data.

        // Check email exist:
        $user = User::where('email', $validated['email'])->first();

        // Check password:
        if(!$user || !Hash::check($validated['password'], $user['password'])) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Invalid credentials'
            ], 401);
        }

        // Response:
        $data['token'] = $user->createToken($validated['email'], ['*'])->plainTextToken;
        $data['user'] = new UserResource($user);
        $response = [
            'status' => 'success',
            'message' => 'User logged in successfully.',
            'data' => $data,
        ];

        // Exit:
        return response()->json($response, 200);
    }

    /**
     * logouts a user.
     */
    public function logout(AuthLogoutRequest $request)
    {
        // Get user:
        $user = auth()->user();

        // Logout:
        $user->tokens()->delete();

        // Exit:
        return response()->json([
            'status' => 'success',
            'message' => 'User logged out successfully'
        ], 200);
    }
}
