<?php

use Illuminate\Support\Facades\Route;
use App\Models\Message;
use App\Models\Memory;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\MemoryController;

Route::get('/', function () {
    $latestMessage = Message::latest()->first();
    $latestMemory = Memory::latest()->first();
    return view('home', compact('latestMessage', 'latestMemory'));
});

Route::get('/', function () {
    $messages = Message::all();
    $memories = Memory::all();
    return view('home', compact('messages', 'memories'));
});

Route::get('/messages', [MessageController::class, 'index']);
Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
Route::get('/memories', [MemoryController::class, 'index']);
Route::post('/memories', [MemoryController::class, 'store'])->name('memories.store');

