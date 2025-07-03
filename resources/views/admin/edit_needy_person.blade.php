@extends('admin.layout.admin')
@extends('admin.header.admin_header')

@section('content')
<div class="container mt-5">
    <h2>Edit Needy Person</h2>
    <form action="{{ route('admin.needypersons.update', $needyPerson->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $needyPerson->first_name }}" required>
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $needyPerson->last_name }}" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ $needyPerson->phone }}" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ $needyPerson->address }}" required>
        </div>
        <div class="mb-3">
            <label for="cnic_front" class="form-label">Front Side Image</label><br>
            @if($needyPerson->cnic_front)
                <img src="{{ asset('storage/' . $needyPerson->cnic_front) }}" alt="Front" style="max-width:100px;" class="mb-2"><br>
            @endif
            <input type="file" class="form-control" id="cnic_front" name="cnic_front">
        </div>
        <div class="mb-3">
            <label for="cnic_back" class="form-label">Back Side Image</label><br>
            @if($needyPerson->cnic_back)
                <img src="{{ asset('storage/' . $needyPerson->cnic_back) }}" alt="Back" style="max-width:100px;" class="mb-2"><br>
            @endif
            <input type="file" class="form-control" id="cnic_back" name="cnic_back">
        </div>
        <div class="mb-3">
            <label for="ngo" class="form-label">NGO</label>
            <input type="text" class="form-control" id="ngo" name="ngo" value="{{ $needyPerson->ngo }}" required>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control" id="status" name="status">
                <option value="pending" {{ $needyPerson->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ $needyPerson->status == 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="rejected" {{ $needyPerson->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection 