@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="max-w-md mx-auto px-6 lg:px-8 py-16">
    <div class="glass-effect rounded-2xl p-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8 text-center">Login</h1>

        @if (session('status'))
            <div class="mb-4 text-sm text-green-600">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-6">
                <label for="email" class="block text-gray-900 font-bold mb-2">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="input-modern w-full @error('email') border-red-500 @enderror">
                @error('email')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-900 font-bold mb-2">Password</label>
                <input id="password" type="password" name="password" required class="input-modern w-full @error('password') border-red-500 @enderror">
                @error('password')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-6">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="remember" class="rounded border-gray-300">
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            <button type="submit" class="btn-primary w-full py-3 mb-4">Log in</button>

            <div class="text-center space-y-2">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="block text-sm text-gray-600 hover:text-gray-900">Forgot your password?</a>
                @endif
                <a href="{{ route('register') }}" class="block text-sm text-gray-600 hover:text-gray-900">Don't have an account? Register</a>
            </div>
        </form>
    </div>
</div>
@endsection
