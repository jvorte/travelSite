@extends('layouts.app')

@section('content')
    <div class="container title">
        <h1 class="display-4 text-center">My Favorite Trips</h1>
        <p class="text-center">Here you can find travel tips and recommendations for your next adventure!</p>
    </div>
    <div class="container">
        <img class="img-fluid rounded-2" src="{{ asset('storage/images/fiat.jpg') }}" alt="Image description">
        
        @if($favorites->isEmpty())
            <p>You have no favorite trips yet.</p>
        @else
            <ul>
                @foreach ($favorites as $trip)
                    <li>
                        <h3>{{ $trip->title }}</h3>
                        <p>{{ $trip->description }}</p>
                        <form action="{{ route('favorites.destroy', $trip->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn text-danger">Remove from Favorites</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
