@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="display-4 text-center">Blog</h1>

    <!-- Εμφάνιση του κουμπιού ADD μόνο αν ο χρήστης είναι admin -->
    @if(auth()->check() && auth()->user()->isAdmin())
        <a href="{{ route('posts.create') }}" class="btn text-success mb-3">+ Add</a>
    @endif

    <p class="text-center">Here you can find travel tips and recommendations for your next adventure!</p>

    @foreach($posts as $post)
        <div class="card mb-3">
            <div class="card-body">
                <h2><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h2>
                <p>{{ Str::limit($post->content, 100) }}</p>
                <a href="{{ route('posts.show', $post) }}" class="btn btn-primary">Διαβάστε περισσότερα</a>

                <!-- Εμφάνιση Edit & Delete αν ο χρήστης είναι admin ή ο δημιουργός -->
                @if(auth()->check() && (auth()->user()->isAdmin() || auth()->id() === $post->user_id))
                    <a href="{{ route('posts.edit', $post->id) }}" class="btn text-warning">Edit</a>

                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn text-danger" onclick="return confirm('Είσαι σίγουρος;')">Delete</button>
                    </form>
                @endif
            </div>
        </div>
    @endforeach

    {{ $posts->links() }}
</div>
@endsection
