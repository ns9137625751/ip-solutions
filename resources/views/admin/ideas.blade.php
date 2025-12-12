@extends('layouts.app')

@section('title', 'Manage Ideas')

@section('content')
<div class="max-w-7xl mx-auto px-6 lg:px-8 py-8">
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-4xl font-bold text-gray-900">Manage Ideas</h1>
        <a href="{{ route('admin.dashboard') }}" class="btn-secondary">← Back to Dashboard</a>
    </div>

    <!-- Desktop Table -->
    <div class="hidden md:block glass-effect rounded-xl overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Title</th>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">User</th>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Stage</th>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Status</th>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Interests</th>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @foreach($ideas as $idea)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-900">{{ Str::limit($idea->title, 50) }}</div>
                            <div class="text-sm text-gray-500">{{ $idea->created_at->format('M d, Y') }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $idea->user->name }}</td>
                        <td class="px-6 py-4"><span class="badge badge-blue text-xs">{{ $idea->stage }}</span></td>
                        <td class="px-6 py-4">
                            <span class="badge badge-{{ $idea->status === 'approved' ? 'green' : ($idea->status === 'pending' ? 'yellow' : 'red') }} text-xs">
                                {{ ucfirst($idea->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $idea->interests->count() }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-2">
                                @if($idea->status === 'pending')
                                    <form method="POST" action="{{ route('admin.ideas.approve', $idea) }}" class="inline">
                                        @csrf
                                        <button type="submit" class="text-green-600 hover:text-green-800 text-sm font-medium">Approve</button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.ideas.reject', $idea) }}" class="inline">
                                        @csrf
                                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">Reject</button>
                                    </form>
                                @endif
                                <form method="POST" action="{{ route('admin.ideas.toggle-featured', $idea) }}" class="inline">
                                    @csrf
                                    <button type="submit" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                        {{ $idea->is_featured ? 'Unfeature' : 'Feature' }}
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('admin.ideas.toggle-visibility', $idea) }}" class="inline">
                                    @csrf
                                    <button type="submit" class="text-purple-600 hover:text-purple-800 text-sm font-medium">
                                        {{ $idea->is_visible ? 'Hide' : 'Show' }}
                                    </button>
                                </form>
                                <a href="{{ route('ideas.show', $idea) }}" class="text-gray-600 hover:text-gray-800 text-sm font-medium">View</a>
                                <form method="POST" action="{{ route('admin.ideas.delete', $idea) }}" class="inline" onsubmit="return confirm('Delete this idea?')">
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
    <div class="md:hidden space-y-4">
        @foreach($ideas as $idea)
            <div class="glass-effect rounded-xl p-4">
                <div class="flex items-start justify-between mb-3">
                    <h3 class="font-bold text-gray-900 flex-1">{{ Str::limit($idea->title, 40) }}</h3>
                    <span class="badge badge-{{ $idea->status === 'approved' ? 'green' : ($idea->status === 'pending' ? 'yellow' : 'red') }} text-xs ml-2">
                        {{ ucfirst($idea->status) }}
                    </span>
                </div>
                <div class="text-sm text-gray-600 mb-2">By {{ $idea->user->name }}</div>
                <div class="flex items-center gap-2 mb-3">
                    <span class="badge badge-blue text-xs">{{ $idea->stage }}</span>
                    <span class="text-xs text-gray-500">{{ $idea->interests->count() }} interests</span>
                </div>
                <div class="flex flex-wrap gap-2">
                    @if($idea->status === 'pending')
                        <form method="POST" action="{{ route('admin.ideas.approve', $idea) }}" class="inline">
                            @csrf
                            <button type="submit" class="text-green-600 text-xs font-medium">Approve</button>
                        </form>
                        <form method="POST" action="{{ route('admin.ideas.reject', $idea) }}" class="inline">
                            @csrf
                            <button type="submit" class="text-red-600 text-xs font-medium">Reject</button>
                        </form>
                    @endif
                    <form method="POST" action="{{ route('admin.ideas.toggle-featured', $idea) }}" class="inline">
                        @csrf
                        <button type="submit" class="text-blue-600 text-xs font-medium">{{ $idea->is_featured ? 'Unfeature' : 'Feature' }}</button>
                    </form>
                    <form method="POST" action="{{ route('admin.ideas.toggle-visibility', $idea) }}" class="inline">
                        @csrf
                        <button type="submit" class="text-purple-600 text-xs font-medium">{{ $idea->is_visible ? 'Hide' : 'Show' }}</button>
                    </form>
                    <a href="{{ route('ideas.show', $idea) }}" class="text-gray-600 text-xs font-medium">View</a>
                    <form method="POST" action="{{ route('admin.ideas.delete', $idea) }}" class="inline" onsubmit="return confirm('Delete?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 text-xs font-medium">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $ideas->links() }}
    </div>
</div>
@endsection
