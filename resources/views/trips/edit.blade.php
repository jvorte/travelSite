@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Trip</h1>

        <form action="{{ route('trips.update', $trip->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Trip Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $trip->title) }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" required>{{ old('description', $trip->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" name="location" id="location" class="form-control" value="{{ old('location', $trip->location) }}" required>
            </div>

            <div class="form-group">
                <label for="tips">Tips (optional)</label>
                <textarea name="tips" id="tips" class="form-control">{{ old('tips', $trip->tips) }}</textarea>
            </div>

            <!-- Image 1 -->
            <div class="form-group">
                <label for="image1">Image 1 (optional)</label>
                <input type="file" name="image1" id="image1" class="form-control">
                @if ($trip->image1)
                    <img src="{{ asset('storage/' . $trip->image1) }}" alt="Trip Image 1" width="150">
                @endif
            </div>

            <!-- Image 2 -->
            <div class="form-group">
                <label for="image2">Image 2 (optional)</label>
                <input type="file" name="image2" id="image2" class="form-control">
                @if ($trip->image2)
                    <img src="{{ asset('storage/' . $trip->image2) }}" alt="Trip Image 2" width="150">
                @endif
            </div>

            <!-- Image 3 -->
            <div class="form-group">
                <label for="image3">Image 3 (optional)</label>
                <input type="file" name="image3" id="image3" class="form-control">
                @if ($trip->image3)
                    <img src="{{ asset('storage/' . $trip->image3) }}" alt="Trip Image 3" width="150">
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Update Trip</button>
        </form>
    </div>
@endsection
