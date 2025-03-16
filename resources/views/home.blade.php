@extends('layouts.app')

@section('content')

{{-- main section --}}
    <div class="container-fluid text-center min-vh-100" id="home">
        <div class="row">
            <div class="title col-sm-5">
                <h1 class="display-1 mt-5">
                    Discover the world with every journey,
            
                </h1>
                <p class="display-5 mt-5">
                    Dream far and live the present.
                </p>
              
                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            </div>
            <div class="col-sm-7 mt-3">
                <img class="img-fluid rounded-2" src="{{ asset('storage/images/a.jpg') }}" alt="Image description">

            </div>
        </div>

{{--end  main section --}}

{{-- about section --}}
        <div class="container title my-5 min-vh-100 " id="about">
            <h1 class="display-5 my-5  text-center ">
                About Us</h1>
            <p class="lead text-center">
                We are passionate travelers, storytellers, and adventure seekers. Our mission is to inspire you to explore the world, discover hidden gems, and create unforgettable memories. Through personal experiences, breathtaking photography, and insightful travel tips, we bring you closer to the beauty of each destination.

                Join us as we explore the beauty of the world, one journey at a time. Your next adventure starts here!
            </p>
            <div class="row mt-5">
                <div class="col-sm-4">
                    <img class="img-fluid rounded-2 my-2" src="{{ asset('storage/images/7.jpg') }}" alt="Image description">
                </div>
                <div class="col-sm-4">
                    <img class="img-fluid rounded-2 my-2" src="{{ asset('storage/images/b.jpg') }}" alt="Image description">
                </div>
                <div class="col-sm-4">
                    <img class="img-fluid rounded-2 my-2" src="{{ asset('storage/images/c.jpg') }}" alt="Image description">
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <h2 class="display-6 mt-1">
                        Explore
                    </h2>
                    <p class="lead">
                        Explore the world with us and discover the beauty of nature.
                    </p>
                </div>
                <div class="col-sm-4">
                    <h2 class="display-6 mt-1">
                        Discover
                    </h2>
                    <p class="lead">
                        Discover the beauty of the world and the beauty of life.
                    </p>
                </div>
                <div class="col-sm-4">
                    <h2 class="display-6 mt-1">
                        Dream
                    </h2>
                    <p class="lead">
                        Dream far and live the present.
                    </p>
                </div>
            </div>
        </div>
{{-- end about section --}}

{{--  contact section --}}
<div class="container title" id="contact">
    <h1 class="display-5 text-center">
        Contact Us
    </h1>
    <p class="lead text-center my-3">
        We would love to hear from you! If you have any questions, comments, or suggestions, please feel free to contact us.
    </p>
    <div class="row">
        <div class="col-sm-6">
            <form action="{{ route('contact.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-danger my-2">Send</button>
            </form>
            
            
            @if (session('success'))
                <div class="alert alert-success mt-3">
                    {{ session('success') }}
                </div>
            @endif
            
        </div>
        <div class="col-sm-6">
            <img class="img-fluid rounded-2" src="{{ asset('storage/images/d.jpg') }}" alt="Image description">
        </div>
    </div>
</div>
{{-- end contact section --}}
<!-- Scroll to Top Button -->
<button id="scrollToTopBtn" class="btn btn-danger position-fixed" style="display: none; bottom: 20px; right: 20px; z-index: 1000; width: 50px; height: 50px; border-radius: 50%;">
    ↑
</button>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const scrollToTopBtn = document.getElementById("scrollToTopBtn");

        window.addEventListener("scroll", function () {
            if (window.scrollY > 300) {
                scrollToTopBtn.style.display = "block";
            } else {
                scrollToTopBtn.style.display = "none";
            }
        });

        scrollToTopBtn.addEventListener("click", function () {
            window.scrollTo({ top: 0, behavior: "smooth" });
        });
    });
</script>

@endsection