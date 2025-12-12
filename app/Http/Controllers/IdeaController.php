<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IdeaController extends Controller
{
    public function index(Request $request)
    {
        $query = Idea::approved()->with('user', 'interests')->latest();

        if ($request->filled('domain')) {
            $query->where('domain', $request->domain);
        }
        if ($request->filled('technology_type')) {
            $query->where('technology_type', $request->technology_type);
        }
        if ($request->filled('stage')) {
            $query->where('stage', $request->stage);
        }
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('summary', 'like', '%' . $request->search . '%');
            });
        }

        $ideas = $query->paginate(12);
        return view('ideas.index', compact('ideas'));
    }

    public function show(Idea $idea)
    {
        $idea->load('user', 'interests.user');
        return view('ideas.show', compact('idea'));
    }

    public function create()
    {
        return view('ideas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'required|string',
            'stage' => 'required|in:Ideation,Proof of Concept,Prototype,Patent Filed,Commercial Stage',
            'domain' => 'nullable|string|max:255',
            'technology_type' => 'nullable|string|max:255',
            'co_applicants_needed' => 'required|integer|min:1',
            'funding_requirement' => 'nullable|numeric|min:0',
            'filing_date' => 'nullable|date',
            'document' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
        ]);

        $validated['user_id'] = auth()->id();

        if ($request->hasFile('document')) {
            $validated['document_path'] = $request->file('document')->store('documents', 'public');
        }

        Idea::create($validated);

        return redirect()->route('dashboard')->with('success', 'Idea submitted successfully! It will be reviewed by our team.');
    }
}
