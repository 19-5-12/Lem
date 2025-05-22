<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Memory;

class MemoryController extends Controller
{
    public function index()
{
    $memories = Memory::latest()->get();
    return view('memories.index', compact('memories'));
}

    public function store(Request $request)
{
    $request->validate([
        'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'caption' => 'required|string|max:255',
    ]);

    $paths = [];
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $paths[] = $image->store('memories', 'public');
        }
    }

    Memory::create([
        'caption' => $request->caption,
        'image_paths' => $paths,
    ]);

    return redirect()->back()->with('success', 'Memory uploaded!');
}
}

