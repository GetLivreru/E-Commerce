<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user = Auth::user();
        
        Log::info('Admin middleware check', [
            'user_id' => $user->id,
            'email' => $user->email,
            'is_admin' => $user->is_admin,
            'has_permissions' => !empty($user->permissions),
            'permissions' => $user->permissions
        ]);

        if (!$user->isAdmin()) {
            return response()->json([
                'message' => 'Access denied. Admin privileges required.',
                'debug' => [
                    'is_admin' => $user->is_admin,
                    'has_permissions' => !empty($user->permissions)
                ]
            ], 403);
        }

        return $next($request);
    }
} 