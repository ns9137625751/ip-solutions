@extends('layouts.app')

@section('title', 'Interest Details')

@section('content')
<div class="max-w-4xl mx-auto px-4 md:px-6 lg:px-8 py-4 md:py-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 md:mb-8 gap-3">
        <h1 class="text-2xl md:text-4xl font-bold text-gray-900">Interest Details</h1>
        <a href="{{ route('admin.interests') }}" class="btn-secondary text-sm md:text-base px-3 py-2 text-center">← Back to Interests</a>
    </div>

    <div class="glass-effect rounded-xl p-6 md:p-8">
        <!-- Status Badge -->
        <div class="flex items-center justify-between mb-6">
            <span class="badge badge-{{ $interest->status === 'accepted' ? 'green' : ($interest->status === 'pending' ? 'yellow' : 'red') }} text-sm">
                {{ ucfirst($interest->status) }}
            </span>
            <span class="text-sm text-gray-500">{{ $interest->created_at->format('M d, Y \a\t g:i A') }}</span>
        </div>

        <!-- User Information -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 mb-4">User Information</h2>
            <div class="bg-gray-50 rounded-lg p-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-medium text-gray-500">Name</label>
                        <p class="text-gray-900 font-medium">{{ $interest->user->name }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Email</label>
                        <p class="text-gray-900">{{ $interest->user->email }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">User Since</label>
                        <p class="text-gray-900">{{ $interest->user->created_at->format('M d, Y') }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Total Ideas</label>
                        <p class="text-gray-900">{{ $interest->user->ideas()->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Idea Information -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Idea Information</h2>
            <div class="bg-blue-50 rounded-lg p-4">
                <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $interest->idea->title }}</h3>
                <p class="text-gray-700 mb-3">{{ Str::limit($interest->idea->summary, 200) }}</p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                    <div>
                        <label class="text-gray-500 font-medium">Idea Owner</label>
                        <p class="text-gray-900">{{ $interest->idea->user->name }}</p>
                    </div>
                    <div>
                        <label class="text-gray-500 font-medium">Stage</label>
                        <p class="text-gray-900">{{ $interest->idea->stage }}</p>
                    </div>
                    <div>
                        <label class="text-gray-500 font-medium">Posted</label>
                        <p class="text-gray-900">{{ $interest->idea->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('ideas.show', $interest->idea) }}" class="btn-secondary text-sm">View Full Idea →</a>
                </div>
            </div>
        </div>

        <!-- Interest Message -->
        @if($interest->message)
            <div class="mb-8">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Interest Message</h2>
                <div class="bg-green-50 rounded-lg p-4">
                    <p class="text-gray-700 leading-relaxed">{{ $interest->message }}</p>
                </div>
            </div>
        @else
            <div class="mb-8">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Interest Message</h2>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-gray-500 italic">No message provided with this interest.</p>
                </div>
            </div>
        @endif

        <!-- Actions -->
        <div class="flex flex-col md:flex-row gap-3 pt-6 border-t">
            <a href="{{ route('ideas.show', $interest->idea) }}" class="btn-primary flex-1 text-center">View Idea Details</a>
            <form method="POST" action="{{ route('admin.interests.delete', $interest) }}" onsubmit="return confirm('Are you sure you want to delete this interest?')" class="flex-1">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full px-4 py-3 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700">Delete Interest</button>
            </form>
        </div>
    </div>
</div>
@endsection