@extends('layoutchild')
	@include('services.backG')
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<section class="ftco-section">
    	<div class="container">
    		<div class="row">
    			<div class="col-lg-6 mb-5 ftco-animate">
					<img src="images/{{$sanpham->urlHinh1}}" class="img-fluid" alt="Colorlib Template">
				</div>
				<div class="col-lg-6 product-details pl-md-5 ftco-animate">
					@if (Session::has('khachhang'))
					<?php
						$cart = \Cart::session(Session::get('khachhang')['Id_KH'])->get($sanpham->Id_SP);
					?>
					@if ($cart)
					<form id="updateform1">
						{{ csrf_field() }}
						<div class="chua" style="display: none;">
							<input type="text" id="id-{{ $sanpham->Id_SP }}" name="id" value="{{ $sanpham->Id_SP }}">
							<input type="text" name="quantity" id="quantity" class="form-control input-number cungsp"/>
						</div>
							<h3> {{$sanpham->Ten_SP}}</h3>
							<p class="price"><span> {{number_format($sanpham->Gia)}} đ </span></p>
							{!! $sanpham->MoTa !!}
							<div class="row mt-4">
								<div class="col-md-6">
									<div class="form-group d-flex"></div>
								</div>
								<div class="w-100"></div>
								<div class="input-group col-md-6 d-flex mb-3">
									<span class="input-group-btn mr-2">
										<button type="button" class="quantity-left-minus btn" id="tru"  data-type="tru" data-field="">
											<i class="icon-minus"></i>
										</button>
									</span>
									<input type="text" name="So_Luong" id="So_Luong" class="form-control input-number sl" max="10" min="0"/>
									<span class="input-group-btn ml-2">
										<button type="button" id="cong" class="quantity-right-plus btn" data-type="cong" data-field="">
											<i class="icon-plus"></i>
										</button>
									</span>
								</div>
							</div>
							<script>
								document.querySelector('.sl').value = 1;
								const minusButton = document.getElementById('tru');
								const plusButton = document.getElementById('cong');
								const inputField = document.getElementById('So_Luong');
								
								minusButton.addEventListener('click', event => {
								event.preventDefault();
									var currentValue = Number(inputField.value);
									if ( currentValue > 1) {
										inputField.value = currentValue - 1;
									} else {
										inputField.value = currentValue;
									}
									var slbd = {{ $cart->quantity }};
									tongsl = Number(slbd) + Number(inputField.value);
									document.querySelector('.cungsp').value = tongsl;
									console.log(tongsl);
								});
								plusButton.addEventListener('click', event => {
								event.preventDefault();
									const currentValue = Number(inputField.value) || 0;
									inputField.value = currentValue + 1;
									var slbd = {{ $cart->quantity }};
									tongsl = Number(slbd) + Number(inputField.value);
									document.querySelector('.cungsp').value = tongsl;
									console.log(tongsl);
								});
								var slbd = {{ $cart->quantity }};
								tongsl = Number(slbd) + Number(inputField.value);
								document.querySelector('.cungsp').value = tongsl;
								console.log(tongsl);
							</script>
							<button type="submit" class="btn py-3 px-4 btn-primary b" style="color: black !important;"><p>Thêm Giỏ Hàng</p></button>
						</form>
						<script>
							$('#updateform1').submit(function (e) { 
								e.preventDefault();
						
								let id = $("#id-{{ $sanpham->Id_SP }}").val()
								let quantity = $(".cungsp").val();

								$.ajax({
									type: "POST",
									url: "/upd/"+id,
									data: {
										"_token": "{{ csrf_token() }}",
										id:id,
										quantity: quantity,
									},
									success: function (response) {
										if(response){
											$("#change-item-cart").empty();
											$("#change-item-cart").html(response);
											alertify.success('Sản phẩm đã được thêm');
										}
									}
								});
							}); 
						</script>
					@else
						<form id="updateform">
							{{ csrf_field() }}
							<div class="chua" style="display: none;">
								<input type="text" id="id-{{ $sanpham->Id_SP }}" name="id" value="{{ $sanpham->Id_SP }}">
								<input type="text" name="quantity" id="quantityc" class="form-control input-number ssl"/>
							</div>
								<h3> {{$sanpham->Ten_SP}}</h3>
								<p class="price"><span> {{number_format($sanpham->Gia)}} đ </span></p>
								{!! $sanpham->MoTa !!}
								<div class="row mt-4">
									<div class="col-md-6">
										<div class="form-group d-flex"></div>
									</div>
									<div class="w-100"></div>
									<div class="input-group col-md-6 d-flex mb-3">
										<span class="input-group-btn mr-2">
											<button type="button" class="quantity-left-minus btn" id="tru"  data-type="tru" data-field="">
												<i class="icon-minus"></i>
											</button>
										</span>
										<input type="text" name="So_Luong" id="So_Luong" class="form-control input-number sl" max="10" min="0"/>
										<span class="input-group-btn ml-2">
											<button type="button" id="cong" class="quantity-right-plus btn" data-type="cong" data-field="">
												<i class="icon-plus"></i>
											</button>
										</span>
									</div>
								</div>
								<script>
									document.querySelector('.sl').value = 1;
									const minusButton = document.getElementById('tru');
									const plusButton = document.getElementById('cong');
									const inputField = document.getElementById('So_Luong');
									
									minusButton.addEventListener('click', event => {
									event.preventDefault();
										var currentValue = Number(inputField.value);
										if ( currentValue > 1) {
											inputField.value = currentValue - 1;
										} else {
											inputField.value = currentValue;
										}
										var slbd = 0;
										tongsl = Number(slbd) + Number(inputField.value);
										document.querySelector('.ssl').value = tongsl;
										console.log(tongsl);
									});
									plusButton.addEventListener('click', event => {
									event.preventDefault();
										const currentValue = Number(inputField.value) || 0;
										inputField.value = currentValue + 1;
										var slbd = 0;
										tongsl = Number(slbd) + Number(inputField.value);
										document.querySelector('.ssl').value = tongsl;
										console.log(tongsl);
									});
									var slbd = 0;
									tongsl = Number(slbd) + Number(inputField.value);
									document.querySelector('.ssl').value = tongsl;
									console.log(tongsl);
								</script>
							
								<button type="submit" class="btn py-3 px-4 btn-primary b" style="color: black !important;"><p>Thêm Giỏ Hàng</p></button>
							</form>
							<script>
								$('#updateform').submit(function (e) { 
									e.preventDefault();
							
									let id = $("#id-{{ $sanpham->Id_SP }}").val()
									let quantity = $("#quantityc").val();
									$.ajax({
										type: "POST",
										url: "{{ route('ctdt.add') }}",
										data: {
											"_token": "{{ csrf_token() }}",
											id:id,
											quantity: quantity,
										},
										success: function (response) {
											if(response){
												$("#change-item-cart").empty();
												$("#change-item-cart").html(response);
												alertify.success('Sản phẩm đã được thêm');
											}
										}
									});
								}); 
							</script>
					@endif
					@else
						<h3> {{$sanpham->Ten_SP}}</h3>
						<p class="price"><span> {{$sanpham->Gia}} đ </span></p>
						<p> {{$sanpham->MoTa}}</p>
						<div class="row mt-4">
							<div class="col-md-6">
								<div class="form-group d-flex"></div>
							</div>
							<div class="w-100"></div>
						</div>
						<h5>Cần <a href="/dang-nhap">Đăng Nhập</a> để thêm vào giỏ hàng</h5>
					@endif
				</div>
    		</div>
		</div>

		@include('danhgia')
</section>

<div class="slider-banner" style="background-image: url(images/BurnCoffee_Banner.jpg);">
      	<div class="overlay"></div>
        
        </div>
      </div>
@include('bestseller');
<script src="js/jquery.min.js"></script>
<script src="js/jquery-migrate-3.0.1.min.js"></script>
<script src="css/slick/slick.js"></script>
<script>
	const minusButton = document.getElementById('tru');
	const plusButton = document.getElementById('cong');
	const inputField = document.getElementById('it');

	minusButton.addEventListener('click', event => {
	event.preventDefault();
	const currentValue = Number(inputField.value) || 0;
	inputField.value = currentValue - 1;
	});

	plusButton.addEventListener('click', event => {
	event.preventDefault();
	const currentValue = Number(inputField.value) || 0;
	inputField.value = currentValue + 1;
	});
	
</script>
<style>
	.t{
		position: relative;
    	z-index: 999;
	}
	.b:hover{
		border: 1px solid #c49b63 !important;
		background: transparent;
	}
	.b:hover p{
		color: #c49b63 !important;
	}
	.card{
		background-color: unset !important;
	}
	.progress {
		height: 1.3rem !important;
	}
	.progress-bar{
		background-color: #ff9f02 !important;
	}
</style>