@extends('admin.layout.admin')
@extends('admin.header.admin_header')

@section('content')

    
		<div class="main">
			<nav class="navbar navbar-expand navbar-theme  py-3" style="background-color: rgba(245, 245, 245, 1) !important;">
				<a class="sidebar-toggle d-flex d-md-none me-2">
					<i class="hamburger align-self-center"></i>
				</a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav ms-auto">
						@include('admin.partials.admin_profile_dropdown')
					</ul>
				</div>
			</nav>
			<main class="content quicksand-font">
				<div class="container-fluid p-sm-2">
					
 
					<div class="d-sm-flex justify-content-between align-items-center mb-3">
						<h2 class="m-0 mb-3 mb-sm-0 fw-bolder ">User List</h2>
                        <div class="position-relative select-input">
                            <input type="search" name="search" value="{{ request('search') }}" placeholder="Search here" class="py-1 px-3 search-user-list rounded-3 select-input">
                            <div class="position-absolute search-icon-position">
                                <img src="../img/avatars/search-icon.svg" alt="">
                            </div>
                        </div>
					</div>

					<div class="table-responsive tablereports" id="users-table-container">
						<table class="table mb-0">
							<thead>
								<tr class="tablaeheading">
									<th scope="col">ID</th>
									<th scope="col">Name</th>
									<th scope="col">Role</th>
									<th scope="col">Registration Date</th>
									<th scope="col">Status</th>
									<th scope="col">Action</th>
								</tr>
							</thead>
							<tbody>
								@include('admin.partials.users_table')
							</tbody>
						</table>
					</div>
		</div>
	
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // CSRF token for AJAX
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    const userSearch = document.querySelector('input[name="search"]');
    if (userSearch) {
        userSearch.addEventListener('input', function() {
            fetchUsersTable(this.value);
        });
    }
    function fetchUsersTable(value) {
        fetch("{{ route('admin.users.ajax') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ search: value })
        })
        .then(response => response.text())
        .then(html => {
            // Only replace the tbody content, not the entire table
            const table = document.getElementById('users-table-container').querySelector('table');
            const tbody = table.querySelector('tbody');
            if (tbody) {
                tbody.innerHTML = html;
            }
        });
    }
});
</script>
@endpush