@extends('../layoutchild')
	@include('services.backG')
<?php
	$quan = DB::table('Quan')->select('Id_Q', 'Ten_Quan')->where('AnHien','=','1')->get();
?>
<?php
	$slsp = \Cart::session(Session::get('khachhang')['Id_KH'])->getContent();
?>
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>	
<section class="ftco-section">
      <div class="container">
        <div class="row">
          <div class="col-xl-8 ftco-animate">
			<form action="thanhtoan/{{ Session::get('khachhang')['Id_KH'] }}" method="POST" class="billing-form" id="form-1">
				{{ csrf_field() }}
				<div class="layouts ftco-bg-dark cart-total p-3 p-md-5">
					<h3 class="mb-4 billing-heading">Thông tin khách hàng</h3>
					<div class="row align-items-end">
						<div class="col-md-12">
						<div class="form-group">
							<label for="firstname">Họ và tên</label>
							<input type="text" name="Ten_KH"  id="fullname" class="form-control" value="{{ Session::get('khachhang')['Ten_KH'] }}">
							<span class="form-message"></span>
						</div>
					</div>

					<div class="w-100"></div>
					<div class="col-md-6">
							<div class="form-group">
								<label for="phone">Số Điện Thoại</label>
									<input type="text" name="DienThoai" id="phone" class="form-control" value="{{ Session::get('khachhang')['DienThoai'] }}">
								<span class="form-message"></span>
							</div>
						</div>
					<div class="col-md-6">
						<div class="form-group row">
							<label for="DiaChi" class="col-md-12 col-form-label ">{{ __('Địa chỉ') }}</label>

							<div class="col-md-12">
								<input id="DiaChi" type="text" class="form-control" name="DiaChi" required value="{{ Session::get('khachhang')['DiaChi'] }}">
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group row">
							<label for="Quan" class="col-md-12 col-form-label ">{{ __('Quận') }}</label>

							<div class="col-md-12">
								<select name="Quan" id="Quan" class="form-control">
									<?php
										$quan1 = DB::table('quan')->select('Id_Q', 'Ten_Quan')->where('Id_Q', '=', (Session::get('khachhang')['Quan']))->first();
									?>
										<option value="{{$quan1->Id_Q}}">{{$quan1->Ten_Quan}}</option>
										@foreach($quan as $q)
                                           <option value="{{ $q->Id_Q }}">{{ $q->Ten_Quan }} </option>                                 
                                        @endforeach                        
								</select>
								<script>
									$(document).ready(function() {
										$("[name='Quan']").change(function() {
											var Id_Q = $(this).val();
											var diachi = '/quantophuong/' + Id_Q;
										$("[name = 'Phuong']").load(diachi);
										});
									});
								</script>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group row">
							<label for="Phuong" class="col-md-12 col-form-label ">{{ __('Phường') }}</label>
								<div class="col-md-12">
									<select name="Phuong" id="Phuong" class="form-control">
										<?php
											$phuong = DB::table('phuong')->select('Id_P', 'Ten_Phuong')->where('Id_P', '=', Session::get('khachhang')['Phuong'])->first();
										?>
										<option>{{ $phuong->Ten_Phuong }}</option>
									</select>
								</div>
						</div>
					</div>
						<div class="w-100"></div>
					</div>
				</div>
			<!-- END -->
		<div class="row mt-5 pt-3 d-flex">
		
		<div class="col-md-6 d-flex">
			<div class="cart-detail cart-total ftco-bg-dark p-3 p-md-4">
				<h3 class="billing-heading mb-4">Tổng tiền</h3>
				<p class="d-flex">
					<span>Thành tiền</span>
					<input type="text" class="ttt" style="display: none;" value="0">
					<span class="thanhtien text-right"></span>
				</p>
				<p class="d-flex">
					<span>Phí ship</span>
					<span class="phiship text-right"></span>
				</p>
				<div class="form-group">
					<div class="input-group">
						<input name="Voucher" id="Vc" style="text-transform: uppercase;" placeholder="NHẬP VOUCHER" class="form-control vc" aria-label="Recipient's username" aria-describedby="button-addon2">
						<div class="input-group-append">
						  <button class="btn btn-primary btn-outline-secondary" onclick="myFunction()" type="button" id="button-addon2">Kiểm tra</button>
						</div>
					  </div>
				</div>
				<p class="d-flex">
					<span>Voucher</span>
					<span class="phigiam text-right"></span>
				</p>
				<hr>
				<p class="d-flex total-price">
					<span>Tổng tiền</span>
					<span class="tongtien text-right" id="ttt"></span>
					<input type="text" name="Tong_Tien" id="Tong_Tien" style="display: none;">
					<input type="text" name="AnHien" value="1" style="display: none;">
					<input type="text" name="ThuTu" value="1" style="display: none;">
					<input type="text" name="TrangThai" id="PT_TT" style="display: none;">
					<input type="text" name="Id_KH" value="{{ Session::get('khachhang')['Id_KH'] }}" style="display: none;">
					<input type="date" name="Ngay_Dang" id="datePicker" style="display: none;">
					<script>
						document.getElementById('datePicker').valueAsDate = new Date();
					</script>
				</p>
			</div>
		</div>
	<div class="col-md-6">
		<div class="cart-detail ftco-bg-dark p-3 p-md-4">
			<h3 class="billing-heading mb-4">thanh toán</h3>
						<div class="form-group">
							<div class="col-md-12">
								<div class="radio">
									<label  onchange="shipcsss()"><input type="radio" name="PT_TT" id="PT_TT" value="1" required class="mr-2">Trực tiếp</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12">
								<div class="radio">
									<label onchange="ckcsss()"><input type="radio" name="PT_TT" value="2" required class="mr-2">Chuyển khoản</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12">
								<div class="radio">
									<label onchange="vdcsss()"><input type="radio" name="PT_TT" value="3" required class="mr-2">Ví điện tử</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12">
								<div class="checkbox">
									<label ><input type="checkbox" value="" required class="mr-2">Tôi đã đọc và chấp nhận các điều khoản và điều kiện</label>
								</div>
							</div>
						</div>
						<p><button type="submit" class="btn btn-primary py-3 px-4">Thanh toán</button></p>
					</div>
	          	</div>
	          </div>
		  </div> <!-- .col-md-8 -->
		</form>
		  
          <div class="col-xl-4 sidebar ftco-animate">
			<div class="sidebar-box">
				<h3>Giỏ hàng</h3>
				@foreach ($slsp as $cart)
					<?php $sp = DB::table('sanpham')->select('Id_SP', 'Gia', 'urlHinh1')->where('Id_SP', '=', $cart->id)->get();?>
					@foreach ($sp as $s)
						<div class="detailproduct">
							<div class=" img-pro">
								<a href="" class="menu-img img mb-4" >
									<img src="images/{{$s->urlHinh1}}" alt="">
								</a>
							</div>

							<div class="name-pro mt-4">
								<a href="">
								<p>{{$cart->name}}</p>
								</a>
							</div>

							<div class=" price-pro mt-2">
								<div class="pri">{{number_format($cart->price)}}đ</div>
								<div class="soluong">x{{$cart->quantity}}</div>
								<div class="total">{{\Cart::getSubTotal()}}đ</div>
							</div>
						</div>
					@endforeach  
				@endforeach
			</div>
            
			@include('danhmuc')


			@include('blogchild')

            @include('tags')
          </div>

        </div>
	  </div>
	</section>
<style>
	.sidebar-box {
    	margin-bottom: 0px !important;
	}
</style>
<?php
	$voucher = DB::table('voucher')->select('Id_VC', 'Ten_VC', 'Gia_KM')->get();
?>
<script>
	var s = document.querySelectorAll('.total');
	var sum = 0;
	var cc = 0;
	var idvc = 0;
	var disc = 0;
	var acc = {!!$voucher!!};

	for (var i = 0; i < s.length; i++) {
		var totalall = s[i].innerHTML;
		var res = totalall.slice(0, -1);
		sum += Number(res);
	}
	var ship = 0;
	document.querySelector('.thanhtien').innerHTML = sum + 'đ';
	document.querySelector('.phiship').innerHTML = ship + 'đ';
	document.querySelector('.phigiam').innerHTML = disc + 'đ';
	var totalc = sum + ship - disc;
	document.querySelector('.tongtien').innerHTML = totalc + 'đ';
	document.querySelector('#Tong_Tien').value = totalc;

	function shipcsss() {
		var ship = 30000;
		document.querySelector('.phiship').innerHTML = ship + 'đ';
		document.querySelector('.thanhtien').innerHTML = sum + 'đ';
		document.querySelector('.phigiam').innerHTML = disc + 'đ';
		var totalc = sum + ship - disc;
		document.querySelector('.tongtien').innerHTML = totalc + 'đ';
		document.querySelector('#Tong_Tien').value = totalc;
		var tt = sum + ship;
		document.querySelector('.ttt').value = tt;
		var cc = document.querySelector('.ttt').value;

		var idvc = document.querySelector("#Vc").value;
		for (let i = 0; i < acc.length; i++) {
			if(acc[i]['Ten_VC'] == idvc){
				disc = Number(cc)*acc[i]['Gia_KM']/100;
				var ship1 = document.querySelector('.phiship').innerHTML;
				var ship2 = ship1.slice(0, -1);
				document.querySelector('.thanhtien').innerHTML = sum + 'đ';
				document.querySelector('.phiship').innerHTML = ship2 + 'đ';
				document.querySelector('.phigiam').innerHTML = disc + 'đ';
				var totalc = sum + Number(ship2) - disc;
				document.querySelector('.tongtien').innerHTML = totalc + 'đ';
				document.querySelector('#Tong_Tien').value = totalc;
			}	
		}
		var tt = 2;
		document.querySelector("#PT_TT").value = tt;
	}

	function ckcsss() {
		var ship = 10000;
		document.querySelector('.phiship').innerHTML = ship + 'đ';
		document.querySelector('.thanhtien').innerHTML = sum + 'đ';
		document.querySelector('.phigiam').innerHTML = disc + 'đ';
		var totalc = sum + ship - disc;
		document.querySelector('.tongtien').innerHTML = totalc + 'đ';
		document.querySelector('#Tong_Tien').value = totalc;
		document.querySelector('.ttt').value = totalc;
		var tt = sum + ship;
		document.querySelector('.ttt').value = tt;
		var cc = document.querySelector('.ttt').value;

		var idvc = document.querySelector("#Vc").value;
		for (let i = 0; i < acc.length; i++) {
			if(acc[i]['Ten_VC'] == idvc){
				disc = Number(cc)*acc[i]['Gia_KM']/100;
				var ship1 = document.querySelector('.phiship').innerHTML;
				var ship2 = ship1.slice(0, -1);
				document.querySelector('.thanhtien').innerHTML = sum + 'đ';
				document.querySelector('.phiship').innerHTML = ship2 + 'đ';
				document.querySelector('.phigiam').innerHTML = disc + 'đ';
				var totalc = sum + Number(ship2) - disc;
				document.querySelector('.tongtien').innerHTML = totalc + 'đ';
				document.querySelector('#Tong_Tien').value = totalc;
			}	
		}
		var tt = 1;
		document.querySelector("#PT_TT").value = tt;
	}

	function vdcsss() {
		var ship = 0;
		document.querySelector('.phiship').innerHTML = ship + 'đ';
		document.querySelector('.thanhtien').innerHTML = sum + 'đ';
		document.querySelector('.phigiam').innerHTML = disc + 'đ';
		var totalc = sum + ship - disc;
		document.querySelector('.tongtien').innerHTML = totalc + 'đ';
		document.querySelector('#Tong_Tien').value = totalc;
		var tt = sum + ship;
		document.querySelector('.ttt').value = tt;
		var cc = document.querySelector('.ttt').value;

		var idvc = document.querySelector("#Vc").value;
		for (let i = 0; i < acc.length; i++) {
			if(acc[i]['Ten_VC'] == idvc){
				disc = Number(cc)*acc[i]['Gia_KM']/100;
				var ship1 = document.querySelector('.phiship').innerHTML;
				var ship2 = ship1.slice(0, -1);
				document.querySelector('.thanhtien').innerHTML = sum + 'đ';
				document.querySelector('.phiship').innerHTML = ship2 + 'đ';
				document.querySelector('.phigiam').innerHTML = disc + 'đ';
				var totalc = sum + Number(ship2) - disc;
				document.querySelector('.tongtien').innerHTML = totalc + 'đ';
				document.querySelector('#Tong_Tien').value = totalc;
			}	
		}
		var tt = 1;
		document.querySelector("#PT_TT").value = tt;
	}
	var tt = sum + ship;
	document.querySelector('.ttt').value = tt;
	var cc = document.querySelector('.ttt').value;
	function myFunction() {
		var idvc = document.querySelector("#Vc").value;
		var idvc1 = idvc.toUpperCase();
		var cc = document.querySelector('.ttt').value;
		for (let i = 0; i < acc.length; i++) {
			var vc1 = acc[i]['Ten_VC'];
			var vc2 = vc1.toUpperCase();
			if(vc2 == idvc1){
				disc = Number(cc)*acc[i]['Gia_KM']/100;
				var ship1 = document.querySelector('.phiship').innerHTML;
				var ship2 = ship1.slice(0, -1);
				document.querySelector('.thanhtien').innerHTML = sum + 'đ';
				document.querySelector('.phiship').innerHTML = ship2 + 'đ';
				document.querySelector('.phigiam').innerHTML = disc + 'đ';
				var totalc = sum + Number(ship2) - disc;
				document.querySelector('.tongtien').innerHTML = totalc + 'đ';
				document.querySelector('#Tong_Tien').value = totalc;
			}	
		}
	}

	
</script>