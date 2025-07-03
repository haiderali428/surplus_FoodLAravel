@extends('layout.app')
@extends('header.login_signup_header')
@section('content')


    <section class="surplus-login-sect py-5">
        <div class="container surpluslogin-page">
        <div class="  row py-5 mt-4">
          <div class="col-lg-6 surpluslogin-left d-flex flex-column justify-content-center align-items-center">
                <h2 class="text-center">Welcome To Surplus Food Redistribution Platform</h2>
                <p>Please Sign Up</p>
          </div>
          <div class="col-lg-6 surpluslogin-right">
            <form action="{{route('user.signup')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <h1 class="signup-form_heading mb-3">Sign Up</h1>
                <input type="email" class="form-control surplus-login-input mb-3 p-3 " name="email" placeholder="Email Address" required>
                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>                 
                @enderror
                <input type="password" class="form-control surplus-login-input p-3 mb-3" name="password" placeholder="Password" required>
                @error('password')
                <div class="alert alert-danger">{{ $message }}</div>   
                @enderror
                <input type="password" class="form-control surplus-login-input p-3 mb-3" name="c_password" placeholder="Repeat Password" required>
                @error('c_password')
                <div class="alert alert-danger">{{ $message }}</div>                  
                @enderror
                <button class="btn surplus-login-btn w-100 p-2 mb-3">Sign up</button>
                <div class="surplus-divider-main d-flex align-items-center justify-content-between mb-3">
                          <span class="surplus-divider-line w-100 me-5 rounder-5" style="height: 2px; background-color: white;"></span>
                      <span class="text-white fs-6" >OR</span>
                      <span class="surplus-divider-line w-100 ms-5 rounder-5" style="height: 2px; background-color: white;"></span>
                </div>
                <button class="btn surplus-login-btn2 w-100 p-2 mb-3 w-100 d-flex align-items-center justify-content-center">
                  <img src="../img/Home/Google__G__logo.svg.webp" style="width: 20px; height: 20px;" class="me-2" alt="Google"> SIGN UP WITH GOOGLE
                </button>
                <div class="d-flex justify-content-between login-form-footer">
                  <a href="{{route('login')}}" class="text-white">Already have an account? <u>Sign in</u></a>
                </div>
                
                <div class="surplus-social-icons  d-flex align-items-center justify-content-center mt-3  gap-3">
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