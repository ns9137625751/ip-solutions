<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Innovation Platform') - {{ config('app.name', 'IP Solutions') }}</title>
    <meta name="description" content="@yield('description', 'IP Solutions - Connect innovators with partners and funding. Share ideas, find co-applicants, and bring innovations to life.')">
    <meta name="keywords" content="@yield('keywords', 'innovation, patent, IPR, intellectual property, funding, collaboration, ideas, inventors')">
    <meta name="author" content="IP Solutions">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">
    
    <!-- Open Graph -->
    <meta property="og:title" content="@yield('title', 'Innovation Platform') - {{ config('app.name', 'IP Solutions') }}">
    <meta property="og:description" content="@yield('description', 'Connect innovators with partners and funding. Share ideas, find co-applicants, and bring innovations to life.')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="{{ config('app.name', 'IP Solutions') }}">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'Innovation Platform') - {{ config('app.name', 'IP Solutions') }}">
    <meta name="twitter:description" content="@yield('description', 'Connect innovators with partners and funding.')">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <nav class="glass-effect sticky top-0 z-50" role="navigation" aria-label="Main navigation">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <a href="{{ route('home') }}" class="flex items-center space-x-2" aria-label="IP Solutions Home">
                    <div class="w-10 h-10 rounded-lg bg-gray-900" aria-hidden="true"></div>
                    <span class="text-2xl font-bold text-gray-900">IP Solutions</span>
                </a>
                <div class="hidden md:flex items-center space-x-1">
                    <a href="{{ route('ideas.index') }}" class="nav-link">Explore Ideas</a>
                    <a href="{{ route('about') }}" class="nav-link">About</a>
                    <a href="{{ route('contact') }}" class="nav-link">Contact</a>
                </div>
                <button onclick="toggleMobileMenu()" class="md:hidden p-2" aria-label="Toggle mobile menu" aria-expanded="false">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <div class="hidden md:flex items-center space-x-3">
                    @auth
                        <a href="{{ route('ideas.create') }}" class="btn-primary">Post Idea</a>
                        <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="nav-link font-bold">Admin</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="nav-link">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn-secondary">Login</a>
                        <a href="{{ route('register') }}" class="btn-primary">Register</a>
                    @endauth
                </div>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden md:hidden border-t border-gray-200">
            <div class="px-6 py-4 space-y-3">
                <a href="{{ route('ideas.index') }}" class="block py-2 text-gray-700 hover:text-gray-900 font-medium">Explore Ideas</a>
                <a href="{{ route('about') }}" class="block py-2 text-gray-700 hover:text-gray-900 font-medium">About</a>
                <a href="{{ route('contact') }}" class="block py-2 text-gray-700 hover:text-gray-900 font-medium">Contact</a>
                @auth
                    <a href="{{ route('ideas.create') }}" class="block py-2 text-gray-700 hover:text-gray-900 font-medium">Post Idea</a>
                    <a href="{{ route('dashboard') }}" class="block py-2 text-gray-700 hover:text-gray-900 font-medium">Dashboard</a>
                    @if(auth()->user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="block py-2 text-gray-700 hover:text-gray-900 font-bold">Admin</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left py-2 text-gray-700 hover:text-gray-900 font-medium">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block py-2 text-gray-700 hover:text-gray-900 font-medium">Login</a>
                    <a href="{{ route('register') }}" class="block py-2 text-gray-700 hover:text-gray-900 font-medium">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <script>
    function toggleMobileMenu() {
        const menu = document.getElementById('mobileMenu');
        menu.classList.toggle('hidden');
    }
    </script>

    @if(session('success'))
        <div class="max-w-7xl mx-auto px-6 lg:px-8 mt-6">
            <div class="glass-effect border-l-4 border-green-500 px-6 py-4 rounded-lg">
                <p class="text-green-800 font-medium">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-6 lg:px-8 mt-6">
            <div class="glass-effect border-l-4 border-red-500 px-6 py-4 rounded-lg">
                <p class="text-red-800 font-medium">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    <main>
        @yield('content')
    </main>

    <footer class="mt-20 bg-gray-900" itemscope itemtype="https://schema.org/Organization">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <div>
                    <h3 class="text-white font-bold text-lg mb-4" itemprop="name">IP Solutions</h3>
                    <p class="text-gray-400 text-sm" itemprop="description">Connecting innovators with partners and funding to bring ideas to life.</p>
                </div>
                <div>
                    <h3 class="text-white font-bold text-lg mb-4">Quick Links</h3>
                    <nav class="space-y-2" aria-label="Footer navigation">
                        <a href="{{ route('ideas.index') }}" class="block text-gray-400 hover:text-white text-sm">Explore Ideas</a>
                        <a href="{{ route('about') }}" class="block text-gray-400 hover:text-white text-sm">About Us</a>
                        <a href="{{ route('contact') }}" class="block text-gray-400 hover:text-white text-sm">Contact</a>
                    </nav>
                </div>
                <div>
                    <h3 class="text-white font-bold text-lg mb-4">Connect</h3>
                    <p class="text-gray-400 text-sm" itemprop="email">{{ \App\Models\Setting::get('contact_email', 'support@ipsolutions.com') }}</p>
                    <p class="text-gray-400 text-sm" itemprop="telephone">{{ \App\Models\Setting::get('contact_phone', '+91 1234567890') }}</p>
                </div>
            </div>
            <div class="border-t border-gray-700 pt-8 text-center">
                <p class="text-gray-400 text-sm">&copy; {{ date('Y') }} IP Solutions. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
