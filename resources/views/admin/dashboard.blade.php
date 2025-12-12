@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Admin Dashboard</h1>
        <div class="grid grid-cols-2 md:flex md:flex-wrap gap-2">
            <a href="{{ route('admin.ideas') }}" class="btn-secondary text-xs md:text-sm px-2 md:px-3 py-2 text-center">Ideas</a>
            <a href="{{ route('admin.users') }}" class="btn-secondary text-xs md:text-sm px-2 md:px-3 py-2 text-center">Users</a>
            <a href="{{ route('admin.interests') }}" class="btn-secondary text-xs md:text-sm px-2 md:px-3 py-2 text-center">Interests</a>
            <a href="{{ route('admin.contacts') }}" class="btn-secondary text-xs md:text-sm px-2 md:px-3 py-2 text-center">Contacts</a>
            <a href="{{ route('admin.settings') }}" class="btn-secondary text-xs md:text-sm px-2 md:px-3 py-2 text-center">Settings</a>
        </div>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 md:gap-6 mb-8">
        <div class="stat-card">
            <div class="text-sm text-gray-500 mb-2">Total Users</div>
            <div class="text-3xl font-bold text-gray-900">{{ $stats['total_users'] }}</div>
        </div>
        <div class="stat-card">
            <div class="text-sm text-gray-500 mb-2">Total Ideas</div>
            <div class="text-3xl font-bold text-gray-900">{{ $stats['total_ideas'] }}</div>
        </div>
        <div class="stat-card border-l-yellow-500">
            <div class="text-sm text-gray-500 mb-2">Pending Ideas</div>
            <div class="text-3xl font-bold text-yellow-600">{{ $stats['pending_ideas'] }}</div>
        </div>
        <div class="stat-card border-l-green-500">
            <div class="text-sm text-gray-500 mb-2">Approved Ideas</div>
            <div class="text-3xl font-bold text-green-600">{{ $stats['approved_ideas'] }}</div>
        </div>
        <div class="stat-card">
            <div class="text-sm text-gray-500 mb-2">Total Interests</div>
            <div class="text-3xl font-bold text-gray-900">{{ $stats['total_interests'] }}</div>
        </div>
        <div class="stat-card border-l-blue-500">
            <div class="text-sm text-gray-500 mb-2">Contact Submissions</div>
            <div class="text-3xl font-bold text-blue-600">{{ $stats['total_contacts'] }}</div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="glass-effect rounded-xl">
            <div class="px-6 py-4 border-b">
                <h2 class="text-xl font-bold text-gray-900">Recent Ideas</h2>
            </div>
            <div class="divide-y">
                @foreach($recentIdeas as $idea)
                    <div class="p-4">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="font-bold text-gray-900">{{ Str::limit($idea->title, 40) }}</h3>
                            <span class="badge badge-{{ $idea->status === 'approved' ? 'green' : ($idea->status === 'pending' ? 'yellow' : 'red') }}">{{ ucfirst($idea->status) }}</span>
                        </div>
                        <p class="text-sm text-gray-600 mb-2">By {{ $idea->user->name }}</p>
                        <p class="text-xs text-gray-500">{{ $idea->created_at->diffForHumans() }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="glass-effect rounded-xl">
            <div class="px-6 py-4 border-b">
                <h2 class="text-xl font-bold text-gray-900">Recent Users</h2>
            </div>
            <div class="divide-y">
                @foreach($recentUsers as $user)
                    <div class="p-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="font-bold text-gray-900">{{ $user->name }}</h3>
                                <p class="text-sm text-gray-600">{{ $user->email }}</p>
                                <p class="text-xs text-gray-500">{{ $user->created_at->diffForHumans() }}</p>
                            </div>
                            @if($user->is_admin)
                                <span class="badge badge-blue">Admin</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="glass-effect rounded-xl">
            <div class="px-6 py-4 border-b flex items-center justify-between">
                <h2 class="text-xl font-bold text-gray-900">Recent Contacts</h2>
                <a href="{{ route('admin.contacts') }}" class="text-sm text-blue-600 hover:text-blue-800">View All</a>
            </div>
            <div class="divide-y">
                @foreach($recentContacts as $contact)
                    <div class="p-4">
                        <h3 class="font-bold text-gray-900">{{ $contact->name }}</h3>
                        <p class="text-sm text-gray-600 mb-1">{{ $contact->email }}</p>
                        <p class="text-sm text-gray-700 mb-2">{{ Str::limit($contact->subject, 40) }}</p>
                        <p class="text-xs text-gray-500">{{ $contact->created_at->diffForHumans() }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
