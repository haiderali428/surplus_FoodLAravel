@extends('layout.app')
@extends('header.login_signup_header')
@section('content')

        <section class="surplus-login-sect py-5">
            <div class="container surpluslogin-page">
            <div class="  row py-5 mt-4">
              <div class="col-lg-6 surpluslogin-left d-flex flex-column justify-content-center align-items-center">
                    <h2 class="text-center">Welcome To Surplus Food Redistribution Platform</h2>
                    <p>Forgot Your Password?</p>
              </div>
              <div class="col-lg-6 surpluslogin-right">
                <form action="{{ route('forgot.password') }}" method="POST">
                    @csrf
                    <h1 class="signup-form_heading mb-3">Reset Password</h1>
                    
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    
                    <input type="email" name="email" class="form-control surplus-login-input mb-3 p-3" placeholder="Email Address" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    
                    <button type="submit" class="btn surplus-login-btn w-100 p-2 mb-3">Send Reset Link</button>
                    
                    <div class="surplus-divider-main d-flex align-items-center justify-content-between mb-3">
                              <span class="surplus-divider-line w-100 me-5 rounder-5" style="height: 2px; background-color: white;"></span>
                          <span class="text-white fs-6" >OR</span>
                          <span class="surplus-divider-line w-100 ms-5 rounder-5" style="height: 2px; background-color: white;"></span>
                    </div>
                    
                    <div class="d-flex justify-content-between login-form-footer">
                      <a href="{{ route('login') }}" class="text-white">Back to Login</a>
                      <a href="{{ route('signup') }}" class="text-white">Don't have an account? <u>Sign Up</u></a>
                    </div>
                    
                    <div class="surplus-social-icons  d-flex align-items-center justify-content-center mt-3 gap-3">
                     <a href="">   <i class="fab fa-facebook" ></i> </a>
                      <a href="">  <i class="fab fa-instagram" ></i> </a>
                      <a href="">  <i class="fab fa-twitter" ></i> </a>
                      <a href="">  <i class="fab fa-linkedin" ></i> </a>
                       <a href=""> <i class="fab fa-tiktok" ></i> </a>
                      <a href="">  <i class="fas fa-globe" ></i>  </a>
                      </div>
                  </form>
              </div>
            </div>
        </div>
        </section>
    
@endsection