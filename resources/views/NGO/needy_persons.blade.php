@extends('layout.app')

@section('content')
<div class="container mt-4">
    <h2>Needy Persons Registered with {{ $ngoName }}</h2>
    <hr>
    @if($needyPersons->isEmpty())
        <div class="alert alert-info">No needy persons registered with this NGO yet.</div>
    @else
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                </tr>
                
            </thead>
            <tbody>
                @foreach($needyPersons as $index => $person)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $person->first_name }} {{ $person->last_name }}</td>
                        <td>{{ $person->user->email ?? 'N/A' }}</td>
                        <td>{{ $person->phone }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection
