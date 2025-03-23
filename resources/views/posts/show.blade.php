@extends('layouts.app')

@section('content')
<div class="container">
    <img class="img-fluid rounded-2" src="{{ asset('storage/images/see.jpg') }}" alt="Image description">
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->content }}</p>

    <p>Created by: {{ $post->user->name }}</p>

    <!-- Εμφάνιση Edit & Delete αν ο χρήστης είναι admin ή ο δημιουργός -->
    @if(auth()->check() && (auth()->user()->isAdmin() || auth()->id() === $post->user_id))
        <a href="{{ route('posts.edit', $post->id) }}" class="btn text-warning mb-3">Edit</a>

        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn text-danger mb-3" onclick="return confirm('Είσαι σίγουρος;')">Delete</button>
        </form>
    @endif

    <!-- Σχόλια -->
    <h3>Comments</h3>
    @foreach($post->comments as $comment)
    <div class="border p-2 mb-2">
        <p>reply from: <strong>{{ $comment->user->name }}</strong>: {{ $comment->body }}</p> <!-- Εδώ αλλάζεις από content σε body -->
    </div>
@endforeach

    <!-- Φόρμα προσθήκης σχολίου -->
    @auth
    <form action="{{ route('posts.comments.store', $post->id) }}" method="POST">
        @csrf
        <textarea name="content" class="form-control" placeholder="Write a comment..."></textarea>
        <button type="submit" class="btn text-primary mt-2">reply</button>
    </form>
    
    @else
        <p><a href="{{ route('login') }}">Login</a> to add a comment.</p>
    @endauth
</div>
@endsection