@forelse($users as $user)
<tr class="table-contentse">
    <td><strong>{{ $user->id }}</strong></td>
    <td>
        <p>
            @if($user->profile_picture)
                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="User Image" class="img-fluid list-img">
            @else
                <img src="{{ asset('img/avatars/avatar.jpg') }}" alt="Default User" class="img-fluid list-img">
            @endif
            {{ $user->first_name }} {{ $user->last_name }}
        </p>
    </td>
    <td>{{ ucfirst($user->role ?? 'User') }}</td>
    <td>
        {{ $user->created_at ? $user->created_at->format('d/m/y') : '' }}
    </td>
    <td>
        <p class="user-list-active-status">{{ $user->status ?? 'Active' }}</p>
    </td>
    <td>
        <button type="button" class="admin-table-button btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateUserModal{{ $user->id }}">
            Update
        </button>
        <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="admin-table-button btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
        </form>
        <!-- Update Modal -->
        <div class="modal fade" id="updateUserModal{{ $user->id }}" tabindex="-1" aria-labelledby="updateUserModalLabel{{ $user->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateUserModalLabel{{ $user->id }}">Update User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="first_name{{ $user->id }}" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="first_name{{ $user->id }}" name="first_name" value="{{ $user->first_name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="last_name{{ $user->id }}" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="last_name{{ $user->id }}" name="last_name" value="{{ $user->last_name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email{{ $user->id }}" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email{{ $user->id }}" name="email" value="{{ $user->email }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="role{{ $user->id }}" class="form-label">Role</label>
                                <select class="form-control" id="role{{ $user->id }}" name="role" required>
                                    <option value="donor" {{ $user->role == 'donor' ? 'selected' : '' }}>Donor</option>
                                    <option value="receiver" {{ $user->role == 'receiver' ? 'selected' : '' }}>Receiver</option>
                                    <option value="volunteer" {{ $user->role == 'volunteer' ? 'selected' : '' }}>Volunteer</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="profile_picture{{ $user->id }}" class="form-label">Profile Picture</label><br>
                                @if($user->profile_picture)
                                    <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="User Image" style="max-width:100px;" class="mb-2"><br>
                                @endif
                                <input type="file" class="form-control" id="profile_picture{{ $user->id }}" name="profile_picture">
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
    </td>
</tr>
@empty
<tr>
    <td colspan="6" class="text-center">No users found.</td>
</tr>
@endforelse
<div class="pagination-container">
    {{ $users->appends(request()->query())->links() }} 