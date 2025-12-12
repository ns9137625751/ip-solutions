@extends('layouts.app')

@section('title', 'Forgot Password')

@section('content')
<div class="max-w-md mx-auto px-6 lg:px-8 py-16">
    <div class="glass-effect rounded-2xl p-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-4 text-center">Forgot Password</h1>
        
        <p class="text-sm text-gray-600 mb-6 text-center">
            Forgot your password? No problem. Just let us know your email address and we will email you a password reset link.
        </p>

        @if (session('status'))
            <div class="mb-4 text-sm text-green-600 text-center">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-6">
                <label for="email" class="block text-gray-900 font-bold mb-2">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="input-modern w-full @error('email') border-red-500 @enderror">
                @error('email')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <button type="submit" class="btn-primary w-full py-3 mb-4">Email Password Reset Link</button>

            <div class="text-center">
                <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-gray-900">Back to Login</a>
            </div>
        </form>
    </div>
</div>
@endsection
