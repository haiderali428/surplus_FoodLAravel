@extends('layout.admin')
@extends('admin.header.admin_header')

@section('content')
    <div class="container mt-5">
        <h1>User Details</h1>
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">{{ $user->name }}</h5>
                <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
                <p class="card-text"><strong>Role:</strong> {{ ucfirst($user->role ?? 'User') }}</p>
                <p class="card-text"><strong>Status:</strong> {{ $user->status ?? 'Active' }}</p>
                <p class="card-text"><strong>Registered At:</strong> {{ $user->created_at ? $user->created_at->format('d/m/Y') : '' }}</p>
                <!-- Add more user details or management actions here -->
            </div>
        </div>
        <a href="{{ route('admin.users') }}" class="btn btn-secondary mt-3">Back to User List</a>
    </div>
@endsection 