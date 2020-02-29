<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Login</title>
	<base href="{{asset('')}}">
	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="adminassets/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="adminassets/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="adminassets/assets/css/core.css" rel="stylesheet" type="text/css">
	<link href="adminassets/assets/css/components.css" rel="stylesheet" type="text/css">
	<link href="adminassets/assets/css/colors.css" rel="stylesheet" type="text/css">
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
	<script type="text/javascript" src="adminassets/assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script type="text/javascript" src="adminassets/assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
	<script type="text/javascript" src="adminassets/assets/js/plugins/ui/moment/moment.min.js"></script>
	<script type="text/javascript" src="adminassets/assets/js/plugins/pickers/daterangepicker.js"></script>

	<script type="text/javascript" src="adminassets/assets/js/core/app.js"></script>
	<script type="text/javascript" src="adminassets/assets/js/pages/login.js"></script>
	<!-- /theme JS files -->

</head>

<body class="login-container bg-slate-800">

	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Content area -->
				<div class="content">
					<!-- Advanced login -->

					<form action="{{ route('admin.login') }}" method="POST">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="panel panel-body login-form">
							<div class="text-center">
								<div class="icon-object border-warning-400 text-warning-400"><i class="icon-people"></i></div>
								<h5 class="content-group-lg">Please Login to Admin Panel</h5>
							</div>
							@if ($errors->any())
							    <div class="alert alert-danger">
							        <ul>
							            @foreach ($errors->all() as $error)
							                <li>{{ $error }}</li>
							            @endforeach
							        </ul>
							    </div>
							@endif
							@if(session('thongbao'))
		                        <div class="alert bg-danger">
									<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
									<span class="text-semibold">Error!</span>  {{session('thongbao')}}
								</div>
		            		@endif
							<div class="form-group has-feedback has-feedback-left">
								<input type="text" name="username" class="form-control" placeholder="Username">
								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>
							</div>

							<div class="form-group has-feedback has-feedback-left">
								<input type="password" name="password" class="form-control" placeholder="Password">
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>

							<div class="form-group login-options">
								<div class="row">
									<div class="col-sm-6">
										<label class="checkbox-inline">
											<input type="checkbox" class="styled" checked="checked">
											Remember
										</label>
									</div>
								</div>
							</div>

							<div class="form-group">
								<button type="submit" class="btn bg-blue btn-block">Login <i class="icon-circle-right2 position-right"></i></button>
							</div>

							
						</div>
					</form>
					<!-- /advanced login -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

</body>
</html>
