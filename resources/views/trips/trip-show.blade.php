<h1>{{ $trip->title }}</h1>
<p>{{ $trip->description }}</p>
<p>{{ $trip->location }}</p>

<!-- Εικόνες του ταξιδιού -->
<img src="{{ asset('storage/trip-images' . $trip->image1) }}" alt="Image 1">
<img src="{{ asset('storage/trip-images' . $trip->image2) }}" alt="Image 2">
<img src="{{ asset('storage/trip-images' . $trip->image3) }}" alt="Image 3">

<!-- Πίσω στην αρχική σελίδα -->
<a href="{{ route('trips.index') }}">Πίσω στις λίστες</a>
