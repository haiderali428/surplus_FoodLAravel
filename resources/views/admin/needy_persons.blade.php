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
						<h2 class="m-0 mb-3 mb-sm-0 fw-bolder ">Registration Request</h2>
                        <div class="position-relative select-input">
                            <form method="GET" action="{{ route('admin.needypersons') }}">
                                <input type="search" name="pending_search" value="{{ request('pending_search') }}" placeholder="Search here" class="py-1 px-3 search-user-list rounded-3 select-input">
                                <div class="position-absolute  search-icon-position">
                                  <img src="../img/avatars/search-icon.svg" alt="">
                                </div>
                              </form>
                          </div>
					</div>

					<div class="table-responsive tablereports" id="pending-table-container">
						<table class="table mb-0">
							<thead>
								<tr class="tablaeheading">
									<th scope="col">ID</th>
									<th scope="col">Name</th>
									<th scope="col">Phone</th>
									<th scope="col">Address</th>
									<th scope="col">Front side Image</th>
									<th scope="col">Back side Image</th>
									<th scope="col">Action</th>
								</tr>
							</thead>
							<tbody>
								@include('admin.partials.pending_persons_table')
							</tbody>
						</table>
					</div>
				
					</div>
                	<div class="container-fluid p-sm-2">
					
 
                        <div class="d-sm-flex justify-content-between align-items-center mb-3">
                            <h2 class="m-0 mb-3 mb-sm-0 fw-bolder ">Registered Persons</h2>
                            <div class="position-relative select-input">
                                <form method="GET" action="{{ route('admin.needypersons') }}">
                                    <input type="search" name="approved_search" value="{{ request('approved_search') }}" placeholder="Search here" class="py-1 px-3 search-user-list rounded-3 select-input">
                                    <div class="position-absolute  search-icon-position">
                                      <img src="../img/avatars/search-icon.svg" alt="">
                                    </div>
                                  </form>
                            </div>
                        </div>
    
                        <div class="table-responsive tablereports" id="approved-table-container">
                            <table class="table mb-0">
                              <thead>
                                <tr class="tablaeheading">
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Address</th>
                                <th scope="col">Registration Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                  
                                </tr>
                              </thead>
                              <tbody>
                                @include('admin.partials.approved_persons_table')
                              </tbody>
                            </table>
                  
                            <div class="pagination-container">
                                {{ $approvedPersons->appends(request()->except('approved_page'))->links() }}
                            </div>
    
                          </div>
                    
                        </div>
		</div>
	
	
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // CSRF token for AJAX
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    // Pending search
    const pendingSearch = document.querySelector('input[name="pending_search"]');
    if (pendingSearch) {
        pendingSearch.addEventListener('input', function() {
            fetchTable('pending', this.value);
        });
    }
    // Approved search
    const approvedSearch = document.querySelector('input[name="approved_search"]');
    if (approvedSearch) {
        approvedSearch.addEventListener('input', function() {
            fetchTable('approved', this.value);
        });
    }

    function fetchTable(type, value) {
        let url = '';
        let data = {};
        let containerId = '';
        if (type === 'pending') {
            url = "{{ route('admin.needypersons.ajaxPending') }}";
            data = { pending_search: value };
            containerId = 'pending-table-container';
        } else {
            url = "{{ route('admin.needypersons.ajaxApproved') }}";
            data = { approved_search: value };
            containerId = 'approved-table-container';
        }
        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify(data)
        })
        .then(response => response.text())
        .then(html => {
            // Only replace the tbody content, not the entire table
            const table = document.getElementById(containerId).querySelector('table');
            const tbody = table.querySelector('tbody');
            if (tbody) {
                tbody.innerHTML = html;
            }
        });
    }
});
</script>
@endpush