<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use App\Models\Interest;
use Illuminate\Http\Request;

class InterestController extends Controller
{
    public function store(Request $request, Idea $idea)
    {
        $validated = $request->validate([
            'message' => 'nullable|string|max:1000',
        ]);

        Interest::create([
            'idea_id' => $idea->id,
            'user_id' => auth()->id(),
            'message' => $validated['message'] ?? null,
        ]);

        return redirect()->route('ideas.show', $idea)->with('success', 'Your interest has been submitted! The idea owner will be notified.');
    }
}
