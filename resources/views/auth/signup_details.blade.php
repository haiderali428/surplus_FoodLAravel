@extends('layout.app')

@section('content')

<main>
    <section id="staged-form">
        <ul id="stage-progress">
            <li class="{{ ($step ?? session('step', 1)) == 1 ? 'active-stage' : '' }}">Specify your location</li>
            <li class="{{ ($step ?? session('step', 1)) == 2 ? 'active-stage' : '' }}">Verify your phone number</li>
            <li class="{{ ($step ?? session('step', 1)) == 3 ? 'active-stage' : '' }}">Complete Registration</li>
        </ul>

        <main>
            <div id="form-section">
                {{-- STEP 1 --}}
                <form method="POST" action="{{ route('user_details.step1') }}" enctype="multipart/form-data" style="{{ ($step ?? session('step', 1)) == 1 ? '' : 'display:none;' }}">
                    @csrf
                    <div class="input-group d-flex flex-column">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control surplus-login-input w-100 mb-3 p-2"
                            style="border-radius: 10px;" placeholder="Email"
                            value="{{ old('email', session('email')) }}" required>
                        @error('email') <div class="alert alert-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="input-group d-flex flex-column">
                        <label>First Name</label>
                        <input type="text" name="fname" class="form-control surplus-login-input w-100 mb-3 p-2"
                            style="border-radius: 10px;" placeholder="First Name"
                            value="{{ old('fname', session('fname')) }}" required>
                        @error('fname') <div class="alert alert-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="input-group d-flex flex-column">
                        <label>Last Name</label>
                        <input type="text" name="lname" class="form-control surplus-login-input w-100 mb-3 p-2"
                            style="border-radius: 10px;" placeholder="Last Name"
                            value="{{ old('lname', session('lname')) }}" required>
                        @error('lname') <div class="alert alert-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="input-group d-flex flex-column">
                        <label>Address</label>
                        <textarea name="address" class="form-control surplus-login-input w-100 mb-3 p-2"
                            style="border-radius: 10px;" placeholder="Address" required>{{ old('address', session('address')) }}</textarea>
                        @error('address') <div class="alert alert-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="input-group d-flex flex-column">
                        <label>City</label>
                        <input type="text" name="city" class="form-control surplus-login-input w-100 mb-3 p-2"
                            style="border-radius: 10px;" placeholder="City"
                            value="{{ old('city', session('city')) }}" required>
                        @error('city') <div class="alert alert-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="input-group d-flex flex-column">
                        <label>Profile Picture (optional)</label>
                        <input type="file" name="profile_picture" class="form-control surplus-login-input w-100 mb-3 p-2" accept="image/*">
                        @error('profile_picture') <div class="alert alert-danger">{{ $message }}</div> @enderror
                    </div>

                    <button type="submit" class="primary-btn">Next Step ➟</button>
                </form>

                {{-- STEP 2 --}}
                <form method="POST" action="{{ route('user_details.step2') }}" style="{{ ($step ?? session('step')) == 2 ? '' : 'display:none;' }}">
                    @csrf
                    <div class="input-group d-flex flex-column">
                        <label>Number</label>
                        <input type="number" name="number" class="form-control surplus-login-input w-100 mb-3 p-2"
                            style="border-radius: 10px;" placeholder="Enter Number" value="{{ old('number', session('number')) }}" required>
                        @error('number') <div class="alert alert-danger">{{ $message }}</div> @enderror
                    </div>

                    <button type="submit" class="primary-btn">Next Step ➟</button>
                </form>

                {{-- STEP 3 --}}
                <form method="POST" action="{{ route('user_details.step3') }}" style="{{ ($step ?? session('step')) == 3 ? '' : 'display:none;' }}">
                    @csrf
                    <div class="input-group d-flex flex-column">
                        <label>Enter OTP</label>
                        <div class="row">
                            @for ($i = 0; $i < 4; $i++)
                                <div class="col-3">
                                    <input name="otp[]" type="number"
                                        class="form-control surplus-login-input w-100 mb-3 p-2"
                                        style="border-radius: 10px;" placeholder="0" required>
                                </div>
                            @endfor
                        </div>
                        @error('otp') <div class="alert alert-danger">{{ $message }}</div> @enderror
                    </div>

                    <button type="submit" class="primary-btn">Complete Registration</button>
                </form>
            </div>
        </main>
    </section>
</main>

@endsection