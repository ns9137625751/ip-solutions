@extends('layouts.app')

@section('title', 'Verify Email')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4">
    <div class="glass-effect rounded-2xl p-8 w-full max-w-md">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Verify Email</h1>
            <p class="text-gray-600">Enter the OTP sent to {{ $user->email }}</p>
        </div>

        <form method="POST" action="{{ route('verify.otp.submit', $user->id) }}">
            @csrf

            <div class="mb-6">
                <label for="otp" class="block text-gray-900 font-bold mb-2">OTP Code</label>
                <input id="otp" type="text" name="otp" required autofocus maxlength="6" 
                       class="input-modern w-full text-center text-2xl tracking-widest @error('otp') border-red-500 @enderror"
                       placeholder="000000">
                @error('otp')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn-primary w-full py-3 mb-4">
                Verify Email
            </button>
        </form>

        <div class="text-center">
            <p class="text-gray-600 text-sm mb-2">Didn't receive the code?</p>
            <form method="POST" action="{{ route('resend.otp', $user->id) }}" class="inline">
                @csrf
                <button type="submit" class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                    Resend OTP
                </button>
            </form>
        </div>
    </div>
</div>
@endsection