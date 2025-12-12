@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Dashboard</h1>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div>
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-2xl font-bold text-gray-900">My Ideas</h2>
                <a href="{{ route('ideas.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Post New</a>
            </div>

            @if($myIdeas->count() > 0)
                <div class="space-y-4">
                    @foreach($myIdeas as $idea)
                        <div class="bg-white rounded-lg shadow p-6">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="text-xl font-bold text-gray-900">{{ $idea->title }}</h3>
                                <span class="px-3 py-1 text-sm rounded-full
                                    {{ $idea->status === 'approved' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $idea->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $idea->status === 'rejected' ? 'bg-red-100 text-red-800' : '' }}">
                                    {{ ucfirst($idea->status) }}
                                </span>
                            </div>
                            <p class="text-gray-600 mb-4">{{ Str::limit($idea->summary, 100) }}</p>
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-500">{{ $idea->interests->count() }} interested</span>
                                <a href="{{ route('ideas.show', $idea) }}" class="text-blue-600 hover:text-blue-800">View Details →</a>
                            </div>

                            @if($idea->interests->count() > 0)
                                <div class="mt-4 pt-4 border-t">
                                    <h4 class="font-bold text-gray-900 mb-2">Recent Interests:</h4>
                                    @foreach($idea->interests->take(3) as $interest)
                                        <div class="text-sm text-gray-600 mb-1">
                                            <strong>{{ $interest->user->name }}</strong> - {{ $interest->created_at->diffForHumans() }}
                                            @if($interest->message)
                                                <p class="text-gray-500 ml-4">{{ Str::limit($interest->message, 80) }}</p>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-lg shadow p-8 text-center">
                    <p class="text-gray-500 mb-4">You haven't posted any ideas yet.</p>
                    <a href="{{ route('ideas.create') }}" class="inline-block px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Post Your First Idea</a>
                </div>
            @endif
        </div>

        <div>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">My Interests</h2>

            @if($myInterests->count() > 0)
                <div class="space-y-4">
                    @foreach($myInterests as $interest)
                        <div class="bg-white rounded-lg shadow p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $interest->idea->title }}</h3>
                            <p class="text-gray-600 mb-2">By {{ $interest->idea->user->name }}</p>
                            <p class="text-sm text-gray-500 mb-4">Expressed interest {{ $interest->created_at->diffForHumans() }}</p>
                            
                            @if($interest->message)
                                <div class="bg-gray-50 rounded p-3 mb-4">
                                    <p class="text-sm text-gray-700"><strong>Your message:</strong> {{ $interest->message }}</p>
                                </div>
                            @endif

                            <div class="flex items-center justify-between">
                                <span class="px-3 py-1 text-sm rounded-full
                                    {{ $interest->status === 'accepted' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $interest->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $interest->status === 'rejected' ? 'bg-red-100 text-red-800' : '' }}">
                                    {{ ucfirst($interest->status) }}
                                </span>
                                <a href="{{ route('ideas.show', $interest->idea) }}" class="text-blue-600 hover:text-blue-800">View Idea →</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-lg shadow p-8 text-center">
                    <p class="text-gray-500 mb-4">You haven't expressed interest in any ideas yet.</p>
                    <a href="{{ route('ideas.index') }}" class="inline-block px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Explore Ideas</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
