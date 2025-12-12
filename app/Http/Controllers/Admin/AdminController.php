<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Idea, User, Interest, Contact};
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_ideas' => Idea::count(),
            'pending_ideas' => Idea::where('status', 'pending')->count(),
            'approved_ideas' => Idea::where('status', 'approved')->count(),
            'total_interests' => Interest::count(),
            'total_contacts' => Contact::count(),
        ];
        $recentIdeas = Idea::with('user')->latest()->take(5)->get();
        $recentUsers = User::latest()->take(5)->get();
        $recentContacts = Contact::latest()->take(5)->get();
        return view('admin.dashboard', compact('stats', 'recentIdeas', 'recentUsers', 'recentContacts'));
    }

    public function ideas()
    {
        $ideas = Idea::with('user', 'interests')->latest()->paginate(10);
        return view('admin.ideas', compact('ideas'));
    }

    public function approveIdea(Idea $idea)
    {
        $idea->update(['status' => 'approved']);
        return back()->with('success', 'Idea approved!');
    }

    public function rejectIdea(Idea $idea)
    {
        $idea->update(['status' => 'rejected']);
        return back()->with('success', 'Idea rejected.');
    }

    public function toggleFeatured(Idea $idea)
    {
        $idea->update(['is_featured' => !$idea->is_featured]);
        return back()->with('success', 'Featured status updated!');
    }

    public function toggleVisibility(Idea $idea)
    {
        $idea->update(['is_visible' => !$idea->is_visible]);
        return back()->with('success', 'Visibility updated!');
    }

    public function deleteIdea(Idea $idea)
    {
        $idea->delete();
        return back()->with('success', 'Idea deleted.');
    }

    public function users()
    {
        $users = User::withCount(['ideas', 'interests'])->latest()->paginate(20);
        return view('admin.users', compact('users'));
    }

    public function toggleAdmin(User $user)
    {
        $user->update(['is_admin' => !$user->is_admin]);
        return back()->with('success', 'Admin status updated!');
    }

    public function deleteUser(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Cannot delete yourself!');
        }
        $user->delete();
        return back()->with('success', 'User deleted.');
    }

    public function interests()
    {
        $interests = Interest::with(['user', 'idea.user'])->latest()->paginate(20);
        return view('admin.interests', compact('interests'));
    }

    public function showInterest(Interest $interest)
    {
        $interest->load(['user', 'idea.user']);
        return view('admin.interest-detail', compact('interest'));
    }

    public function deleteInterest(Interest $interest)
    {
        $interest->delete();
        return back()->with('success', 'Interest deleted.');
    }

    public function contacts()
    {
        $contacts = Contact::latest()->paginate(20);
        return view('admin.contacts', compact('contacts'));
    }

    public function deleteContact(Contact $contact)
    {
        $contact->delete();
        return back()->with('success', 'Contact deleted.');
    }

    public function settings()
    {
        $settings = \App\Models\Setting::all()->pluck('value', 'key');
        return view('admin.settings', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        $validated = $request->validate([
            'contact_email' => 'required|email',
            'contact_phone' => 'required|string',
            'contact_address' => 'required|string',
            'hero_stat_ideas' => 'required|string',
            'hero_stat_innovators' => 'required|string',
            'hero_stat_funding' => 'required|string',
        ]);

        foreach ($validated as $key => $value) {
            \App\Models\Setting::set($key, $value);
        }

        return back()->with('success', 'Settings updated successfully!');
    }
}
