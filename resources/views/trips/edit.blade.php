<!-- resources/views/trips/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Trip</h1>

        <form action="{{ route('trips.update', $trip->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Trip Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $trip->name) }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" required>{{ old('description', $trip->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="image">Image (optional)</label>
                <input type="file" name="image" id="image" class="form-control">
                @if ($trip->image)
                    <img src="{{ asset('storage/' . $trip->image) }}" alt="Trip Image" width="150">
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Update Trip</button>
        </form>
    </div>
@endsection
