@extends('layouts.app')

@section('title', 'About Us')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <h1 class="text-4xl font-bold text-gray-900 mb-8 text-center">About IP Solutions</h1>

    <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Our Mission</h2>
        <p class="text-gray-700 mb-4">
            IP Solutions is dedicated to fostering collaboration and innovation by connecting inventors, researchers, and innovators with the right partners and resources. We believe that great ideas deserve the opportunity to become reality through trusted partnerships and secure collaboration.
        </p>
        <p class="text-gray-700">
            Our platform enables users to discover patent-ready projects, find co-applicants, secure funding, and build meaningful partnerships that bring innovative ideas to life.
        </p>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">What We Offer</h2>
        <div class="space-y-4">
            <div class="flex items-start">
                <div class="flex-shrink-0 w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center mr-4">✓</div>
                <div>
                    <h3 class="font-bold text-gray-900">Secure Platform</h3>
                    <p class="text-gray-700">Verified users and secure communication channels</p>
                </div>
            </div>
            <div class="flex items-start">
                <div class="flex-shrink-0 w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center mr-4">✓</div>
                <div>
                    <h3 class="font-bold text-gray-900">Innovation Discovery</h3>
                    <p class="text-gray-700">Browse patent-ready ideas across various domains</p>
                </div>
            </div>
            <div class="flex items-start">
                <div class="flex-shrink-0 w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center mr-4">✓</div>
                <div>
                    <h3 class="font-bold text-gray-900">Partnership Building</h3>
                    <p class="text-gray-700">Connect with co-founders, investors, and collaborators</p>
                </div>
            </div>
            <div class="flex items-start">
                <div class="flex-shrink-0 w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center mr-4">✓</div>
                <div>
                    <h3 class="font-bold text-gray-900">Funding Opportunities</h3>
                    <p class="text-gray-700">Find investors interested in innovative projects</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-blue-50 rounded-lg p-8 text-center">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Join Our Community</h2>
        <p class="text-gray-700 mb-6">Be part of a growing network of innovators and change-makers</p>
        <a href="{{ route('register') }}" class="inline-block px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold">Get Started</a>
    </div>
</div>
@endsection
