<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Idea;

class HomeController extends Controller
{
    public function index()
    {
        $featuredIdeas = Idea::approved()->featured()->with('user')->latest()->take(6)->get();
        $recentIdeas = Idea::approved()->with('user')->latest()->take(6)->get();

        return view('home', compact('featuredIdeas', 'recentIdeas'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function contactStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        \App\Models\Contact::create($validated);

        return back()->with('success', 'Thank you for contacting us! We will get back to you soon.');
    }
}
