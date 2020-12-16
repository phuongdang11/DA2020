<?php
$loaisp = DB::table('LoaiSP')->select('Id_LoaiSP', 'Ten_LoaiSP')
	->orderby('ThuTu', 'asc')->where('AnHien', '=', '1')->get();
$kh = Session::has('khachhang');
?>
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
{{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script> --}}
<section class="ftco-menu mb-5 pb-5">
	<div class="container">
		<div class="row justify-content-center ">
			<div class="col-md-7 heading-section text-center ftco-animate">
				<span class="subheading" style="margin-bottom: 5px">Burn Coffee</span>
				<h2 class="mb-4">Sản phẩm của chúng tôi</h2>
				<p>Từ hạt cà phê nguyên chất, Burn Coffee mang đến nhiều sự lựa chọn đến khách hàng khi chế biến những thức uống nhằm đem lại cảm giác mới lạ cho khách hàng thưởng thức một cách tuyệt vời nhất.</p>
			</div>
		</div>
		<div class="row d-md-flex border-red ">
			<div class="col-lg-12 ftco-animate">
				<div class="row ">
					<div class="col-md-12 nav-link-wrap mb-5">

						<div class="nav ftco-animate nav-pills justify-content-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
							@foreach($loaisp as $loai)
							@if ($loop->first)
							<a class="nav-link active" id="v-pills-<?= $loai->Id_LoaiSP ?>-tab" data-toggle="pill" href="#v-pills-<?= $loai->Id_LoaiSP ?>" role="tab" aria-controls="v-pills-<?= $loai->Id_LoaiSP ?>" aria-selected="true"><?= $loai->Ten_LoaiSP ?></a>
							@else

							<a class="nav-link" id="v-pills-<?= $loai->Id_LoaiSP ?>-tab" data-toggle="pill" href="#v-pills-<?= $loai->Id_LoaiSP ?>" role="tab" aria-controls="v-pills-<?= $loai->Id_LoaiSP ?>" aria-selected="false"><?= $loai->Ten_LoaiSP ?></a>
							@endif
							@endforeach
						</div>

					</div>
					<div class="col-md-12 d-flex align-items-center">

						<div class="tab-content ftco-animate " id="v-pills-tabContent">
							@foreach($loaisp as $loai)
							@if ($loop->first)
							<div class="tab-pane fade show active" id="v-pills-<?= $loai->Id_LoaiSP ?>" role="tabpanel" aria-labelledby="v-pills-<?= $loai->Id_LoaiSP ?>-tab">
								<div class="row slider-product owl-carousel ">
									<?php
									$sanpham = DB::table('sanpham')->select('Id_SP', 'Ten_SP', 'urlHinh1', 'Gia', 'Id_LoaiSP')
										->where('Id_LoaiSP', '=', $loai->Id_LoaiSP)
										->where('sanpham.AnHien', '=', '1')->limit('4')->get();
									?>
									@foreach($sanpham as $showsp)
									<div class=" col-md-3 ">
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
														<form id="cartform-{{ $showsp->Id_SP }}">
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
												{{-- <p><a href="{{action("ProductController@detailproduct",['Id_SP'=>$showsp->Id_SP])}}" class="btn btn-primary btn-outline-primary">Chi tiết</a></p> --}}

												<script>
													var idkh = {{$kh}}
													$('#cartform-{{ $showsp->Id_SP }}').submit(function(e) {
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
											</div>
										</div>
									</div>

									@endforeach
								</div>
							</div>
							@else
							<div class="tab-pane fade" id="v-pills-<?= $loai->Id_LoaiSP ?>" role="tabpanel" aria-labelledby="v-pills-<?= $loai->Id_LoaiSP ?>-tab">
								<div class="row">
									<?php
									$sanpham = DB::table('sanpham')->select('Id_SP', 'Ten_SP', 'urlHinh1', 'Gia', 'Id_LoaiSP')
										->where('Id_LoaiSP', '=', $loai->Id_LoaiSP)
										->where('sanpham.AnHien', '=', '1')->limit('4')->get();
									?>
									@foreach($sanpham as $showsp)
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
														<form id="cartform-{{ $showsp->Id_SP }}">
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
												{{-- <p><a href="{{action("ProductController@detailproduct",['Id_SP'=>$showsp->Id_SP])}}" class="btn btn-primary btn-outline-primary">Chi tiết</a></p> --}}
											</div>
										</div>
									</div>

									<script>
										var idkh = {{$kh}}
										$('#cartform-{{ $showsp->Id_SP }}').submit(function(e) {
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
							@endif
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>