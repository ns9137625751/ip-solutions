@extends('layouts.app')

@section('title', 'Manage Interests')

@section('content')
<div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8 py-4 md:py-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 md:mb-8 gap-3">
        <h1 class="text-2xl md:text-4xl font-bold text-gray-900">Manage Interests</h1>
        <a href="{{ route('admin.dashboard') }}" class="btn-secondary text-sm md:text-base px-3 py-2 text-center">← Back</a>
    </div>

    <!-- Desktop Table -->
    <div class="hidden md:block glass-effect rounded-xl overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">User</th>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Idea</th>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Message</th>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Status</th>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Date</th>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @foreach($interests as $interest)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-900">{{ $interest->user->name }}</div>
                            <div class="text-sm text-gray-500">{{ $interest->user->email }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-900">{{ Str::limit($interest->idea->title, 40) }}</div>
                            <div class="text-sm text-gray-500">By {{ $interest->idea->user->name }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700">
                            {{ $interest->message ? Str::limit($interest->message, 50) : 'No message' }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="badge badge-{{ $interest->status === 'accepted' ? 'green' : ($interest->status === 'pending' ? 'yellow' : 'red') }} text-xs">
                                {{ ucfirst($interest->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $interest->created_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('admin.interests.show', $interest) }}" class="text-green-600 hover:text-green-800 text-sm font-medium">View Interest</a>
                                <a href="{{ route('ideas.show', $interest->idea) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View Idea</a>
                                <form method="POST" action="{{ route('admin.interests.delete', $interest) }}" class="inline" onsubmit="return confirm('Delete this interest?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Mobile Cards -->
    <div class="md:hidden space-y-3">
        @foreach($interests as $interest)
            <div class="glass-effect rounded-lg p-4">
                <div class="flex items-start justify-between mb-3">
                    <div class="flex-1 min-w-0">
                        <h3 class="font-bold text-gray-900 text-sm">{{ $interest->user->name }}</h3>
                        <p class="text-xs text-gray-600 truncate">{{ $interest->user->email }}</p>
                    </div>
                    <span class="badge badge-{{ $interest->status === 'accepted' ? 'green' : ($interest->status === 'pending' ? 'yellow' : 'red') }} text-xs ml-2 flex-shrink-0">
                        {{ ucfirst($interest->status) }}
                    </span>
                </div>
                <div class="bg-gray-50 rounded-lg p-3 mb-3">
                    <p class="font-medium text-gray-900 text-sm mb-1">{{ $interest->idea->title }}</p>
                    <p class="text-xs text-gray-500">By {{ $interest->idea->user->name }}</p>
                </div>
                @if($interest->message)
                    <div class="bg-blue-50 rounded-lg p-3 mb-3">
                        <p class="text-xs text-gray-500 mb-1">Message:</p>
                        <p class="text-sm text-gray-700">{{ Str::limit($interest->message, 100) }}</p>
                    </div>
                @endif
                <div class="text-xs text-gray-500 mb-3">{{ $interest->created_at->format('M d, Y') }}</div>
                <div class="grid grid-cols-2 gap-2 mb-2">
                    <a href="{{ route('admin.interests.show', $interest) }}" class="btn-primary text-xs py-2 text-center">View Interest</a>
                    <a href="{{ route('ideas.show', $interest->idea) }}" class="btn-secondary text-xs py-2 text-center">View Idea</a>
                </div>
                <form method="POST" action="{{ route('admin.interests.delete', $interest) }}" onsubmit="return confirm('Delete this interest?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded-lg text-xs font-medium hover:bg-red-700">Delete</button>
                </form>
            </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $interests->links() }}
    </div>
</div>
@endsection
