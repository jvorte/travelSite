@extends('layouts.app')

@section('content')
    <div class="container title">
        <h1 class="display-4 text-center">Trips & Tips</h1>
        <p class="text-center">Here you can find travel tips and recommendations for your next adventure!</p>
        
        @foreach ($trips as $trip)
         {{-- card --}}
         <div class="card mb-3" style="max-width: 100%;">
            <div class="row g-0">
              <div class="col-md-4">
                @if ($trip->image)
                <img src="{{ asset('storage/' . $trip->image) }}" alt="{{ $trip->title }}" />
                @endif
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title">{{ $trip->title }}</h5> <!-- Αλλαγή από name σε title -->
                  <p class="card-text">{{ $trip->description }}</p>
                  <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
              </div>
            </div>
          </div>
        {{-- end card --}}
        @endforeach
    </div>
@endsection
