@extends('layouts.layout')
@section('title', 'Login')
@section('content')
<div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md mt-10">
    <h2 class="text-2xl font-bold mb-6 text-center text-indigo-600">Login to your account</h2>
    <form method="POST" action="{{ route('login.attempt') }}" class="space-y-5">
        @csrf
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div>
            <label for="email" class="block text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" required autofocus />
        </div>
        <div>
            <label for="password" class="block text-gray-700">Password</label>
            <input type="password" name="password" id="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" required />
        </div>
        <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition">Login</button>
    </form>
    <div class="mt-4 text-center text-sm text-gray-600">
        Don't have an account?
        <a href="{{ route('register') }}" class="text-indigo-600 hover:underline">Register</a>
    </div>
</div>
@endsection
