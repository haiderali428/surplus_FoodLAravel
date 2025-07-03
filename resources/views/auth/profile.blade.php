@extends('layout.app')
@extends('header.main_header')
@section('content')
<div class="">

<div class="main">

<main class="content mt-0">
    <div class="container-fluid p-sm-2">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

        <h1 class="dashboard-heading-2 fw-bolder">Setting</h1>
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3">
                <nav class=" px-3 py-2 setting-nav">

                    <ul class="nav flex-column" id="myTab" role="tablist">
                        <li class="nav-item mb-2 ">
                            <a class="nav-link active setting-navtab" id="profile-tab" data-bs-toggle="tab"
                                href="#profile" role="tab" aria-controls="profile" aria-selected="true">
                                        <i class="fas fa-user me-2"></i>Profile
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                                    <a class="nav-link setting-navtab" id="password-tab" data-bs-toggle="tab"
                                        href="#password" role="tab" aria-controls="password"
                                aria-selected="false">
                                        <i class="fas fa-lock me-2"></i>Change Password
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="col-md-9 mt-sm-0 mt-3">

                <div class="tab-content  w-100">
                    <div class="tab-pane fade show active" id="profile" role="tabpanel"
                        aria-labelledby="profile-tab">

                        <section class="container-fluid setting-nav">

                            <div
                                class="food-updateprofile-right d-flex flex-sm-row flex-column gap-md-3 gap-2 align-items-center justify-content-between">
                                <div
                                    class="d-flex flex-wrap justify-content-center my-2 align-items-center gap-3 position-relative">

                                            <!-- Profile image with role badge -->
                                    <div class="position-relative">
                                        <img id="profileImage"
                                                    src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('img/avatars/avatar-2.jpg') }}"
                                                    style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 4px solid #ff6b35;"
                                            alt="Profile" class="align-items-center">

                                                <!-- Role badge -->
                                                <div class="position-absolute top-0 start-100 translate-middle badge rounded-pill" 
                                                     style="background: linear-gradient(45deg, #ff6b35, #f7931e); border: 2px solid white; font-size: 0.7rem; transform: translate(-50%, -50%);">
                                                    {{ ucfirst($user->role) }}
                                                </div>
                                    </div>

                                    <!-- Username and email -->
                                    <div class="food-username">
                                                <p class="mb-2" style="color: #2c3e50; font-size: 1.2rem; font-weight: bold;">{{ $user->first_name }} {{ $user->last_name }}</p>
                                                <span style="color: #7f8c8d; font-size: 0.9rem;">{{ $user->email }}</span>
                                            </div>
                                        </div>
                                    </div>

                        </section>

                        <section class="container-fluid setting-nav mt-3">
                            <div class="form p-2 p-sm-4">

                                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <h3 class="verification-heading mb-3">
                                                <i class="fas fa-user-edit me-2"></i>User Details
                                            </h3>
                                    <div class="row ">
                                        <div class="col-sm-6 mb-3">
                                                    <label for="firstName" class="form-label lable-text">
                                                        <i class="fas fa-user me-1"></i>First Name
                                                    </label>
                                                    <input type="text" class="form-input @error('first_name') is-invalid @enderror" 
                                                        id="firstName" name="first_name" value="{{ old('first_name', $user->first_name) }}"
                                                        placeholder="Enter first name">
                                                    @error('first_name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                        </div>
                                        <div class="col-sm-6 mb-3">
                                                    <label for="lastName" class="form-label lable-text">
                                                        <i class="fas fa-user me-1"></i>Last Name
                                                    </label>
                                                    <input type="text" class="form-input @error('last_name') is-invalid @enderror" 
                                                        id="lastName" name="last_name" value="{{ old('last_name', $user->last_name) }}"
                                                        placeholder="Enter last name">
                                                    @error('last_name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                                <label for="email" class="form-label lable-text">
                                                    <i class="fas fa-envelope me-1"></i>Email Address
                                                </label>
                                                <input type="email" class="form-input @error('email') is-invalid @enderror" 
                                                    id="email" name="email" value="{{ old('email', $user->email) }}"
                                                    placeholder="Enter email">
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                    </div>
                                    <div class="mb-3">
                                                <label for="phone" class="form-label lable-text">
                                                    <i class="fas fa-phone me-1"></i>Phone Number
                                                </label>
                                                <input type="text" class="form-input @error('phone_number') is-invalid @enderror" 
                                                    id="phone" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}"
                                                    placeholder="Enter phone number">
                                                @error('phone_number')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                    </div>
                                            <div class="mb-3">
                                                <label for="address" class="form-label lable-text">
                                                    <i class="fas fa-map-marker-alt me-1"></i>Address
                                                </label>
                                                <textarea class="form-input @error('address') is-invalid @enderror" 
                                                    id="address" name="address" rows="3" placeholder="Enter address">{{ old('address', $user->address) }}</textarea>
                                                @error('address')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="city" class="form-label lable-text">
                                                    <i class="fas fa-city me-1"></i>City
                                                </label>
                                                <input type="text" class="form-input @error('city') is-invalid @enderror" 
                                                    id="city" name="city" value="{{ old('city', $user->city) }}"
                                                    placeholder="Enter city">
                                                @error('city')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                        </div>
                                            <div class="mb-3">
                                                <label for="role" class="form-label lable-text">
                                                    <i class="fas fa-user-tag me-1"></i>Role
                                                </label>
                                                <select class="form-input @error('role') is-invalid @enderror" 
                                                    id="role" name="role">
                                                    <option value="donor" {{ $user->role == 'donor' ? 'selected' : '' }}>Donor</option>
                                                    <option value="receiver" {{ $user->role == 'receiver' ? 'selected' : '' }}>Receiver</option>
                                                    <option value="volunteer" {{ $user->role == 'volunteer' ? 'selected' : '' }}>Volunteer</option>
                                            </select>
                                                @error('role')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="profile_picture" class="form-label lable-text">
                                            <i class="fas fa-image me-1"></i>Profile Picture
                                        </label>
                                        <input type="file" class="form-input @error('profile_picture') is-invalid @enderror"
                                               id="profile_picture" name="profile_picture" accept="image/*">
                                        @error('profile_picture')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 w-100 d-flex justify-content-end gap-3">
                                        <input type="submit" class=" food-profile-submit px-3 py-1"
                                                    value="Save Changes">
                                    </div>

                                </form>

                            </div>
                        </section>
                    </div>
                            
                            <div class="tab-pane fade" id="password" role="tabpanel"
                                aria-labelledby="password-tab">
                                <section class="container-fluid setting-nav p-2 p-sm-4">
                                    <h3 class="verification-heading mb-3">
                                        <i class="fas fa-key me-2"></i>Change Password
                                    </h3>
                                    <form action="{{ route('profile.update-password') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="current_password" class="form-label lable-text">
                                                <i class="fas fa-lock me-1"></i>Current Password
                                            </label>
                                            <input type="password" class="form-input @error('current_password') is-invalid @enderror" 
                                                id="current_password" name="current_password" required>
                                            @error('current_password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                            </div>
                                        <div class="mb-3">
                                            <label for="new_password" class="form-label lable-text">
                                                <i class="fas fa-lock me-1"></i>New Password
                                            </label>
                                            <input type="password" class="form-input @error('new_password') is-invalid @enderror" 
                                                id="new_password" name="new_password" required>
                                            @error('new_password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                            </div>
                                        <div class="mb-3">
                                            <label for="confirm_password" class="form-label lable-text">
                                                <i class="fas fa-lock me-1"></i>Confirm New Password
                                            </label>
                                            <input type="password" class="form-input @error('confirm_password') is-invalid @enderror" 
                                                id="confirm_password" name="confirm_password" required>
                                            @error('confirm_password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                            </div>
                                        <div class="mb-3 w-100 d-flex justify-content-end gap-3">
                                            <input type="submit" class="food-profile-submit px-3 py-1" value="Update Password">
                            </div>
                                    </form>
                                </section>
                            </div>
                            </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    </div>

@push('scripts')
    <script>
document.addEventListener('DOMContentLoaded', function() {
    // Password toggle functionality
    const passwordInputs = document.querySelectorAll('input[type="password"]');
    passwordInputs.forEach(input => {
        const toggleBtn = input.parentElement.querySelector('.food-toggle-password');
        if (toggleBtn) {
            toggleBtn.addEventListener('click', function() {
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);
                const icon = this.querySelector('i');
                icon.classList.toggle('bi-eye');
                icon.classList.toggle('bi-eye-slash');
            });
        }
    });
        });
    </script>
@endpush

@endsection