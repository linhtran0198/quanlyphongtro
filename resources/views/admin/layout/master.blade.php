<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Quản lý phòng trọ</title>
	<base href="{{asset('')}}">
	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="adminassets/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="adminassets/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="adminassets/assets/css/core.css" rel="stylesheet" type="text/css">
	<link href="adminassets/assets/css/components.css" rel="stylesheet" type="text/css">
	<link href="adminassets/assets/css/colors.css" rel="stylesheet" type="text/css">
	<link href="adminassets/assets/css/custom.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="adminassets/assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="adminassets/assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="adminassets/assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="adminassets/assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="adminassets/assets/js/plugins/visualization/d3/d3.min.js"></script>
	<script type="text/javascript" src="adminassets/assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
	<script type="text/javascript" src="adminassets/assets/js/plugins/forms/styling/switchery.min.js"></script>
	
	<script type="text/javascript" src="adminassets/assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
	<script type="text/javascript" src="adminassets/assets/js/plugins/ui/moment/moment.min.js"></script>
	<script type="text/javascript" src="adminassets/assets/js/plugins/pickers/daterangepicker.js"></script>
	<script type="text/javascript" src="adminassets/assets/js/plugins/forms/selects/select2.min.js"></script>
	<script type="text/javascript" src="adminassets/assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script type="text/javascript" src="adminassets/assets/js/core/app.js"></script>
	<script type="text/javascript" src="adminassets/assets/js/pages/dashboard.js"></script>
	<script type="text/javascript" src="adminassets/assets/js/pages/form_layouts.js"></script>
	<!-- /theme JS files -->

</head>

<body>

	<!-- Main navbar -->
	@include('admin.layout.nav')
	<!-- /main navbar -->


	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			@include('admin.layout.menu')

			<!-- Main content -->
			@yield('content2')
			<!-- /Main content -->
		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

</body>
</html>
