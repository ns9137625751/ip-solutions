@extends('layouts.app')

@section('title', 'Manage Contacts')

@section('content')
<div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8 py-4 md:py-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 md:mb-8 gap-3">
        <h1 class="text-2xl md:text-4xl font-bold text-gray-900">Contact Submissions</h1>
        <a href="{{ route('admin.dashboard') }}" class="btn-secondary text-sm md:text-base px-3 py-2 text-center">← Back</a>
    </div>

    <!-- Desktop Table -->
    <div class="hidden md:block glass-effect rounded-xl overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Name</th>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Email</th>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Subject</th>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Message</th>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Date</th>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($contacts as $contact)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $contact->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $contact->email }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ Str::limit($contact->subject, 30) }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ Str::limit($contact->message, 50) }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $contact->created_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4">
                            <form method="POST" action="{{ route('admin.contacts.delete', $contact) }}" class="inline" onsubmit="return confirm('Delete this contact?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">No contact submissions yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Mobile Cards -->
    <div class="md:hidden space-y-3">
        @forelse($contacts as $contact)
            <div class="glass-effect rounded-lg p-4">
                <div class="mb-3">
                    <h3 class="font-bold text-gray-900 text-base">{{ $contact->name }}</h3>
                    <p class="text-xs text-gray-600 break-all mt-1">{{ $contact->email }}</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-3 mb-3">
                    <p class="font-medium text-sm text-gray-900 mb-2">{{ $contact->subject }}</p>
                    <p class="text-xs text-gray-600 leading-relaxed">{{ Str::limit($contact->message, 150) }}</p>
                </div>
                <div class="flex items-center justify-between pt-3 border-t">
                    <span class="text-xs text-gray-500">{{ $contact->created_at->format('M d, Y') }}</span>
                    <form method="POST" action="{{ route('admin.contacts.delete', $contact) }}" onsubmit="return confirm('Delete this contact?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg text-xs font-medium hover:bg-red-700">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="glass-effect rounded-lg p-8 text-center text-gray-500">No contact submissions yet.</div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $contacts->links() }}
    </div>
</div>
@endsection
