<!-- resources/views/trips/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create a New Trip</h1>

        <form action="{{ route('trips.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
        
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" required></textarea>
            </div>
        
            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" name="location" id="location" class="form-control" required>
            </div>
        
            <div class="form-group">
                <label for="tips">Tips (optional)</label>
                <textarea name="tips" id="tips" class="form-control"></textarea>
            </div>
        
            <div class="form-group">
                <label for="image1">Image 1</label>
                <input type="file" name="image1" id="image1" class="form-control">
            </div>
        
            <div class="form-group">
                <label for="image2">Image 2</label>
                <input type="file" name="image2" id="image2" class="form-control">
            </div>
        
            <div class="form-group">
                <label for="image3">Image 3</label>
                <input type="file" name="image3" id="image3" class="form-control">
            </div>
        
            <button type="submit" class="btn btn-primary">Create Trip</button>
        </form>
        
    </div>
@endsection
