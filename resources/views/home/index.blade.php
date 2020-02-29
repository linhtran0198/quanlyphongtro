@extends('layouts.master')
@section('content')
<?php 
function limit_description($string){
	$string = strip_tags($string);
	if (strlen($string) > 100) {

	    // truncate string
	    $stringCut = substr($string, 0, 100);
	    $endPoint = strrpos($stringCut, ' ');

	    //if the string doesn't contain any space then it will cut without word basis.
	    $string = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);
	    $string .= '...';
	}
	return $string;
}
function time_elapsed_string($datetime, $full = false) {
	$now = new DateTime;
	$ago = new DateTime($datetime);
	$diff = $now->diff($ago);

	$diff->w = floor($diff->d / 7);
	$diff->d -= $diff->w * 7;

	$string = array(
		'y' => 'năm',
		'm' => 'tháng',
		'w' => 'tuần',
		'd' => 'ngày',
		'h' => 'giờ',
		'i' => 'phút',
		's' => 'giây',
	);
	foreach ($string as $k => &$v) {
		if ($diff->$k) {
			$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
		} else {
			unset($string[$k]);
		}
	}

	if (!$full) $string = array_slice($string, 0, 1);
	return $string ? implode(', ', $string) . ' trước' : 'Vừa xong';
}
?>
<div class="container-fluid" style="padding-left: 0px;padding-right: 0px;">
	<div class="search-map hidden-xs" >
		<div id="map"></div>
		<div class="box-search">
				<!-- <div id="flat"></div>
					<div id="lng"></div> -->
					<form onsubmit="return false">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group-1 row text-center">
							<div class="col search-left">
								<select class="selectpicker" data-live-search="true" id="selectdistrict">
									@foreach($district as $quan)
									<option data-tokens="{{$quan->slug}}" value="{{ $quan->id }}">{{ $quan->name }}</option>
									@endforeach
								</select>
							</div>
					
							<div class="col-md search-left">
								<select class="selectpicker" id="selectprice" data-live-search="true">
									<option data-tokens="khoang gia" min="1" max="10000000">Khoảng giá</option>
									<option data-tokens="Tu 500.000 VNĐ - 700.000 VNĐ" min="500000" max ="700000">Từ 500.000 VNĐ - 700.000 VNĐ</option>
									<option data-tokens="Tu 700.000 VNĐ - 1.000.000 VNĐ" min="700000" max ="1000000">Từ 700.000 VNĐ - 1.000.000 VNĐ</option>
									<option data-tokens="Tu 1.000.000 VNĐ - 1.500.000 VNĐ" min="1000000" max ="1500000">Từ 1.000.000 VNĐ - 1.500.000 VNĐ</option>
									<option data-tokens="Tu 1.500.000 VNĐ - 3.000.000 VNĐ" min="1500000" max ="3000000">Từ 1.500.000 VNĐ - 3.000.000 VNĐ</option>
									<option data-tokens="Tren 3.000.000 VNĐ" min="3000000" max="10000000">Trên 3.000.000 VNĐ</option>
								</select>
							</div>
							<div class="col search-left">
								<button class="btn btn-success" onclick="searchMotelajax()">Tìm kiếm ngay</button>
							</div>
						</div>
						
						<form>
						</div>
					</div>


				</div>
				<div class="container">
					</div>
					<div class="container">
								<h2 class="title-comm"><span class="title-holder">DANH SÁCH PHÒNG TRỌ</span></h2>
								<div class="line-container">
									<div class="line-title"></div>
								</div>
								<div class="row">
									<div class="col">
										@foreach($listmotelroom as $room)
										<?php 
											$img_thumb = json_decode($room->images,true);
										 ?>
										<div class="room-item-vertical">
											<div class="row">
												<div class="col-md-4">
													<div class="wrap-img-vertical" style="background: url(uploads/images/<?php echo $img_thumb[0]; ?>) center;     background-size: cover;">
														
														<div class="category">
															<a href="category/{{ $room->category->id }}">{{ $room->category->name }}</a>
														</div>
													</div>
												</div>
												<div class="col-md-8">
													<div class="room-detail">
														<h4><a href="phongtro/{{ $room->slug }}">{{ $room->title }}</a></h4>
														<div class="room-meta">
															<span><i class="fas fa-user-circle"></i> Người đăng: {{ $room->user->name }}</span>
															<span class="pull-right"><i class="far fa-clock"></i> <?php 
											echo time_elapsed_string($room->created_at);
											?></span>
														</div>
														
														<div class="room-info">
															<span><i class="far fa-stop-circle"></i> Diện tích: <b>{{ $room->area }} m<sup>2</sup></b></span>
															<span class="pull-right"><i class="fas fa-eye"></i> Lượt xem: <b>{{ $room->count_view }}</b></span>
															<div><i class="fas fa-map-marker"></i> Địa chỉ: {{ $room->address }}</div>
															<div style="color: #e74c3c"><i class="far fa-money-bill-alt"></i> Giá thuê: <b>{{ number_format($room->price) }}</b></div>
														</div>
													</div>
												</div>
											</div>
										</div>
										@endforeach
										<!-- <ul class="pagination pull-right">
											@if($listmotelroom->currentPage() != 1)
												<li><a href="{{ $listmotelroom->url($listmotelroom->currentPage() -1) }}">Trước</a></li>
											@endif
											@for($i= 1 ; $i<= $listmotelroom->lastPage(); $i++)
										  	<li class=" {{ ($listmotelroom->currentPage() == $i )? 'active':''}}">
										  		<a href="{{ $listmotelroom->url($i) }}">{{ $i }}</a>
										  	</li>
										  	@endfor
											@if($listmotelroom->currentPage() != $listmotelroom->lastPage())
												<li><a href="{{ $listmotelroom->url($listmotelroom->currentPage() +1) }}">Sau</a></li>
											@endif
										</ul>  -->
									</div>
									<div class="col">
										@foreach($listmotelroom as $room)
										<?php 
											$img_thumb = json_decode($room->images,true);
										 ?>
										<div class="room-item-vertical">
											<div class="row">
												<div class="col-md-4">
													<div class="wrap-img-vertical" style="background: url(uploads/images/<?php echo $img_thumb[0]; ?>) center;     background-size: cover;">
														
														<div class="category">
															<a href="category/{{ $room->category->id }}">{{ $room->category->name }}</a>
														</div>
													</div>
												</div>
												<div class="col-md-8">
													<div class="room-detail">
														<h4><a href="phongtro/{{ $room->slug }}">{{ $room->title }}</a></h4>
														<div class="room-meta">
															<span><i class="fas fa-user-circle"></i> Người đăng: {{ $room->user->name }}</span>
															<span class="pull-right"><i class="far fa-clock"></i> <?php 
											echo time_elapsed_string($room->created_at);
											?></span>
														</div>
														
														<div class="room-info">
															<span><i class="far fa-stop-circle"></i> Diện tích: <b>{{ $room->area }} m<sup>2</sup></b></span>
															<span class="pull-right"><i class="fas fa-eye"></i> Lượt xem: <b>{{ $room->count_view }}</b></span>
															<div><i class="fas fa-map-marker"></i> Địa chỉ: {{ $room->address }}</div>
															<div style="color: #e74c3c"><i class="far fa-money-bill-alt"></i> Giá thuê: <b>{{ number_format($room->price) }}</b></div>
														</div>
													</div>
												</div>
											</div>
										</div>
										@endforeach
										<ul class="pagination pull-right">
											@if($listmotelroom->currentPage() != 1)
												<li><a href="{{ $listmotelroom->url($listmotelroom->currentPage() -1) }}"><<</a></li>
											@endif
											@for($i= 1 ; $i<= $listmotelroom->lastPage(); $i++)
										  	<li class=" {{ ($listmotelroom->currentPage() == $i )? 'active':''}}">
										  		<a href="{{ $listmotelroom->url($i) }}">{{ $i }}</a>
										  	</li>
										  	@endfor
											@if($listmotelroom->currentPage() != $listmotelroom->lastPage())
												<li><a href="{{ $listmotelroom->url($listmotelroom->currentPage() +1) }}">>></a></li>
											@endif
										</ul>
									</div>
								</div>
							</div>
					<h2 class="title-comm"><span class="title-holder">PHÒNG TRỌ XEM NHIỀU NHẤT</span></h2>
								<div class="line-container">
									<div class="line-title"></div>
								</div>
					<div class="row room-hot">
						@foreach($hot_motelroom as $room)
						<?php 
							$img_thumb = json_decode($room->images,true);
							
						 ?>
						<div class="col-md-4 col-sm-6">
							<div class="room-item">
								<div class="wrap-img" style="background: url(uploads/images/<?php echo $img_thumb[0]; ?>) center;     background-size: cover;">
									<img src="" class="lazyload img-responsive">
									<div class="category">
										<a href="category/{{ $room->category->id }}">{{ $room->category->name }}</a>
									</div>
								</div>
								<div class="room-detail">
									<h4><a href="phongtro/{{ $room->slug }}">{{ $room->title }}</a></h4>
									<div class="room-meta">
										<span><i class="fas fa-user-circle"></i> Người đăng: <a href="/"> {{ $room->user->name }}</a></span>
										<span class="pull-right"><i class="far fa-clock"></i>
											<?php 
											echo time_elapsed_string($room->created_at);
											?>
										</span>
									</div>
									<div class="room-description"><i class="fas fa-audio-description"></i>
										{{ limit_description($room->description) }}</div>
									<div class="room-info">
										<span><i class="far fa-stop-circle"></i> Diện tích: <b>{{ $room->area }} m<sup>2</sup></b></span>
										<span class="pull-right"><i class="fas fa-eye"></i> Lượt xem: <b>{{ $room->count_view }}</b></span>
										<div><i class="fas fa-map-marker"></i> Địa chỉ: {{ $room->address }}</div>
										<div style="color: #e74c3c"><i class="far fa-money-bill-alt"></i> Giá thuê: 
											<b>{{ number_format($room->price) }} VNĐ</b></div>
										</div>
									</div>

								</div>
							</div>
							@endforeach
							
								
								</div>
							</div>
							
							
							<script>
								
								var map;
								function initMap() {
									map = new google.maps.Map(document.getElementById('map'), {
										center: {lat:21.0534025, lng: 105.74025170000004},
										zoom: 15,
										draggable: true
									});
									/* Get latlng list phòng trọ */
									<?php
									$arrmergeLatln = array();
									foreach ($map_motelroom as $room) {
										$arrlatlng = json_decode($room->latlng,true);
										$arrImg = json_decode($room->images,true);
										$arrmergeLatln[] = ["slug"=> $room->slug ,"lat"=> $arrlatlng[0],"lng"=> $arrlatlng[1],"title"=>$room->title,"address"=> $room->address,"image"=>$arrImg[0],"phone"=>$room->phone];
										
									}

									$js_array = json_encode($arrmergeLatln);
									echo "var javascript_array = ". $js_array . ";\n";

									?>
									/* ---------------  */
									console.log(javascript_array);

									var listphongtro = [
									{
										lat: 21.0534025, 
										lng: 105.74025170000004,
										title: 'Nguyen Xa',
										content: 'Cho thue tro'
									},
									{
										lat: 21.0498859, 
										lng: 105.73144960000002,
										title: ' Ngoa Long',
										content: 'Phong tro gia re'
									}
									];
									console.log(javascript_array);

									for (i in javascript_array){
										var data = javascript_array[i];
										var latlng =  new google.maps.LatLng(data.lat,data.lng);
										var phongtro = new google.maps.Marker({
											position:  latlng,
											map: map,
											title: data.title,
											icon: "images/gps.png",
											content: 'dgfdgfdg'
										});
										var infowindow = new google.maps.InfoWindow();
										(function(phongtro, data){
											var content = '<div id="iw-container">' +
											'<img height="200px" width="300" src="uploads/images/'+data.image+'">'+
											'<a href="phongtro/'+data.slug+'"><div class="iw-title">' + data.title +'</div></a>' +
											'<p><i class="fas fa-map-marker" style="color:#003352"></i> '+ data.address +'<br>'+
											'<br>Phone. ' +data.phone +'</div>';

											google.maps.event.addListener(phongtro, "click", function(e){

												infowindow.setContent(content);
												infowindow.open(map, phongtro);
                  // alert(data.title);
              });
										})(phongtro,data);

									}
			// google.maps.event.addListener(map, 'mousemove', function (e) {
			// 	document.getElementById("flat").innerHTML = e.latLng.lat().toFixed(6);
			// 	document.getElementById("lng").innerHTML = e.latLng.lng().toFixed(6);

			// });


		}

	</script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCzlVX517mZWArHv4Dt3_JVG0aPmbSE5mE&callback=initMap"
	async defer></script>
	@endsection