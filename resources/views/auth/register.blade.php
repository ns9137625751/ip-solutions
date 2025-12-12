@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="max-w-md mx-auto px-6 lg:px-8 py-16">
    <div class="glass-effect rounded-2xl p-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8 text-center">Register</h1>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-6">
                <label for="name" class="block text-gray-900 font-bold mb-2">Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus class="input-modern w-full @error('name') border-red-500 @enderror">
                @error('name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-6">
                <label for="email" class="block text-gray-900 font-bold mb-2">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required class="input-modern w-full @error('email') border-red-500 @enderror">
                @error('email')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-900 font-bold mb-2">Password</label>
                <input id="password" type="password" name="password" required class="input-modern w-full @error('password') border-red-500 @enderror">
                @error('password')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="block text-gray-900 font-bold mb-2">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required class="input-modern w-full">
            </div>

            <button type="submit" class="btn-primary w-full py-3 mb-4">Register</button>

            <div class="text-center">
                <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-gray-900">Already registered? Login</a>
            </div>
        </form>
    </div>
</div>
@endsection
