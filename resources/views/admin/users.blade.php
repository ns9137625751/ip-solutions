@extends('layouts.app')

@section('title', 'Manage Users')

@section('content')
<div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8 py-4 md:py-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 md:mb-8 gap-3">
        <h1 class="text-2xl md:text-4xl font-bold text-gray-900">Manage Users</h1>
        <a href="{{ route('admin.dashboard') }}" class="btn-secondary text-sm md:text-base px-3 py-2 text-center">← Back</a>
    </div>

    <!-- Desktop Table -->
    <div class="hidden md:block glass-effect rounded-xl overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Name</th>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Email</th>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Ideas</th>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Interests</th>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Role</th>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Joined</th>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @foreach($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $user->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $user->email }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $user->ideas_count }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $user->interests_count }}</td>
                        <td class="px-6 py-4">
                            @if($user->is_admin)
                                <span class="badge badge-blue text-xs">Admin</span>
                            @else
                                <span class="badge bg-gray-200 text-gray-700 text-xs">User</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $user->created_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-2">
                                @if($user->id !== auth()->id())
                                    <form method="POST" action="{{ route('admin.users.toggle-admin', $user) }}" class="inline">
                                        @csrf
                                        <button type="submit" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                            {{ $user->is_admin ? 'Remove Admin' : 'Make Admin' }}
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.users.delete', $user) }}" class="inline" onsubmit="return confirm('Delete this user?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">Delete</button>
                                    </form>
                                @else
                                    <span class="text-gray-400 text-sm">You</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Mobile Cards -->
    <div class="md:hidden space-y-3">
        @foreach($users as $user)
            <div class="glass-effect rounded-lg p-4">
                <div class="flex items-start justify-between mb-3">
                    <div class="flex-1 min-w-0">
                        <h3 class="font-bold text-gray-900 text-base truncate">{{ $user->name }}</h3>
                        <p class="text-xs text-gray-600 break-all mt-1">{{ $user->email }}</p>
                    </div>
                    @if($user->is_admin)
                        <span class="badge badge-blue text-xs ml-2 flex-shrink-0">Admin</span>
                    @else
                        <span class="badge bg-gray-200 text-gray-700 text-xs ml-2 flex-shrink-0">User</span>
                    @endif
                </div>
                <div class="grid grid-cols-3 gap-2 mb-3 text-center">
                    <div class="bg-gray-50 rounded p-2">
                        <div class="text-xs text-gray-500">Ideas</div>
                        <div class="font-bold text-gray-900">{{ $user->ideas_count }}</div>
                    </div>
                    <div class="bg-gray-50 rounded p-2">
                        <div class="text-xs text-gray-500">Interests</div>
                        <div class="font-bold text-gray-900">{{ $user->interests_count }}</div>
                    </div>
                    <div class="bg-gray-50 rounded p-2">
                        <div class="text-xs text-gray-500">Joined</div>
                        <div class="font-bold text-gray-900 text-xs">{{ $user->created_at->format('M d') }}</div>
                    </div>
                </div>
                @if($user->id !== auth()->id())
                    <div class="flex gap-2 pt-3 border-t">
                        <form method="POST" action="{{ route('admin.users.toggle-admin', $user) }}" class="flex-1">
                            @csrf
                            <button type="submit" class="w-full btn-secondary text-xs py-2">
                                {{ $user->is_admin ? 'Remove Admin' : 'Make Admin' }}
                            </button>
                        </form>
                        <form method="POST" action="{{ route('admin.users.delete', $user) }}" onsubmit="return confirm('Delete this user?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg text-xs font-medium hover:bg-red-700">Delete</button>
                        </form>
                    </div>
                @else
                    <div class="text-center text-gray-400 text-xs pt-3 border-t">Current User</div>
                @endif
            </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $users->links() }}
    </div>
</div>
@endsection
