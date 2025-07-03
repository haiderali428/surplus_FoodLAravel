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
					<h1 class="dashboard-heading fw-bolder">Dashboard</h1>
					<p class="fw-bolder mb-3 dashboard-para">Hi, {{ isset($admin) && $admin->name ? $admin->name : 'Admin' }}. Welcome back to Surplus Food  Admin Panel!</p>
					 
					<div class="row main-card-content">






						<div class="col-12 col-sm-6 col-md-3 mb-3 mb-md-0 ">

							<a href="./manage-user.html" class="text-decoration-none">
								<div class="dashboard-card">
									<div class="card-body px-3 py-2">
										<div class="d-flex  justify-content-between mb-3">
											<div class="col mt-0">
												<h5 class="card-title">Total Users</h5>
											</div>
	
											<div>
	
												<img src="../img/avatars/plan-icon.svg" alt="">
	
											</div>
										</div>
										<div class="d-flex  justify-content-between">
											<h1 class="m-0 ">{{$totalUsers}}</h1>
											<button class="btn adminbtn  px-3  py-0">
												+2,5%
											</button>
										</div>
	
									</div>
								</div>
							</a>
						</div>
						<div class="col-12 col-sm-6 col-md-3 mb-3 mb-md-0 ">

							<a href="./repots.html" class="text-decoration-none">
								<div class="dashboard-card">
									<div class="card-body px-3 py-2">
										<div class="d-flex  justify-content-between mb-3">
											<div class="col mt-0">
												<h5 class="card-title">Doners </h5>
											</div>
	
											<div>
	
												<img src="../img/avatars/plan-icon.svg" alt="">
	
											</div>
										</div>
										<div class="d-flex  justify-content-between">
											<h1 class="m-0 ">{{$totalDonors}}</h1>
											<!-- <button class="btn adminbtn  px-3  py-0">
												View
											</button> -->
										</div>
	
									</div>
								</div>
							</a>
						</div>
						<div class="col-12 col-sm-6 col-md-3 mb-3 mb-md-0 ">

							<div class="dashboard-card">
								<div class="card-body px-3 py-2">
									<div class="d-flex  justify-content-between mb-3">
										<div class="col mt-0">
											<h5 class="card-title">Recievers </h5>
										</div>

										<div>

											<img src="../img/avatars/plan-icon.svg" alt="">

										</div>
									</div>
									<div class="d-flex  justify-content-between">
										<h1 class="m-0 ">{{$totalReceivers}}</h1>
										<!-- <button class="btn adminbtn  px-3  py-0">
											View
										</button> -->
									</div>

								</div>
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-3 mb-3 mb-md-0 ">

							<a href="./pending-task.html" class="text-decoration-none">
								<div class="dashboard-card">
									<div class="card-body px-3 py-2">
										<div class="d-flex  justify-content-between mb-3">
											<div class="col mt-0">
												<h5 class="card-title">Volunteers</h5>
											</div>
	
											<div>
	
												<img src="../img/avatars/plan-icon.svg" alt="">
	
											</div>
										</div>
										<div class="d-flex  justify-content-between">
											<h1 class="m-0 ">{{$totalVolunteers}}</h1>
											<!-- <button class="btn adminbtn  px-3  py-0">
												View
											</button> -->
										</div>
	
									</div>
								</div>
							</a>
						</div>
					 
					</div>

 
					<div class="row my-3">
						<div class="col-12 ">
							<div class="card  linchartgrapgh w-100">
								<div class="card-header pb-0">
									<div class="row px-3">
										<div class="col-md-9">
											<p class="fw-bolder mb-0 dashboard-para">Reports Progress</p>

									
										</div>

										<div class="col-md-3 ">
											<div class="input-group askjsdsaj">
										 
												<select class="form-select" id="chartFilter">
													<option value="all">All Metrics</option>
													<option value="donations">Donations</option>
													<option value="simple_posts">Simple Posts</option>
													<option value="requests">Requests</option>
													<option value="donors">Donors</option>
													<option value="volunteers">Volunteers</option>
													<option value="receivers">Receivers</option>
												</select>
											</div>
										</div>
									</div>
									 
								</div>
								<div class="card-body py-0">
									<div class="chart">
										<canvas id="chartjs-line1"></canvas>
									</div>
								</div>
							</div>
						</div>
					</div>
 
					<div>
						<h2 class="m-0 fw-bolder my-3">User List</h2>
					</div>

					<div class="table-responsive tablereports">
						<table class="table mb-0">
						  <thead>
							<tr class="tablaeheading">
							  <th scope="col">ID</th>
							  <th scope="col">Name</th>
							  <th scope="col">Email</th>
							  <th scope="col">Number</th>
							  <th scope="col">Role</th>
							  <th scope="col">Registration Date</th>
							  {{-- <th scope="col">Status</th> --}}
							  {{-- <th scope="col">Action</th> --}}
			  
							</tr>
						  </thead>
						  <tbody>
							@php
							$id = ($query->currentPage() - 1) * $query->perPage();
						@endphp
						
						@foreach ($query as $user)
							<tr class="table-contentse">
								<td><strong>{{ ++$id }}</strong></td>
								<td >
									<p>
										@if($user->profile_picture)
											<img src="{{ asset('storage/' . $user->profile_picture) }}" alt="User Profile" class="img-fluid list-img" style="border-radius: 50%; object-fit: cover;">
										@else
											<img src="{{ asset('img/avatars/avatar.jpg') }}" alt="Default User" class="img-fluid list-img" style="border-radius: 50%; object-fit: cover;">
										@endif
										{{ $user->first_name }} {{ $user->last_name }}
									</p>
								</td>
								<td>{{$user->email}}</td>
								<td>{{$user->phone_number}}</td>
			
								<td>{{$user->role}}</td>
								<td>{{ $user->created_at->format('F j, Y') }}</td>
							  </tr>
							@endforeach
			
							 
							  
							 
							
							
			  
						  </tbody>
						</table>
			  
						<div class="pagination-container">
							<nav>
								{{ $query->links('pagination::bootstrap-4') }}
							</nav>
						</div>
						
					  </div>
				
					

					


				</div>
		</div>
	

		

	</div>
	</main>
	<!-- <footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-8 text-start">
							<ul class="list-inline">
								<li class="list-inline-item">
									<a class="text-muted" href="#">Support</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#">Privacy</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#">Terms of Service</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#">Contact</a>
								</li>
							</ul>
						</div>
						<div class="col-4 text-end">
							<p class="mb-0">
								&copy; 2023 - <a href="dashboard-default.html" class="text-muted">Spark</a>
							</p>
						</div>
					</div>
				</div>
			</footer> -->
	</div>
	</div>

	<svg width="0" height="0" style="position:absolute">
		<defs>
			<symbol viewBox="0 0 512 512" id="ion-ios-pulse-strong">
				<path
					d="M448 273.001c-21.27 0-39.296 13.999-45.596 32.999h-38.857l-28.361-85.417a15.999 15.999 0 0 0-15.183-10.956c-.112 0-.224 0-.335.004a15.997 15.997 0 0 0-15.049 11.588l-44.484 155.262-52.353-314.108C206.535 54.893 200.333 48 192 48s-13.693 5.776-15.525 13.135L115.496 306H16v31.999h112c7.348 0 13.75-5.003 15.525-12.134l45.368-182.177 51.324 307.94c1.229 7.377 7.397 11.92 14.864 12.344.308.018.614.028.919.028 7.097 0 13.406-3.701 15.381-10.594l49.744-173.617 15.689 47.252A16.001 16.001 0 0 0 352 337.999h51.108C409.973 355.999 427.477 369 448 369c26.511 0 48-22.492 48-49 0-26.509-21.489-46.999-48-46.999z">
				</path>
			</symbol>
		</defs>
	</svg>
	<script src="../js/app.js"></script>


	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

	<script>

        const prevBtn = document.getElementById('prev-btn');
        const nextBtn = document.getElementById('next-btn');
        const pageItems = document.querySelectorAll('.page-item[data-page]');
      
        let currentPage = 1;
      
        function updatePagination() {
          pageItems.forEach(item => {
            item.classList.remove('active');
            if (parseInt(item.getAttribute('data-page')) === currentPage) {
              item.classList.add('active');
            }
          });
      
          prevBtn.classList.toggle('disabled', currentPage === 1);
          nextBtn.classList.toggle('disabled', currentPage === pageItems.length);
        }
      
        pageItems.forEach(item => {
          item.addEventListener('click', () => {
            currentPage = parseInt(item.getAttribute('data-page'));
            updatePagination();
          });
        });
      
        prevBtn.addEventListener('click', () => {
          if (currentPage > 1) {
            currentPage--;
            updatePagination();
          }
        });
      
        nextBtn.addEventListener('click', () => {
          if (currentPage < pageItems.length) {
            currentPage++;
            updatePagination();
          }
        });
      
        updatePagination();
      </script>

	<script>
		document.addEventListener("DOMContentLoaded", function () {
			// Line chart
			new Chart(document.getElementById("chartjs-line"), {
				type: "line",
				data: {
					labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
					datasets: [
						{
							label: "Current Year",
							data: [100, 200, 200, 450, 500, 550, 650, 700, 650, 750, 850, 900, 950],
							fill: false,
							borderColor: "#FFC107", // Yellow line color
							borderWidth: 2,
							pointBackgroundColor: "#FFC107",
							pointBorderColor: "#FFC107",
							pointRadius: 2
						},
						{
							label: "Past Year",
							data: [200, 300, 350, 600, 450, 500, 600, 550, 650, 750, 800, 850],
							fill: false,
							borderColor: "#FFD54F", // Light yellow line color
							borderWidth: 2,
							pointBackgroundColor: "#FFD54F",
							pointBorderColor: "#FFD54F",
							pointRadius: 2
						}
					]
				},
				options: {
					maintainAspectRatio: false,
					responsive: true,
					plugins: {
						legend: {
							display: true,
							labels: {
								usePointStyle: true, // Use dataset point style for circles
								color: "#000", // Legend text color
								boxWidth: 4, // Smaller circle size
								boxHeight: 4, // Matches height with width
								padding: 10, // Space between legend items
								textAlign: "left" // Ensures left alignment
							}
						}
					},
					scales: {
						x: {
							grid: {
								display: false, // Removes vertical grid lines
							},
							ticks: {
								color: "#000", // X-axis label color
							}
						},
						y: {
							grid: {
								color: "rgba(0, 0, 0, 0.1)", // Subtle grid lines for Y-axis
								drawBorder: false, // Hides Y-axis border
							},
							ticks: {
								stepSize: 100,
								color: "#000" // Y-axis label color
							}
						}
					},
					layout: {
						padding: {
							top: 10, // Adds padding to prevent content overlap
							left: 10,
							right: 10,
							bottom: 10
						}
					},
					backgroundColor: "#f9f9f9" // Chart background color
				}
			});
		});
	</script>
	
	<script>
		document.addEventListener("DOMContentLoaded", function () {
			// Store chart instance globally
			let chartInstance;
			
			// Line chart
			chartInstance = new Chart(document.getElementById("chartjs-line1"), {
				type: "line",
				data: {
					labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
					datasets: [
						{
							label: "Donations",
							data: @json($donationsData),
							fill: false,
							borderColor: "#FFC107",
							borderWidth: 2,
							pointBackgroundColor: "#FFC107",
							pointBorderColor: "#FFC107",
							pointRadius: 2
						},
						{
							label: "Simple Posts",
							data: @json($simplePostsData),
							fill: false,
							borderColor: "#2196F3",
							borderWidth: 2,
							pointBackgroundColor: "#2196F3",
							pointBorderColor: "#2196F3",
							pointRadius: 2
						},
						{
							label: "Requests",
							data: @json($requestsData),
							fill: false,
							borderColor: "#4CAF50",
							borderWidth: 2,
							pointBackgroundColor: "#4CAF50",
							pointBorderColor: "#4CAF50",
							pointRadius: 2
						},
						{
							label: "Donors",
							data: @json($donorsData),
							fill: false,
							borderColor: "#FF5722",
							borderWidth: 2,
							pointBackgroundColor: "#FF5722",
							pointBorderColor: "#FF5722",
							pointRadius: 2
						},
						{
							label: "Volunteers",
							data: @json($volunteersData),
							fill: false,
							borderColor: "#9C27B0",
							borderWidth: 2,
							pointBackgroundColor: "#9C27B0",
							pointBorderColor: "#9C27B0",
							pointRadius: 2
						},
						{
							label: "Receivers",
							data: @json($receiversData),
							fill: false,
							borderColor: "#00BCD4",
							borderWidth: 2,
							pointBackgroundColor: "#00BCD4",
							pointBorderColor: "#00BCD4",
							pointRadius: 2
						}
					]
				},
				options: {
					maintainAspectRatio: false,
					responsive: true,
					plugins: {
						legend: {
							display: true,
							labels: {
								usePointStyle: true, // Use dataset point style for circles
								color: "#000", // Legend text color
								boxWidth: 4, // Smaller circle size
								boxHeight: 4, // Matches height with width
								padding: 10, // Space between legend items
								textAlign: "left" // Ensures left alignment
							}
						}
					},
					scales: {
						x: {
							grid: {
								display: false, // Removes vertical grid lines
							},
							ticks: {
								color: "#000", // X-axis label color
							}
						},
						y: {
							grid: {
								color: "rgba(0, 0, 0, 0.1)", // Subtle grid lines for Y-axis
								drawBorder: false, // Hides Y-axis border
							},
							ticks: {
								stepSize: 1,
								color: "#000" // Y-axis label color
							}
						}
					},
					layout: {
						padding: {
							top: 10, // Adds padding to prevent content overlap
							left: 10,
							right: 10,
							bottom: 10
						}
					},
					backgroundColor: "#f9f9f9" // Chart background color
				}
			});

			// Add dropdown filter functionality
			document.getElementById('chartFilter').addEventListener('change', function() {
				const selectedValue = this.value;
				const datasets = chartInstance.data.datasets;
				
				// Show/hide datasets based on selection
				datasets.forEach((dataset, index) => {
					let shouldShow = false;
					
					switch(selectedValue) {
						case 'all':
							shouldShow = true;
							break;
						case 'donations':
							shouldShow = (dataset.label === 'Donations');
							break;
						case 'simple_posts':
							shouldShow = (dataset.label === 'Simple Posts');
							break;
						case 'requests':
							shouldShow = (dataset.label === 'Requests');
							break;
						case 'donors':
							shouldShow = (dataset.label === 'Donors');
							break;
						case 'volunteers':
							shouldShow = (dataset.label === 'Volunteers');
							break;
						case 'receivers':
							shouldShow = (dataset.label === 'Receivers');
							break;
					}
					
					dataset.hidden = !shouldShow;
				});
				
				// Update the chart
				chartInstance.update();
			});
		});
	</script>
	
	
	
	<script>
		$(function () {
			$('#datatables-dashboard-projects').DataTable({
				pageLength: 6,
				lengthChange: false,
				bFilter: false,
				autoWidth: false
			});
		});
	</script>
	<script>
		$(function () {
			$('#datetimepicker-dashboard').datetimepicker({
				inline: true,
				sideBySide: false,
				format: 'L'
			});
		});
	</script>

@endsection