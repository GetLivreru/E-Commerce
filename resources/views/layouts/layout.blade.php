<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'E-Commerce')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.1/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    <nav class="bg-white shadow mb-8">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="text-2xl font-bold text-indigo-600">E-Commerce</a>
            <div class="space-x-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-indigo-600">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-700 hover:text-red-600">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600">Login</a>
                    <a href="{{ route('register') }}" class="text-gray-700 hover:text-indigo-600">Register</a>
                @endauth
            </div>
        </div>
    </nav>
    <div class="flex-1 flex flex-col items-center justify-center w-full">
        <main class="w-full max-w-7xl px-4 py-8">
            @yield('content')
        </main>
    </div>
    <footer class="bg-white shadow mt-8 py-4 text-center text-gray-500">
        &copy; {{ date('Y') }} E-Commerce. All rights reserved.(no)
    </footer>
</body>
</html>
