@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Δημιουργία Άρθρου</h1>

    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Τίτλος</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Περιεχόμενο</label>
            <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Δημοσίευση</button>
    </form>
</div>
@endsection

