@extends('layout.app')
@extends('header.main_header')
@section('content')
<main class="content">
    <!--######## hero section started here #########-->
    <div class="container">
        <div class="row surplus-home-hero">
            <div class="col-lg-6 d-flex flex-column gap-3 align-items-center justify-content-center surplus-home-hero-left text-center px-3 py-2">
                <h1 class="header-title">Waste Less, Feed More.</h1>
                <h2 class="header-subtitle">#betherescue</h2>

                <div class="surplus-home-volunteer d-flex justify-content-center w-100 align-items-center py-3">
                    <a href="{{ route('signup') }}" class="btn btn-primary px-3 py-2 border-3">Become A Volunteer</a>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="./img/Home/Home_hero_img3.avif" class="w-100 h-100" alt="">
            </div>
        </div>
    </div>
    <!--###### hero section ended here #######-->

    <section class="container mt-4">
        <div class="d-flex flex-column justify-content-center align-items-center">
      <h1 class="section-title text-center py-md-2 py-0"> What We Do</h1>
      <div class="home-divider"></div>
    </div>
    <div class="row mt-md-2 mt-0">
        <div class="col-md-4 d-flex flex-column justify-content-center align-items-center ">
            <h2 class="card-header-subtitle">We Rescue Food</h2>
            
            <div class="card">
                <img class="card-img-top" src="./img/Home/Volunteer.avif" alt="Unsplash">
                <div class="card-header">
                    
                </div>
                <div class="card-body">
                    <p class="card-text">Using our web-based app, we engage volunteers to transfer fresh food surpluses from local businesses to social service agencies serving the food insecure.</p>
                    <a href="#" class="card-link">BECOME A FOOD RESCUER</a>
                    
                </div>
            </div>
        </div>
        <div class="col-md-4 d-flex flex-column justify-content-center align-items-center  ">
            <h2 class="card-header-subtitle">We Help The Environment</h2>
            <div class="card">
                <img class="card-img-top" src="./img/Home/Donation.avif" alt="Unsplash">
                <div class="card-header">
                    
                </div>
                <div class="card-body">
                    <p class="card-text">Food waste remains one of the top solutions to global warming. Currently, food waste contributes 8 percent of total global greenhouse gas emissions.</p>
                    <a href="#" class="card-link">BECOME A FOOD DONOR</a>
                    
                </div>
            </div>
        </div>
        <div class="col-md-4 d-flex flex-column justify-content-center align-items-center">
            <h2 class="card-header-subtitle">We create community</h2>
            <div class="card">
                <img class="card-img-top" src="./img/Home/Community.avif" alt="Unsplash">
                <div class="card-header">
                    
                </div>
                <div class="card-body">
                    <p class="card-text">Our model empowers communities to serve themselves with the support of our app. All food donors, rescuers, and agency partners are members of the communities .</p>
                    <a href="#" class="card-link">START A FOOD RESCUE US SITE</a>
                    
                </div>
            </div>
        </div>

    </div>
    </section>

    <section class="surplus-food-records mt-4 d-flex flex-column gap-md-3 gap-1 justify-content-center align-items-center">
         <div class="d-flex flex-column justify-content-center align-items-center">
            <h1 class="section-title text-center py-md-2 py-0 text-white mt-2"> Food Rescue US Lifetime Numbers</h1>
            <div class="home-divider"></div>
          </div>
          <div class="container mt-md-5 mt-1">
            <div class="row">
                <div class="col-md-3 d-flex flex-column p-2 align-items-center justify-content-center gap-2">
                   <h2 class="header-subtitle" style="text-shadow: 0px 0px 5px #000000;">179M</h2>
                   <p class="paragraph-subcard">MEALS PROVIDED TO THOSE IN NEED</p>
                </div>
                <div class="col-md-3 d-flex flex-column p-2 align-items-center justify-content-center gap-2">
                    <h2 class="header-subtitle" style="text-shadow: 0px 0px 5px #000000;">179M</h2>
                    <p class="paragraph-subcard">MEALS PROVIDED TO THOSE IN NEED</p>
                </div>
                <div class="col-md-3 d-flex flex-column p-2 align-items-center justify-content-center gap-2">
                    <h2 class="header-subtitle" style="text-shadow: 0px 0px 5px #000000;">179M</h2>
                    <p class="paragraph-subcard">MEALS PROVIDED TO THOSE IN NEED</p>
                </div>
                <div class="col-md-3 d-flex flex-column p-2 align-items-center justify-content-center gap-2">
                    <h2 class="header-subtitle" style="text-shadow: 0px 0px 5px #000000;">179M</h2>
                    <p class="paragraph-subcard">MEALS PROVIDED TO THOSE IN NEED</p>
                </div>

            </div>
          </div>
    </section>

</main> 

@endsection