@extends('layout.app')
@extends('header.main_header')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <h1 class="mb-4 text-center">Register a Needy Person</h1>
            <form method="POST" action="{{ route('needy-person.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">First Name</label>
                        <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" required>
                        @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" required>
                        @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Phone Number</label>
                    <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required>
                    @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="3" required>{{ old('address') }}</textarea>
                    @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Add CNIC front side image</label>
                    <input type="file" name="cnic_front" class="form-control @error('cnic_front') is-invalid @enderror" accept="image/*" required>
                    @error('cnic_front')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Add CNIC back side image</label>
                    <input type="file" name="cnic_back" class="form-control @error('cnic_back') is-invalid @enderror" accept="image/*" required>
                    @error('cnic_back')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Select NGO</label>
                    <select name="ngo" class="form-select @error('ngo') is-invalid @enderror" required>
                        <option value="">Select NGO</option>
                        <option value="Helping Hands Foundation" {{ old('ngo') == 'Helping Hands Foundation' ? 'selected' : '' }}>Helping Hands Foundation</option>
                        <option value="Care for All" {{ old('ngo') == 'Care for All' ? 'selected' : '' }}>Care for All</option>
                        <option value="Hope Society" {{ old('ngo') == 'Hope Society' ? 'selected' : '' }}>Hope Society</option>
                    </select>
                    @error('ngo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <button type="submit" class="btn btn-primary w-100">Register Person</button>
            </form>
        </div>
    </div>
</div>
@endsection 