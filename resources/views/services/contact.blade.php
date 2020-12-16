@extends('../layoutchild')
@include('services.backG')
<section class="ftco-section contact-section" style="    background-image: url(../images/vector.png);
    background-size: cover;
    background-repeat: no-repeat;">
	<h2 style="text-align: center">Liên hệ ngay để được tư vấn </h2>

	<div class="container mt-5">
		<div class="row block-9">
			<div class="col-md-4 contact-info ftco-animate">
				<div class="row">
					<div class="col-md-12 mb-4">
						<h2 class="h4">Thông tin cá nhân</h2>
					</div>
					<div class="col-md-12 mb-3">
						<p><span>Địa chỉ:</span> 40 Chu Thiên, P. Hiệp Tân, Q.Tân Phú</p>
					</div>
					<div class="col-md-12 mb-3">
						<p><span>Số điện thoại :</span> <a href="tel://1234567920">070 8565 9621 </a></p>
					</div>
					<div class="col-md-12 mb-3">
						<p><span>Email:</span> <a href="mailto:info@yoursite.com">phuong@gmail.com</a></p>
					</div>
					<div class="col-md-12 mb-3">
						<p><span>Website:</span> <a href="https://burncoffee.online">burncoffee.online</a></p>
					</div>
				</div>
			</div>
			<div class="col-md-1"></div>
			<div class="col-md-6 ftco-animate">
				<form action="#" class="contact-form">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Họ và tên">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Địa chỉ Email">
							</div>
						</div>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Tiêu đề">
					</div>
					<div class="form-group">
						<textarea name="" id="" cols="30" rows="7" class="form-control" placeholder="Nội dung"></textarea>
					</div>
					<div class="form-group">
						<input type="submit" value="Gửi" class="btn btn-primary py-3 px-5">
					</div>
				</form>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.4445190146453!2d106.62615621462332!3d10.853755692269115!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752bee0b0ef9e5%3A0x5b4da59e47aa97a8!2zQ8O0bmcgVmnDqm4gUGjhuqduIE3hu4FtIFF1YW5nIFRydW5n!5e0!3m2!1svi!2s!4v1607926796832!5m2!1svi!2s" width="100%" height="400px" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
			</div>
		</div>
	</div>
</section>