<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index()
    {
        $ideas = Idea::where('status', 'approved')
            ->where('is_visible', true)
            ->orderBy('updated_at', 'desc')
            ->get();

        $content = view('sitemap', compact('ideas'))->render();

        return response($content, 200)
            ->header('Content-Type', 'text/xml');
    }
}
