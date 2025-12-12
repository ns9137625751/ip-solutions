@extends('layouts.app')

@section('title', $idea->title . ' - Innovation Project')
@section('description', Str::limit($idea->summary, 155))
@section('keywords', ($idea->domain ? $idea->domain . ', ' : '') . ($idea->technology_type ? $idea->technology_type . ', ' : '') . 'innovation, patent, collaboration, funding')

@section('content')
<div class="max-w-5xl mx-auto px-6 lg:px-8 py-12">
    @if(session('success'))
        <div class="glass-effect border-l-4 border-green-500 px-6 py-4 rounded-lg mb-6">
            <p class="text-green-800 font-medium">{{ session('success') }}</p>
        </div>
    @endif

    @if(session('error'))
        <div class="glass-effect border-l-4 border-red-500 px-6 py-4 rounded-lg mb-6">
            <p class="text-red-800 font-medium">{{ session('error') }}</p>
        </div>
    @endif

    <div class="glass-effect rounded-2xl p-10">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-4">
            <span class="badge badge-blue text-base">{{ $idea->stage }}</span>
            <div class="flex flex-wrap items-center gap-2 md:gap-3">
                <a href="https://wa.me/?text={{ urlencode($idea->title . ' - ' . request()->url()) }}" target="_blank" class="btn-secondary px-3 py-2 flex items-center space-x-2 text-sm">
                    <span>💬</span>
                    <span>WhatsApp</span>
                </a>
                <button onclick="copyLink()" class="btn-secondary px-3 py-2 flex items-center space-x-2 text-sm">
                    <span>🔗</span>
                    <span>Copy Link</span>
                </button>
                <span class="text-gray-400 text-xs md:text-sm">Posted {{ $idea->created_at->diffForHumans() }}</span>
            </div>
        </div>

        <script>
        function copyLink() {
            navigator.clipboard.writeText(window.location.href).then(() => {
                const btn = event.target.closest('button');
                const originalText = btn.innerHTML;
                btn.innerHTML = '<span>✅</span><span>Copied!</span>';
                setTimeout(() => {
                    btn.innerHTML = originalText;
                }, 2000);
            });
        }
        </script>

        <h1 class="text-5xl font-extrabold text-gray-900 mb-6 leading-tight">{{ $idea->title }}</h1>

        <div class="flex items-center mb-8 pb-8 border-b border-gray-200">
            <div class="flex items-center space-x-2 mr-6">
                <div class="w-10 h-10 rounded-full bg-gray-900"></div>
                <span class="font-medium text-gray-700">{{ $idea->user->name }}</span>
            </div>
            <div class="flex items-center space-x-2">
                <span class="text-2xl">👥</span>
                <span class="font-semibold text-gray-900">{{ $idea->interests->count() }} interested</span>
            </div>
        </div>

        <div class="mb-10">
            <h2 class="text-3xl font-bold mb-6 text-gray-900">Project Summary</h2>
            <p class="text-gray-700 text-lg leading-relaxed whitespace-pre-line">{{ $idea->summary }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
            @if($idea->domain)
                <div class="stat-card">
                    <div class="text-sm text-gray-500 mb-1">Domain</div>
                    <div class="text-xl font-bold text-gray-900">{{ $idea->domain }}</div>
                </div>
            @endif

            @if($idea->technology_type)
                <div class="stat-card">
                    <div class="text-sm text-gray-500 mb-1">Technology Type</div>
                    <div class="text-xl font-bold text-gray-900">{{ $idea->technology_type }}</div>
                </div>
            @endif

            <div class="stat-card">
                <div class="text-sm text-gray-500 mb-1">Co-Applicants Needed</div>
                <div class="text-xl font-bold text-gray-900">{{ $idea->co_applicants_needed }} people</div>
            </div>

            @if($idea->funding_requirement)
                <div class="stat-card">
                    <div class="text-sm text-gray-500 mb-1">Funding Requirement</div>
                    <div class="text-xl font-bold text-gray-900">₹{{ number_format($idea->funding_requirement/100000, 1) }} Lakhs</div>
                </div>
            @endif

            @if($idea->filing_date)
                <div class="stat-card">
                    <div class="text-sm text-gray-500 mb-1">Filing Date</div>
                    <div class="text-xl font-bold text-gray-900">{{ $idea->filing_date->format('M d, Y') }}</div>
                </div>
            @endif
        </div>

        @auth
            @if(auth()->id() !== $idea->user_id)
                <div class="glass-effect rounded-2xl p-8">
                    <form method="POST" action="{{ route('interests.store', $idea) }}" id="interestForm">
                        @csrf
                        <h3 class="text-2xl font-bold mb-6 text-gray-900">Express Your Interest</h3>
                        <textarea name="message" rows="5" placeholder="Share why you're interested in this project..." class="input-modern w-full mb-6"></textarea>
                        <button type="submit" class="btn-primary text-lg px-10 py-4">Submit Interest →</button>
                    </form>
                </div>

                <script>
                document.getElementById('interestForm').addEventListener('submit', function() {
                    setTimeout(() => {
                        this.reset();
                    }, 100);
                });
                </script>
            @endif
        @else
            <div class="glass-effect rounded-2xl p-10 text-center">
                <div class="text-6xl mb-4">🔒</div>
                <h3 class="text-2xl font-bold mb-4">Login Required</h3>
                <p class="text-gray-600 mb-6 text-lg">Please login to express interest in this idea</p>
                <a href="{{ route('login') }}" class="btn-primary text-lg px-10 py-4">Login Now</a>
            </div>
        @endauth
    </div>
</div>
@endsection
