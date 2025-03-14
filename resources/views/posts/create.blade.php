@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Νέο Άρθρο</h1>
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Τίτλος</label>
            <input type="text" name="title" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Περιεχόμενο</label>
            <textarea name="content" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Εικόνα</label>
            <input type="file" name="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Δημιουργία</button>
    </form>
</div>
@endsection
