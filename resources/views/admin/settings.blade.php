@extends('layouts.app')

@section('title', 'Settings')

@section('content')
<div class="max-w-4xl mx-auto px-4 md:px-6 lg:px-8 py-4 md:py-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 md:mb-8 gap-3">
        <h1 class="text-2xl md:text-4xl font-bold text-gray-900">Settings</h1>
        <a href="{{ route('admin.dashboard') }}" class="btn-secondary text-sm md:text-base px-3 py-2 text-center">← Back</a>
    </div>

    <div class="glass-effect rounded-xl p-4 md:p-8">
        <form method="POST" action="{{ route('admin.settings.update') }}">
            @csrf

            <h2 class="text-xl md:text-2xl font-bold text-gray-900 mb-4">Contact Information</h2>

            <div class="mb-4 md:mb-6">
                <label class="block text-gray-900 font-bold mb-2 text-sm md:text-base">Contact Email</label>
                <input type="email" name="contact_email" value="{{ $settings['contact_email'] ?? '' }}" required class="input-modern w-full @error('contact_email') border-red-500 @enderror">
                @error('contact_email')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-4 md:mb-6">
                <label class="block text-gray-900 font-bold mb-2 text-sm md:text-base">Contact Phone</label>
                <input type="text" name="contact_phone" value="{{ $settings['contact_phone'] ?? '' }}" required class="input-modern w-full @error('contact_phone') border-red-500 @enderror">
                @error('contact_phone')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-6 md:mb-8">
                <label class="block text-gray-900 font-bold mb-2 text-sm md:text-base">Contact Address</label>
                <input type="text" name="contact_address" value="{{ $settings['contact_address'] ?? '' }}" required class="input-modern w-full @error('contact_address') border-red-500 @enderror">
                @error('contact_address')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <h2 class="text-xl md:text-2xl font-bold text-gray-900 mb-4">Homepage Hero Stats</h2>

            <div class="mb-4 md:mb-6">
                <label class="block text-gray-900 font-bold mb-2 text-sm md:text-base">Active Ideas</label>
                <input type="text" name="hero_stat_ideas" value="{{ $settings['hero_stat_ideas'] ?? '500+' }}" required class="input-modern w-full @error('hero_stat_ideas') border-red-500 @enderror">
                @error('hero_stat_ideas')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-4 md:mb-6">
                <label class="block text-gray-900 font-bold mb-2 text-sm md:text-base">Innovators</label>
                <input type="text" name="hero_stat_innovators" value="{{ $settings['hero_stat_innovators'] ?? '1.2K+' }}" required class="input-modern w-full @error('hero_stat_innovators') border-red-500 @enderror">
                @error('hero_stat_innovators')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-6 md:mb-8">
                <label class="block text-gray-900 font-bold mb-2 text-sm md:text-base">Funding</label>
                <input type="text" name="hero_stat_funding" value="{{ $settings['hero_stat_funding'] ?? '₹50Cr+' }}" required class="input-modern w-full @error('hero_stat_funding') border-red-500 @enderror">
                @error('hero_stat_funding')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <button type="submit" class="btn-primary w-full md:w-auto px-6 md:px-8 py-3 text-sm md:text-base">Save Settings</button>
        </form>
    </div>
</div>
@endsection
