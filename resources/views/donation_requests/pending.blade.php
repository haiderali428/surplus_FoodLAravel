@extends('layout.app')
@section('header')
    @include('header.main_header')
@endsection
@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center" style="font-weight: bold; color: #0C8C85;">
        <i class="fas fa-clock me-2"></i>Pending Donation Requests
    </h2>
    @if($pendingRequests->isEmpty())
        <div class="text-center py-5">
            <i class="fas fa-inbox" style="font-size: 3rem; color: #bdc3c7; margin-bottom: 1rem;"></i>
            <h4 style="color: #7f8c8d;">You have no pending donation requests.</h4>
        </div>
    @else
        <div class="row g-4">
            @foreach($pendingRequests as $request)
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm h-100" style="border-radius: 15px;">
                        @if($request->post && $request->post->image)
                            <img src="{{ asset('storage/' . $request->post->image) }}" class="card-img-top" alt="Donation Image" style="border-radius: 15px 15px 0 0; height: 180px; object-fit: cover;">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title mb-2" style="color: #0C8C85;">
                                <i class="fas fa-gift me-1"></i>{{ $request->post->item_name ?? 'Donation Post' }}
                            </h5>
                            <p class="card-text text-muted mb-2" style="min-height: 48px;">
                                {{ $request->post->description ?? 'No description available' }}
                            </p>
                            <div class="mt-auto">
                                <span class="badge bg-warning text-dark mb-2" style="font-size: 1rem;">
                                    <i class="fas fa-hourglass-half me-1"></i>Pending
                                </span>
                                @if($request->post && $request->post->expire_date)
                                    <div>
                                        <small class="text-muted">
                                            <i class="fas fa-calendar-alt me-1"></i>
                                            Expires: {{ \Carbon\Carbon::parse($request->post->expire_date)->format('M d, Y') }}
                                        </small>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection 