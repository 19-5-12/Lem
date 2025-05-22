@extends('layouts.app')

@section('content')
<h2>Sweet Messages 💌</h2>

<form method="POST" action="{{ route('messages.store') }}">
    @csrf
    <div class="mb-3">
        <input type="text" name="title" class="form-control" placeholder="Message title" required>
    </div>
    <div class="mb-3">
        <textarea name="body" class="form-control" placeholder="Write something sweet..." required></textarea>
    </div>
    <button class="btn btn-primary">Send Message</button>
</form>

<hr>

@foreach ($messages as $message)
    <div class="card mb-3">
        <div class="card-body">
            <h5>{{ $message->title }}</h5>
            <p>{{ $message->body }}</p>
        </div>
    </div>
@endforeach
@endsection
