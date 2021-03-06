<?php
$bestseller = DB::table('sanpham')->select('Id_SP', 'Ten_SP', 'urlHinh1', 'urlHinh2', 'urlHinh3', 'MoTa', 'Gia')
	->where('AnHien', 1)->limit(4)->get();
$kh = Session::has('khachhang');
?>
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<section class="ftco-section ">
	<div class="container">
		<div class="row justify-content-center pb-3 ">
			<div class="col-md-7 heading-section ftco-animate text-center">
				<span class="subheading" style="margin-bottom: 5px">Burn Coffee</span>
				<h2 class="mb-4">Thức uống được săn nhiều nhất</h2>
				<p>Được trải nghiệm nhiều loại thức uống, nhưng khách hàng vẫn ưa thích những món nước này. Đó là nguyên nhân Burn Coffee luôn cuốn hút và giữ chân khách hàng</p>
			</div>
		</div>
		<div class="row  border-box">
			@foreach($bestseller as $showsp)
			<?php
				$gh = DB::table('giohang')->select('Id_GH', 'Id_SP', 'So_Luong', 'Id_KH')->where('Id_SP', '=', $showsp->Id_SP)->first();
			?>
			<div class="col-md-3">
				<div class="menu-entry">
					<div class="img">
						<a href="{{action("ProductController@detailproduct",['Id_SP'=>$showsp->Id_SP])}}" ;">
							<img src="images/<?= $showsp->urlHinh1 ?>" alt="">
						</a>
						<ul class="featured_item">
							<li>
								<a href="{{action("ProductController@detailproduct",['Id_SP'=>$showsp->Id_SP])}}"><span class="icon-eye"></span></a>
							</li>
							<li>
								<form id="cartform1-{{ $showsp->Id_SP }}">
									@csrf
									<div class="div" style="display: none;">
										<input type="text" id="id-{{ $showsp->Id_SP }}" name="id" value="{{ $showsp->Id_SP }}">
									</div>
									<div class="text-center">
										<button type="submit"><span class="icon-shopping-cart"></span></button>
									</div>
								</form>
							</li>
						</ul>
					</div>
					<div class="text pt-4">
						<h3><a href="{{action("ProductController@detailproduct",['Id_SP'=>$showsp->Id_SP])}}"><?= $showsp->Ten_SP ?></a></h3>
						{{-- <p class="mota">{{ $showsp->MoTa }}</p> --}}
						<p class="price"><span>{{ number_format($showsp->Gia) }} đ</span></p>
					</div>

				</div>
			</div>

			<script>
				var idkh = {{$kh}}
				$('#cartform1-{{ $showsp->Id_SP }}').submit(function(e) {
					e.preventDefault();
					if (idkh > 0) {
						let id = $("#id-{{ $showsp->Id_SP }}").val()
						$.ajax({
							type: "POST",
							url: "{{route('ct.add')}}",
							data: {
								"_token": "{{ csrf_token() }}",
								id: id,
							},
							success: function(response) {
								if (response) {
									$("#change-item-cart").empty();
									$("#change-item-cart").html(response);
									alertify.success('Sản phẩm đã được thêm');
								}
							}
						});
					} else {
						alertify.error('Đăng nhập để thêm giỏ hàng');
					}
				});
			</script>
			@endforeach
		</div>
	</div>
</section>