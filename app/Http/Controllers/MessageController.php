<?php

namespace App\Http\Controllers;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::latest()->get();
        return view('messages.index', compact('messages'));
    }

public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
        Message::create($request->only('title', 'body'));
        return redirect()->back()->with('success', 'Message sent!');
    }

}


