<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ApiUser;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        $credentials = $request->validate([
           'email' => ['required', 'email'],
           'password' => ['required'],
        ]);

        $user = ApiUser::where('email', $credentials['email'])->first();

        if (!$user || !\Hash::check($credentials['password'], $user->password)) {
            return response()->json([
                'message' => 'The provided credentials do not match our records.'
            ], 401);
        }

        // Создаём токен Sanctum
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => $user,
        ]);
    }
}