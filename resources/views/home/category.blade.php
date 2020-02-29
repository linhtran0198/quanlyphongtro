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



</div>
<div class="container" style="min-height: 400px">
	<h2 style="text-align: center;color:#009688;font-size:230%; font-weight: bold; padding: 30px"> DANH SÁCH PHÒNG TRỌ</h2>
	@if(count($listmotel) == 0)
		Không có kết quả nào trong danh mục này
	@endif
	<div class="row room-hot">
		@foreach($listmotel as $room)
		<?php 
		$img_thumb = json_decode($room->images,true);

		?>
		<div class="col-md-4 col-sm-6">
			<div class="room-item">
				<div class="wrap-img" style="background: url(uploads/images/<?php echo $img_thumb[0]; ?>) center;     background-size: cover;">
					<img src="" class="lazyload img-responsive">
					<div class="category">
						<a href="">{{ $room->category->name }}</a>
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


			@if(count($listmotel) != 0)
			<ul class="pagination pull-right">
				@if($listmotel->currentPage() != 1)
				<li><a href="{{ $listmotel->url($listmotel->currentPage() -1) }}">Trước</a></li>
				@endif
				@for($i= 1 ; $i<= $listmotel->lastPage(); $i++)
				<li class=" {{ ($listmotel->currentPage() == $i )? 'active':''}}">
					<a href="{{ $listmotel->url($i) }}">{{ $i }}</a>
				</li>
				@endfor
				@if($listmotel->currentPage() != $listmotel->lastPage())
				<li><a href="{{ $listmotel->url($listmotel->currentPage() +1) }}">Sau</a></li>
				@endif
			</ul>
			@endif
</div>
@endsection