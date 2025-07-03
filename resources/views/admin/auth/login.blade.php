@extends('admin.layout.admin')
@section('content')
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow p-4" style="max-width: 400px; width: 100%;">
      <h3 class="text-center mb-4">Admin Login</h3>
      <form action="{{ route('admin.login.submit') }}" method="POST">
        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input type="email" class="form-control" name="email" id="email" placeholder="admin@example.com" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password" required>
        </div>
        @csrf
        <button type="submit" class=" food-profile-submit px-3 py-1 w-100">Login</button>
      </form>
    </div>
  </div>

  @if(session('error'))
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Login Failed',
        text: '{{ session('error') }}',
        confirmButtonColor: '#ef4c28'
      });
    </script>
  @endif
  @if(session('success'))
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Login Successful',
        text: '{{ session('success') }}',
        confirmButtonColor: '#28a745'
      });
    </script>
  @endif
@endsection