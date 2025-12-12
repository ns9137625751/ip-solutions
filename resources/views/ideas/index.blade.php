@extends('layouts.app')

@section('title', 'Explore Ideas - Browse Patent-Ready Innovation Projects')
@section('description', 'Discover innovative patent-ready ideas across multiple domains. Find collaboration opportunities, connect with inventors, and explore groundbreaking projects seeking co-applicants and funding.')
@section('keywords', 'explore ideas, patent projects, innovation ideas, startup projects, collaboration opportunities, co-applicants, technology ideas')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="glass-effect rounded-2xl p-8 mb-12">
            <h1 class="section-title mb-8">Explore Ideas</h1>
            
            <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <input type="text" name="search" placeholder="🔍 Search ideas..." value="{{ request('search') }}" class="input-modern">
                <select name="stage" class="input-modern">
                    <option value="">All Stages</option>
                    <option value="Ideation" {{ request('stage') == 'Ideation' ? 'selected' : '' }}>Ideation</option>
                    <option value="Proof of Concept" {{ request('stage') == 'Proof of Concept' ? 'selected' : '' }}>Proof of Concept</option>
                    <option value="Prototype" {{ request('stage') == 'Prototype' ? 'selected' : '' }}>Prototype</option>
                    <option value="Patent Filed" {{ request('stage') == 'Patent Filed' ? 'selected' : '' }}>Patent Filed</option>
                    <option value="Commercial Stage" {{ request('stage') == 'Commercial Stage' ? 'selected' : '' }}>Commercial Stage</option>
                </select>
                <input type="text" name="domain" placeholder="Domain" value="{{ request('domain') }}" class="input-modern">
                <button type="submit" class="btn-primary">Apply Filters</button>
            </form>
        </div>

        @if($ideas->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($ideas as $idea)
                    <div class="idea-card card-hover">
                        <div class="flex items-center justify-between mb-4">
                            <span class="badge badge-blue">{{ $idea->stage }}</span>
                            @if($idea->is_featured)
                                <span class="badge badge-yellow">⭐ Featured</span>
                            @endif
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">{{ $idea->title }}</h3>
                        <p class="text-gray-600 mb-4 line-clamp-3 leading-relaxed">{{ Str::limit($idea->summary, 120) }}</p>
                        
                        @if($idea->domain)
                            <div class="inline-block px-3 py-1 bg-purple-50 text-purple-700 rounded-full text-xs font-medium mb-4">
                                {{ $idea->domain }}
                            </div>
                        @endif
                        
                        <div class="grid grid-cols-2 gap-4 mb-6 pb-6 border-b border-gray-100">
                            <div>
                                <div class="text-xs text-gray-500 mb-1">Co-Applicants</div>
                                <div class="font-bold text-gray-900">{{ $idea->co_applicants_needed }}</div>
                            </div>
                            <div>
                                <div class="text-xs text-gray-500 mb-1">Interested</div>
                                <div class="font-bold text-gray-900">{{ $idea->interests->count() }} people</div>
                            </div>
                        </div>
                        
                        @if($idea->funding_requirement)
                            <div class="mb-4 text-sm">
                                <span class="text-gray-500">Funding:</span>
                                <span class="font-bold text-gray-900">₹{{ number_format($idea->funding_requirement/100000, 1) }}L</span>
                            </div>
                        @endif
                        
                        <a href="{{ route('ideas.show', $idea) }}" class="btn-primary w-full text-center block">View Details →</a>
                    </div>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $ideas->links() }}
            </div>
        @else
            <div class="glass-effect rounded-2xl p-12 text-center">
                <div class="text-6xl mb-4">🔍</div>
                <p class="text-gray-500 text-xl">No ideas found. Try adjusting your filters.</p>
            </div>
        @endif
    </div>
</div>
@endsection
