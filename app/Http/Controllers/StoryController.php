<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Story; // ✅ Pastikan ini ditambahkan

class StoryController extends Controller
{
    public function index()
    {
        $stories = Story::latest()->get(); // ✅ Ambil semua story
        return view('front.stories.index', compact('stories'));
    }

    public function show($slug)
    {
        $story = Story::where('slug', $slug)->firstOrFail(); // ✅ perbaikan: titik dua jadi panah -> dan kapitalisasi method
        return view('front.stories.show', compact('story'));
    }
}
