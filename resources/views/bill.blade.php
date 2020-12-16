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
			<div class="col-lg-12">
                <div class="card">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
                                
                                Chờ xử lý
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
                                
                                Đã thanh toán
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="card-body card-block">
                                <?php 
                                    $hd1 = DB::table('hoadon')->select('Id_KH', 'Id_HD', 'Ngay_Dang', 'PT_TT', 'Tong_Tien','TrangThai')->where('Id_KH', '=', Session::get('khachhang')['Id_KH'])->where('TrangThai', '=', 1)->get();    
                                ?>
                                    <div class="">
                                        <table id="myTable" class="table table-borderless table-striped table-earning">
                                            <thead>
                                                <tr>
                                                    <th>Mã</th>
                                                    <th>Ngày</th>
                                                    <th>Tổng tiền</th>
                                                    <th>Thanh toán</th>
                                                    <th>Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($hd1 as $cc)
                                                    <tr>
                                                        <td>{{ $cc->Id_HD }}</td>
                                                        <td>{{ $cc->Ngay_Dang }}</td>
                                                        <td>{{ number_format($cc->Tong_Tien) }}Đ</td>
                                                        @if ($cc->PT_TT == 1)
                                                            <td>Trực tiếp</td>
                                                        @elseif($cc->PT_TT == 1)
                                                            <td>Chuyển khoản</td>
                                                        @else
                                                            <td>Ví điện tử</td>
                                                        @endif
                                                        <td class="td-actions">
                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Chi Tiết</button>

                                                            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                    ...
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                            </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="card-body card-block">
                            <?php 
                                $hd2 = DB::table('hoadon')->select('Id_KH', 'Id_HD', 'Ngay_Dang', 'PT_TT', 'Tong_Tien','TrangThai')->where('Id_KH', '=', Session::get('khachhang')['Id_KH'])->where('TrangThai', '=', 2)->get();    
                            ?>
                            <div class="">
                                <table id="myTable" class="table table-borderless table-striped table-earning">
                                    <thead>
                                        <tr>
                                            <th>Mã</th>
                                            <th>Ngày</th>
                                            <th>Tổng tiền</th>
                                            <th>Thanh toán</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($hd2 as $cc)
                                            <tr>
                                                <td>{{ $cc->Id_HD }}</td>
                                                <td>{{ $cc->Ngay_Dang }}</td>
                                                <td>{{ number_format($cc->Tong_Tien) }}Đ</td>
                                                @if ($cc->PT_TT == 1)
                                                    <td>Trực tiếp</td>
                                                @elseif($cc->PT_TT == 1)
                                                    <td>Chuyển khoản</td>
                                                @else
                                                    <td>Ví điện tử</td>
                                                @endif
                                                <td class="td-actions">
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Chi Tiết</button>

                                                    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">SẢN PHẨM</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                      <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                  </div>
                                                                <table id="myTable" class="table-borderless table-striped table-earning">
                                                                    <thead >
                                                                        <th>Mã</th>
                                                                        <th>Tên loại</th>
                                                                        <th>Số Lượng</th>
                                                                        <th>Phí</th>
                                                                        <th>Giá</th>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                            $sp = DB::table('chitiethoadon')->select('Id_CT', 'Id_SP', 'Ten_SP', 'So_Luong','Id_Hd')->where('Id_Hd', '=', $cc->Id_HD)->get();    
                                                                        ?>
                                                                        @foreach ($sp as $item)
                                                                            <tr>
                                                                                <td>{{ $item->Id_CT }}</td>
                                                                                <td>{{ $item->Ten_SP }}</td>
                                                                                <td>{{ $item->So_Luong }}</td>
                                                                                @if ($cc->PT_TT == 1)
                                                                                    <td>30,000Đ</td>
                                                                                @elseif($cc->PT_TT == 1)
                                                                                    <td>10,000Đ</td>
                                                                                @else
                                                                                    <td>0Đ</td>
                                                                                @endif
                                                                                <?php
                                                                                    $ctsp = DB::table('sanpham')->select('Gia', 'Id_SP')->where('Id_SP', '=', $item->Id_SP)->first();
                                                                                ?>
                                                                                <td>{{ number_format($ctsp->Gia) }}Đ</td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
		</div>
    </div>
</section>
<style>
    .mt-150{
        margin-top: 100px;
    }
    button.au-btn.au-btn-icon.au-btn--blue {
        margin-bottom: 20px;
    }
    .chua{
        width: 100%;
        float: left;
    }
    .card{
        background-color: unset !important;
    }
    .card-body {
        background-color: unset;
    }
    .chua .form-header {
        float: left;
        margin-right: 30px;
    }
    td img {
        width: 45px;
        height: 45px;
    }
    .td-actions .btn.btn-primary {
        background: unset !important;
        border: 1px solid #c49b63;
        color: #c49b63 !important;
    }
    thead th{
        text-align: center;
    }
</style>