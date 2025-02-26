<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'doctor',
        ]);

        $token = $user->createToken('Register_Token:')->plainTextToken;

        return response()->json([
            'message' => 'User created successfully',
            'data' => [
                'token' => $token,
                'username' => $user->username,
                'email' => $user->email,
            ],
            'status' => 201,
        ], 201);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            $token = $user->createToken('Login_Token:')->plainTextToken;

            return response()->json([
                'message' => 'Login successful',
                'data' => [
                    'token' => $token,
                    'username' => $user->username,
                    'email' => $user->email,
                ],
                'status' => 200,
            ], 200);
        }

        return response()->json([
            'message' => 'Authentication error',
            'status' => 401,
        ], 401);
    }

    public function logout(): JsonResponse
    {
        $user = Auth::user();

        if ($user) {
            $user->tokens()->delete();

            return response()->json([
                'message' => 'Logout successful',
                'status' => 200,
            ], 200);
        }

        return response()->json([
            'message' => 'User not authenticated',
            'status' => 401,
        ], 401);
    }
}
