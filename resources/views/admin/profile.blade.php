@extends('admin.layout.admin')
@extends('admin.header.admin_header')

@section('content')
<div class="main">
    <nav class="navbar navbar-expand navbar-theme py-3" style="background-color: rgba(245, 245, 245, 1) !important;">
        <a class="sidebar-toggle d-flex d-md-none me-2">
            <i class="hamburger align-self-center"></i>
        </a>

        <div class="navbar-collapse collapse">
            <ul class="navbar-nav ms-auto">
                @include('admin.partials.admin_profile_dropdown')
            </ul>
        </div>
    </nav>

    <div class="container-fluid p-sm-2">
        <div class="row">
            <div class="col-12">
                <h1 class="dashboard-heading fw-bolder">Admin Profile</h1>
                
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 text-center">
                                @if($admin->profile_picture)
                                    <img src="{{ asset('storage/' . $admin->profile_picture) }}" 
                                         alt="Admin Profile" 
                                         class="img-fluid rounded-circle mb-3" 
                                         style="width: 150px; height: 150px; object-fit: cover;">
                                @else
                                    <img src="../img/dashboard/profile.png" 
                                         alt="Default Profile" 
                                         class="img-fluid rounded-circle mb-3" 
                                         style="width: 150px; height: 150px; object-fit: cover;">
                                @endif
                                
                                <h4>{{ $admin->name }}</h4>
                                <p class="text-muted">Administrator</p>
                            </div>
                            
                            <div class="col-md-8">
                                <h5>Profile Information</h5>
                                <hr>
                                
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <strong>Name:</strong>
                                    </div>
                                    <div class="col-sm-9">
                                        {{ $admin->name }}
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <strong>Email:</strong>
                                    </div>
                                    <div class="col-sm-9">
                                        {{ $admin->email }}
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <strong>Member Since:</strong>
                                    </div>
                                    <div class="col-sm-9">
                                        {{ $admin->created_at ? $admin->created_at->format('F j, Y') : 'N/A' }}
                                    </div>
                                </div>
                                
                                <div class="mt-4">
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                                        <i class="fas fa-edit me-2"></i>Edit Profile
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $admin->name }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $admin->email }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="profile_picture" class="form-label">Profile Picture</label>
                        @if($admin->profile_picture)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $admin->profile_picture) }}" 
                                     alt="Current Profile" 
                                     style="max-width: 100px; border-radius: 50%;">
                            </div>
                        @endif
                        <input type="file" class="form-control" id="profile_picture" name="profile_picture" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 