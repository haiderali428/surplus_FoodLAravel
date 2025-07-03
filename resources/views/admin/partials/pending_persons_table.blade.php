@foreach($pendingPersons as $needyPerson)
<tr class="table-contentse">
    <td>{{ $needyPerson->id }}</td>
    <td>{{ $needyPerson->first_name }} {{ $needyPerson->last_name }}</td>
    <td>{{ $needyPerson->phone }}</td>
    <td>{{ $needyPerson->address }}</td>
    <td>
        <a href="{{ asset('storage/' . $needyPerson->cnic_front) }}" download="front_image_{{ $needyPerson->id }}.jpeg">
            <img src="{{ asset('storage/' . $needyPerson->cnic_front) }}" alt="Front" class="img-thumbnail" style="max-width:50px;">
        </a>
    </td>
    <td>
        <a href="{{ asset('storage/' . $needyPerson->cnic_back) }}" download="back_image_{{ $needyPerson->id }}.jpeg">
            <img src="{{ asset('storage/' . $needyPerson->cnic_back) }}" alt="Back" class="img-thumbnail" style="max-width:50px;">
        </a>
    </td>
    <td>
        <form action="{{ route('admin.needypersons.approve', $needyPerson->id) }}" method="POST" style="display:inline-block;">
            @csrf
            <button type="submit" class="btn btn-success btn-sm">Approve</button>
        </form>
        <form action="{{ route('admin.needypersons.reject', $needyPerson->id) }}" method="POST" style="display:inline-block;">
            @csrf
            <button type="submit" class="btn btn-danger btn-sm">Reject</button>
        </form>
    </td>
</tr>
@endforeach
<div class="pagination-container">
    {{ $pendingPersons->appends(request()->except('pending_page'))->links() }} 