@extends('layout.app')
@extends('header.main_header')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h2 class="mb-4 text-center">Contact Us</h2>
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <form method="POST" action="{{ route('contact_us.submit') }}">
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
                            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Send Message</button>
                    </form>
                </div>
            </div>
            <div class="text-center mt-4">
                <div>Email: <a href="mailto:info@surplusfood.com">info@surplusfood.com</a></div>
                <div>Phone: +1 (555) 123-4567</div>
                <div>Address: 123 Food Rescue Lane, City, Country</div>
            </div>
        </div>
    </div>
</div>
@endsection 