@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <h1 class="text-4xl font-bold text-gray-900 mb-8 text-center">Contact Us</h1>

    <div class="bg-white rounded-lg shadow-lg p-8">
        <p class="text-gray-700 mb-8 text-center">Have questions? We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>

        <form method="POST" action="{{ route('contact.store') }}" class="space-y-6">
            @csrf
            <div>
                <label class="block text-gray-700 font-bold mb-2">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="input-modern w-full @error('name') border-red-500 @enderror">
                @error('name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="input-modern w-full @error('email') border-red-500 @enderror">
                @error('email')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">Subject</label>
                <input type="text" name="subject" value="{{ old('subject') }}" required class="input-modern w-full @error('subject') border-red-500 @enderror">
                @error('subject')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">Message</label>
                <textarea name="message" rows="6" required class="input-modern w-full @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
                @error('message')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <button type="submit" class="btn-primary w-full py-3">Send Message</button>
        </form>
    </div>

    <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
        <div>
            <div class="text-blue-600 text-3xl mb-2">📧</div>
            <h3 class="font-bold text-gray-900 mb-2">Email</h3>
            <p class="text-gray-600">{{ \App\Models\Setting::get('contact_email', 'support@ipsolutions.com') }}</p>
        </div>
        <div>
            <div class="text-blue-600 text-3xl mb-2">📞</div>
            <h3 class="font-bold text-gray-900 mb-2">Phone</h3>
            <p class="text-gray-600">{{ \App\Models\Setting::get('contact_phone', '+91 1234567890') }}</p>
        </div>
        <div>
            <div class="text-blue-600 text-3xl mb-2">📍</div>
            <h3 class="font-bold text-gray-900 mb-2">Address</h3>
            <p class="text-gray-600">{{ \App\Models\Setting::get('contact_address', 'Innovation Hub, India') }}</p>
        </div>
    </div>
</div>
@endsection
