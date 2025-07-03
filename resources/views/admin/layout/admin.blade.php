<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Modern, flexible and responsive Bootstrap 5 admin &amp; dashboard template">
	<meta name="author" content="Bootlab">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>FoodTech-User Dashboard</title>

	<!-- PICK ONE OF THE STYLES BELOW -->
	<link href="../admin/css/modern.css" rel="stylesheet">
	 
    <link rel="stylesheet" href="../admin/css/custom.css">
    <link rel="stylesheet" href="../admin/css/custom.css">
    <!-- END SETTINGS -->
  
    <link rel="stylesheet" href="../admin/css/contactUs.css">
  
    <link rel="stylesheet" href="../admin/css/card.css">
    <link rel="stylesheet" href="../admin/css/FSSAILicense.css">
 
    <link rel="stylesheet" href="../admin/css/dashboard.css">
 
	<link rel="stylesheet" href="../admin/css/admin.css">
	<link rel="stylesheet" href="../admin/css/Reports.css">
  <link rel="stylesheet" href="../admin/css/setting.css">
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css" rel="stylesheet" />
	<script src="../js/app.js"></script>

</head>

<body>
		<div class="wrapper">

	@yield('header')
     @yield('content')

		</div>
	

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@include('sweetalert::alert')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')

</body>

</html>