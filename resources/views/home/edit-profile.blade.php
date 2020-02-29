@extends('layouts.master')
@section('content')
<div class="container" style="padding-left: 0px;padding-right: 0px;">
	<div class="gap"></div>
	<div class="row">
		<div class="col-md-8 col-md-offset-2" style="margin-bottom: 50px">
			<div class="gap"></div>
			<div class="panel panel-primary">
				<div class="panel-heading">Chỉnh sửa hồ sơ</div>
				<div class="panel-body">
					<div class="gap"></div>
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
		                        <div class="alert bg-success">
									<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
									<span class="text-semibold">Done</span>  {{session('thongbao')}}
								</div>
		            @endif
					<form class="form-horizontal" method="POST" action="{{ route('user.edit') }}" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="content-upload">
							<center>
								@if(Auth::user()->avatar == 'no-avatar.jpg')
									<img class="user_avatar" id="output" src="images/no-avatar.jpg">
								@else
									<img class="user_avatar" id="output" src="uploads/avatars/{{ $user->avatar }}">
								@endif
								<label for="avtuser" class="labelforfile"><i class="fas fa-file-image"></i> Chọn ảnh</label>
								<input class="form-control" name="avtuser" id="avtuser" type="file" accept="image/*" onchange="loadFile(event)" style="display: none">
								<script>
								  var loadFile = function(event) {
								    var output = document.getElementById('output');
								    output.src = URL.createObjectURL(event.target.files[0]);
								  };
								</script>
							</center>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Tên hiển thị:</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="txtname" value="{{$user->name}}" placeholder="Tên hiển thị trên hệ thống">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3" for="pwd">Mật khẩu:</label>
							<div class="col-sm-9"> 
								<input type="password" class="form-control" name="txtpass" placeholder="Nhập mật khẩu">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3" for="pwd">Nhập lại mật khẩu:</label>
							<div class="col-sm-9"> 
								<input type="password" class="form-control" name="retxtpass" placeholder="Nhập lại mật khẩu">
							</div>
						</div>
						<div class="form-group"> 
							<div class="col-sm-offset-5 col-sm-9">
								<button type="submit" class="btn btn-primary">Chỉnh sửa</button>
							</div>
						</div>
					</form><div class="gap"></div>
				</div>

			<div class="gap"></div>
			</div>
		</div>
	</div>

</div>
@endsection