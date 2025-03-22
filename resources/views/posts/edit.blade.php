@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Επεξεργασία Άρθρου</h1>

    <form action="{{ route('posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Τίτλος</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}" required>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Περιεχόμενο</label>
            <textarea class="form-control" id="content" name="content" rows="5" required>{{ $post->content }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Αποθήκευση</button>
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Ακύρωση</a>
    </form>
</div>
@endsection
