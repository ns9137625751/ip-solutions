@extends('layouts.app')

@section('title', 'Home - Innovation & Patent Collaboration Platform')
@section('description', 'IP Solutions connects innovators with partners and funding. Discover patent-ready ideas, find co-applicants, and transform groundbreaking innovations into reality.')
@section('keywords', 'innovation platform, patent collaboration, IPR, intellectual property, funding for ideas, co-applicants, inventors network, startup ideas')

@section('content')
<div class="hero-gradient text-white py-32 relative">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center relative z-10">
        <div class="inline-block mb-4">
            <span class="badge badge-blue text-sm">🚀 Innovation Platform</span>
        </div>
        <h1 class="text-6xl md:text-7xl font-extrabold mb-6 leading-tight">Patent-Ready<br/>Ideas Await</h1>
        <p class="text-xl md:text-2xl mb-10 text-gray-100 max-w-3xl mx-auto font-light">Connect with innovators, find co-applicants, secure funding, and transform groundbreaking ideas into reality</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('ideas.index') }}" class="btn-secondary text-lg px-10 py-4">Explore Ideas</a>
            <a href="{{ route('ideas.create') }}" class="btn-primary text-lg px-10 py-4">Post Your Idea</a>
        </div>
        @php
            $statIdeas = \App\Models\Setting::get('hero_stat_ideas', '500+');
            $statInnovators = \App\Models\Setting::get('hero_stat_innovators', '1.2K+');
            $statFunding = \App\Models\Setting::get('hero_stat_funding', '₹50Cr+');
            
            $ideasNum = (int) preg_replace('/[^0-9.]/', '', $statIdeas);
            $innovatorsNum = (int) preg_replace('/[^0-9.]/', '', $statInnovators);
            $fundingNum = (int) preg_replace('/[^0-9.]/', '', $statFunding);
        @endphp

        <div class="mt-16 grid grid-cols-3 gap-8 max-w-2xl mx-auto">
            <div>
                <div class="text-4xl font-bold counter" data-target="{{ $ideasNum }}" data-suffix="+">0</div>
                <div class="text-gray-200 text-sm">Active Ideas</div>
            </div>
            <div>
                <div class="text-4xl font-bold counter" data-target="{{ $innovatorsNum }}" data-suffix="+">0</div>
                <div class="text-gray-200 text-sm">Innovators</div>
            </div>
            <div>
                <div class="text-4xl font-bold counter" data-target="{{ $fundingNum }}" data-suffix="Cr+">0</div>
                <div class="text-gray-200 text-sm">Funding</div>
            </div>
        </div>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const counters = document.querySelectorAll('.counter');
            const duration = 2000;

            counters.forEach(counter => {
                const target = +counter.getAttribute('data-target');
                const suffix = counter.getAttribute('data-suffix');
                const increment = target / (duration / 16);

                const updateCount = () => {
                    const count = +counter.innerText.replace(/[^0-9]/g, '');
                    if (count < target) {
                        counter.innerText = Math.ceil(count + increment);
                        setTimeout(updateCount, 16);
                    } else {
                        counter.innerText = target + suffix;
                    }
                };

                updateCount();
            });
        });
        </script>
    </div>
</div>

<div class="max-w-7xl mx-auto px-6 lg:px-8 py-20">
    <div class="text-center mb-16">
        <h2 class="section-title mb-4">Featured Ideas</h2>
        <p class="text-gray-600 text-lg">Handpicked innovative projects seeking collaboration</p>
    </div>

    @if($featuredIdeas->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            @foreach($featuredIdeas as $idea)
                <div class="idea-card card-hover">
                    <div class="flex items-center justify-between mb-4">
                        <span class="badge badge-blue">{{ $idea->stage }}</span>
                        <span class="text-xs text-gray-400">{{ $idea->created_at->diffForHumans() }}</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">{{ $idea->title }}</h3>
                    <p class="text-gray-600 mb-6 line-clamp-3 leading-relaxed">{{ Str::limit($idea->summary, 120) }}</p>
                    <div class="flex items-center justify-between text-sm mb-6 pb-6 border-b border-gray-100">
                        <div>
                            <div class="text-xs text-gray-500">Co-Applicants</div>
                            <div class="font-bold text-gray-900">{{ $idea->co_applicants_needed }}</div>
                        </div>
                        @if($idea->funding_requirement)
                            <div class="text-right">
                                <div class="text-xs text-gray-500">Funding</div>
                                <div class="font-bold text-gray-900">₹{{ number_format($idea->funding_requirement/100000, 1) }}L</div>
                            </div>
                        @endif
                    </div>
                    <a href="{{ route('ideas.show', $idea) }}" class="btn-primary w-full text-center block">View Details →</a>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-500 text-center py-12">No featured ideas yet.</p>
    @endif

    <div class="text-center">
        <a href="{{ route('ideas.index') }}" class="btn-secondary px-8 py-4 text-lg">Explore All Ideas →</a>
    </div>
</div>

<div class="py-20">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="section-title mb-4">How It Works</h2>
            <p class="text-gray-600 text-lg">Three simple steps to transform ideas into reality</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            <div class="text-center">
                <div class="feature-icon">🔍</div>
                <h3 class="text-2xl font-bold mb-3">Discover</h3>
                <p class="text-gray-600 leading-relaxed">Browse through curated patent-ready projects across multiple domains and technologies</p>
            </div>
            <div class="text-center">
                <div class="feature-icon">🤝</div>
                <h3 class="text-2xl font-bold mb-3">Connect</h3>
                <p class="text-gray-600 leading-relaxed">Express interest and connect with innovators through our secure platform</p>
            </div>
            <div class="text-center">
                <div class="feature-icon">🚀</div>
                <h3 class="text-2xl font-bold mb-3">Collaborate</h3>
                <p class="text-gray-600 leading-relaxed">Build trusted partnerships and bring groundbreaking ideas to market</p>
            </div>
        </div>
    </div>
</div>
@endsection
