<!DOCTYPE html>
<html lang="en">
<head>
	<title>Quản lý phòng trọ</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<base href="{{asset('')}}">
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/style.css">
	<link rel="stylesheet" href="assets/awesome/css/fontawesome-all.css">
	<link rel="stylesheet" href="assets/toast/toastr.min.css">
	<script src="assets/jquery.min.js"></script>
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/myjs.js"></script>
	<link rel="stylesheet" href="assets/selectize.default.css" data-theme="default">
	<script src="assets/js/fileinput/fileinput.js" type="text/javascript"></script>
	<script src="assets/js/fileinput/vi.js" type="text/javascript"></script>
	<link rel="stylesheet" href="assets/fileinput.css">
	<script src="assets/pgwslider/pgwslider.min.js" type="text/javascript"></script>
	<link rel="stylesheet" href="assets/pgwslider/pgwslider.min.css">
<!-- sortable.min.js is only needed if you wish to sort / rearrange files in initial preview. 
    This must be loaded before fileinput.min.js -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.8/js/plugins/sortable.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.8/js/plugins/purify.min.js" type="text/javascript"></script> -->
<link rel="stylesheet" href="assets/bootstrap/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="assets/bootstrap/bootstrap-select.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-inverse">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>                        
				</button>
				<a class="navbar-brand" href="/"><img src="images/logo.png"></a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<!-- <ul class="nav navbar-nav">
					@foreach($categories as $category)
					<li><a href="category/{{$category->id}}">{{ $category->name }}</a></li>
					@endforeach
				</ul> -->
				@if(Auth::user())
				<ul class="nav navbar-nav navbar-right">
					<li><a class="btn-dangtin" href="user/dangtin"><i class="fas fa-pen-square"></i> Đăng tin ngay</a></li>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">Xin chào! {{Auth::user()->name}} <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="user/profile">Thông tin chi tiết</a></li>
							<li><a href="user/dangtin">Đăng tin</a></li>
							<li><a href="user/logout">Thoát</a></li>
						</ul>
					</li>
					
				</ul>
				
				@else
				<ul class="nav navbar-nav navbar-right">
					<li><a class="btn-dangtin" href="user/dangtin"><i class="fas fa-pen-square"></i> Đăng tin ngay</a></li>
					<li><a class="btn-dangtin" href="user/login"><i class="fas fa-home"></i> Đăng Nhập</a></li>
					<li><a class="btn-dangtin" href="user/register"><i class="fas fa-sign-in-alt"></i> Đăng Kí</a></li>
				</ul>
				@endif
			</div>
		</div>
	</nav>
	
		@yield('content')
	<div class="gap"></div>
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="logo-footer">
						<a href="/" title="Cổng thông tin số 1 về Dự án Bất động sản - Homedy.com">
							                    
						</a>
						<div style="padding-top: 10px;">
							<p>Đề tài bài tập lớn: Quản lý phòng trọ sinh viên</p>
							<p>Sinh viên thực hiện: Đoàn Đức Đồng, Diệp Văn Trung, Trần Văn Linh</p>
						</div>
					</div>
				</div>
			</div>
		</div>

	</footer>
	
<script type="text/javascript" src="assets/toast/toastr.min.js"></script>
</body>
</html>
