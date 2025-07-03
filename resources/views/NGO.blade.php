@extends('layout.app')
@extends('header.main_header')
@section('content')
<div class="container mt-5">
  <h3 class="mb-4">Needy Person Records by NGO's</h3>
  <div class="row">
    <!-- Vertical Tabs -->
    <div class="col-lg-3 col-12 mb-3">
      <div class="nav nav-pills flex-md-column" id="ngo-tabs" role="tablist">
        @foreach($ngosWithPersons as $index => $ngo)
          <button class="nav-link nav-linktab {{ $index === 0 ? 'active' : '' }}" id="ngo{{ $index }}-tab" data-bs-toggle="pill" data-bs-target="#ngo{{ $index }}" type="button" role="tab" aria-controls="ngo{{ $index }}" aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
            {{ $ngo['name'] ?? 'Unknown NGO' }}
          </button>
        @endforeach
      </div>
    </div>
    <!-- Tab Content -->
    <div class="col-lg-9 col-12 mt-md-0 mt-3">
      <div class="tab-content" id="ngo-tabs-content">
        @foreach($ngosWithPersons as $index => $ngo)
          <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}" id="ngo{{ $index }}" role="tabpanel" aria-labelledby="ngo{{ $index }}-tab">
            <h5>{{ $ngo['name'] ?? 'Unknown NGO' }}</h5>
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead class="table-light">
                  <tr>
                    <th>#</th>
                    <th>Full Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($ngo['needyPersons'] as $i => $person)
                    <tr>
                      <td>{{ $i + 1 }}</td>
                      <td>{{ $person->first_name }} {{ $person->last_name }}</td>
                      <td>{{ $person->phone }}</td>
                      <td>{{ $person->address }}</td>
                    </tr>
                  @empty
                    <tr><td colspan="4" class="text-center">No needy persons registered with this NGO yet.</td></tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
@endsection

<style>
    .nav-pills .nav-link {
      margin-bottom: 0.5rem;
      color: rgb(5, 5, 5);
      font-weight: 600;
      font: 1.4rem;
    }
    .nav-pills .nav-linktab.active {
      background: rgb(239, 76, 40) !important;
    }
    .img-thumbnail {
      width: 50px;
      height: 50px;
      object-fit: cover;
    }
  </style>