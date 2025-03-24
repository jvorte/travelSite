@extends('layouts.app')

@section('content')
    <div class="container title">
        <h1 class="display-4 text-center">Trip & Tips</h1>
        <p class="text-center">Here you can find travel tips and recommendations for your next adventure!</p>
    </div>

    <div class="container text-center">
        <div class="row">
            <div class="col-sm-6">
                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
                    <div class="carousel-indicators">
                      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img src="{{ asset('storage/trip-images/' . $trip->image1) }}" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                          <h5>{{ Str::beforeLast($trip->image1, '.')}}</h5>
                          <p>{{ $trip->description }}</p>
                        </div>
                      </div>
                      <div class="carousel-item">
                        <img src="{{ asset('storage/trip-images/' . $trip->image2) }}" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                          <h5>{{ Str::beforeLast($trip->image2, '.')}}</h5>
                          <p>{{ $trip->description }}</p>
                        </div>
                      </div>
                      <div class="carousel-item">
                        <img src="{{ asset('storage/trip-images/' . $trip->image3) }}" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                          <h5>{{ Str::beforeLast($trip->image3, '.')}}</h5>
                          <p>{{ $trip->description }}</p>
                        </div>
                      </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                  </div>
            </div>

            <div class="col-sm-6">
                <!-- Form for Adding/Removing Favorite -->
                <form action="{{ route('favorites.addToFavorites', $trip->id) }}" method="POST">
                  @csrf
                  @if(Auth::check() && Auth::user()->favorites && Auth::user()->favorites->contains($trip))
                  <!-- Αν είναι ήδη στα αγαπημένα, αφαιρούμε -->
                  @method('DELETE')
                  <button type="submit" class="btn text-danger">
                      <i class="fas fa-heart"></i> Remove from Favorites
                  </button>
              @elseif(Auth::check()) <!-- Αν ο χρήστης είναι συνδεδεμένος αλλά δεν είναι στα αγαπημένα -->
                  <!-- Αν δεν είναι στα αγαπημένα, προσθέτουμε -->
                  <button type="submit" class="btn text-primary">
                      <i class="far fa-heart"></i> Add to Favorites
                  </button>
              @endif
              
              </form>
              

                
                <h1>{{ $trip->title }}</h1>
                <p>{{ $trip->description }}</p>
                <p>{{ $trip->location }}</p>
            </div>
        </div>
    </div>

@endsection
