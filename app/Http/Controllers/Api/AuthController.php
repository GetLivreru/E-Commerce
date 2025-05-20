<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            Log::info('Login attempt', [
                'email' => $request->email,
                'user_exists' => User::where('email', $request->email)->exists()
            ]);

            if (!Auth::attempt($credentials)) {
                Log::warning('Login failed', [
                    'email' => $request->email,
                    'reason' => 'Invalid credentials'
                ]);
                
                return response()->json([
                    'message' => 'The provided credentials do not match our records.',
                    'debug' => [
                        'email_exists' => User::where('email', $request->email)->exists()
                    ]
                ], 401);
            }

            $user = User::where('email', $request->email)->first();
            
            if (!$user) {
                return response()->json([
                    'message' => 'User not found'
                ], 404);
            }

            $token = $user->createToken('api-token')->plainTextToken;

            Log::info('Login successful', [
                'user_id' => $user->id,
                'email' => $user->email
            ]);

            return response()->json([
                'token' => $token,
                'user' => $user
            ]);
        } catch (\Exception $e) {
            Log::error('Login error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'message' => 'An error occurred during login',
                'error' => $e->getMessage()
            ], 500);
        }
    }
} 