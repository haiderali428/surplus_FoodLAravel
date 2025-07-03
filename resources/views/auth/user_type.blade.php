@extends('layout.app')
@section('content')

<main>
    <section class="surplus-login-sect py-5">
        <div class="container surpluslogin-page">
            <div class="row py-5 mt-4 px-4">
                <div class="col-md-12 surpluslogin-left d-flex flex-column justify-content-center align-items-center">
                    <h2 class="text-center">Surplus Food Redistribution Platform</h2>
                </div>

                <div class="container px-sm-5 px-2">
                    <div class="chose-an-account row px-sm-5 px-2 py-3">
                        <div class="col-md-12 chose-an-account2 d-flex flex-column justify-content-center align-items-center">
                            <h2 class="text-center">Choose An Account Type</h2>
                        </div>

                        {{-- FORM for submitting selected role --}}
                        <form method="POST" action="{{ route('user.selectRole') }}" id="roleForm">
                            @csrf
                            <input type="hidden" name="role" id="selectedRole">

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="acount-card d-flex flex-column px-sm-3 px-2 py-3 mb-3 rounded-4 justify-content-center bg-white align-items-center">
                                        <img src="../img/Home/volunteer-logo.webp" style="width: 160px; height: 160px; border-radius: 10px;" alt="">
                                        <h3 class="text-center mt-2">Volunteer</h3>
                                        <p class="text-center mb-2">Be that key volunteer who rescues and delivers the donated food</p>
                                        <button type="button" class="btn surplus-chose-btn2 w-100 p-2"
                                            onclick="submitRole('volunteer')">BECOME A VOLUNTEER</button>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <div class="acount-card d-flex flex-column px-sm-3 px-2 py-3 rounded-4 justify-content-center bg-white align-items-center">
                                        <img src="../img/Home/donation-logo.jpg" style="width: 160px; height: 160px; border-radius: 10px;" alt="">
                                        <h3 class="text-center mt-2">Food Donor</h3>
                                        <p class="text-center mb-2">Donate excess food from your business to those in need.</p>
                                        <button type="button" class="btn surplus-chose-btn2 w-100 p-2"
                                            onclick="submitRole('donor')">BECOME A FOOD DONOR</button>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <div class="acount-card d-flex flex-column px-sm-3 px-2 py-3 rounded-4 justify-content-center bg-white align-items-center">
                                        <img src="../img/Home/reciever-logo.avif" style="width: 160px; height: 160px; border-radius: 10px;" alt="">
                                        <h3 class="text-center mt-2">Receiver</h3>
                                        <p class="text-center mb-2">Receive donated food to serve hungry people in your community</p>
                                        <button type="button" class="btn surplus-chose-btn2 w-100 p-2"
                                            onclick="submitRole('receiver')">BECOME A RECEIVER</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
</main>

{{-- JS for role selection --}}
<script>
    function submitRole(role) {
        document.getElementById('selectedRole').value = role;
        document.getElementById('roleForm').submit();
    }
</script>

@endsection