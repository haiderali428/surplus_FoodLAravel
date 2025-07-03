@foreach($approvedPersons as $needyPerson)
<tr class="table-contentse">
    <td><strong>{{ $needyPerson->id }}</strong></td>
    <td>{{ $needyPerson->first_name }} {{ $needyPerson->last_name }}</td>
    <td>{{ $needyPerson->phone }}</td>
    <td>{{ $needyPerson->address }}</td>
    <td>
        {{ $needyPerson->created_at ? $needyPerson->created_at->format('d/m/y') : '' }}
    </td>
    <td>
        <p class="user-list-active-status">Active</p>
    </td>
    <td>
        <button type="button" class="admin-table-button btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateNeedyPersonModal{{ $needyPerson->id }}">
            Update
        </button>
        <form action="{{ route('admin.needypersons.delete', $needyPerson->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="admin-table-button btn btn-danger" onclick="return confirm('Are you sure you want to delete this needy person?')">Delete</button>
        </form>
    </td>
</tr>
<!-- Update Modal -->
<div class="modal fade" id="updateNeedyPersonModal{{ $needyPerson->id }}" tabindex="-1" aria-labelledby="updateNeedyPersonModalLabel{{ $needyPerson->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateNeedyPersonModalLabel{{ $needyPerson->id }}">Update Needy Person</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.needypersons.update', $needyPerson->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="first_name{{ $needyPerson->id }}" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="first_name{{ $needyPerson->id }}" name="first_name" value="{{ $needyPerson->first_name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="last_name{{ $needyPerson->id }}" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="last_name{{ $needyPerson->id }}" name="last_name" value="{{ $needyPerson->last_name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone{{ $needyPerson->id }}" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone{{ $needyPerson->id }}" name="phone" value="{{ $needyPerson->phone }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="address{{ $needyPerson->id }}" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address{{ $needyPerson->id }}" name="address" value="{{ $needyPerson->address }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="cnic_front{{ $needyPerson->id }}" class="form-label">Front Side Image</label><br>
                        @if($needyPerson->cnic_front)
                            <img src="{{ asset('storage/' . $needyPerson->cnic_front) }}" alt="Front" style="max-width:100px;" class="mb-2"><br>
                        @endif
                        <input type="file" class="form-control" id="cnic_front{{ $needyPerson->id }}" name="cnic_front">
                    </div>
                    <div class="mb-3">
                        <label for="cnic_back{{ $needyPerson->id }}" class="form-label">Back Side Image</label><br>
                        @if($needyPerson->cnic_back)
                            <img src="{{ asset('storage/' . $needyPerson->cnic_back) }}" alt="Back" style="max-width:100px;" class="mb-2"><br>
                        @endif
                        <input type="file" class="form-control" id="cnic_back{{ $needyPerson->id }}" name="cnic_back">
                    </div>
                    <div class="mb-3">
                        <label for="ngo{{ $needyPerson->id }}" class="form-label">NGO</label>
                        <input type="text" class="form-control" id="ngo{{ $needyPerson->id }}" name="ngo" value="{{ $needyPerson->ngo }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="status{{ $needyPerson->id }}" class="form-label">Status</label>
                        <select class="form-control" id="status{{ $needyPerson->id }}" name="status">
                            <option value="pending" {{ $needyPerson->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ $needyPerson->status == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ $needyPerson->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
<div class="pagination-container">
    {{ $approvedPersons->appends(request()->except('approved_page'))->links() }} 