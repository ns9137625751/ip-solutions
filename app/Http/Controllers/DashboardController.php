<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $myIdeas = $user->ideas()->with('interests.user')->latest()->get();
        $myInterests = $user->interests()->with('idea.user')->latest()->get();

        return view('dashboard', compact('myIdeas', 'myInterests'));
    }
}
