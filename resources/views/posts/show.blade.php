@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->content }}</p>

    <p>Δημιουργήθηκε από: {{ $post->user->name }}</p>

    <!-- Εμφάνιση Edit & Delete αν ο χρήστης είναι admin ή ο δημιουργός -->
    @if(auth()->check() && (auth()->user()->isAdmin() || auth()->id() === $post->user_id))
        <a href="{{ route('posts.edit', $post->id) }}" class="btn text-warning mb-3">Edit</a>

        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn text-danger mb-3" onclick="return confirm('Είσαι σίγουρος;')">Delete</button>
        </form>
    @endif
</div>
@endsection
