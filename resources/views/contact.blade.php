{{--  contact section --}}
@extends('layouts.app')

@section('content')
    <div class="container title">
        <h1 class="display-4 text-center">Contact</h1>
        <p class="lead text-center my-3">
            We would love to hear from you! If you have any questions, comments, or suggestions, please feel free to contact us.
        </p>
    </div>
    <div class="container">
        <div class="row mt-5">
 
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

    </div>
 
   
@endsection
{{-- end contact section --}}