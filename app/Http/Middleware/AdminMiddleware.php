<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        
        // Подробное логирование
        \Log::info('Admin Middleware Check', [
            'user_id' => $user ? $user->id : null,
            'email' => $user ? $user->email : null,
            'is_admin' => $user ? $user->is_admin : null,
            'permissions' => $user ? $user->permissions : null,
            'is_authenticated' => auth()->check(),
            'is_admin_method' => $user ? $user->isAdmin() : false,
            'request_path' => $request->path(),
            'request_method' => $request->method()
        ]);

        if (!auth()->check()) {
            return response()->json([
                'error' => 'Требуется авторизация',
                'debug' => [
                    'is_authenticated' => false
                ]
            ], 401);
        }

        if (!$user->isAdmin()) {
            return response()->json([
                'error' => 'Доступ запрещен. Требуются права администратора.',
                'debug' => [
                    'is_authenticated' => true,
                    'is_admin' => $user->is_admin,
                    'has_permissions' => !empty($user->permissions),
                    'permissions' => $user->permissions
                ]
            ], 403);
        }

        return $next($request);
    }
} 