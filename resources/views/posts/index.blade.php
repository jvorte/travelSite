@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Blog</h1>
    @foreach($posts as $post)
        <div class="card mb-3">
            <div class="card-body">
                <h2><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h2>
                <p>{{ Str::limit($post->content, 100) }}</p>
                <a href="{{ route('posts.show', $post) }}" class="btn btn-primary">Διαβάστε περισσότερα</a>
            </div>
        </div>
    @endforeach
    {{ $posts->links() }}
</div>
@endsection
