@extends('quantri.layoutquantri')
@section('pagetitle', 'CHI TIẾT HÓA ĐƠN')    
@section('main')
@if(session()->get('msg'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session()->get('msg') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                {{ Session::forget('msg') }}
            </button>
        </div>
@endif
<div class="col-lg-12 col-md-12">
    <h3 class="text-center mb-3">Thông tin khách hàng</h3>
    <div class="table-responsive table--no-card m-b-30">
        <table id="myTable" class="table table-borderless table-striped table-earning">
            <thead class="text-warning">
                <th>Tên khách hàng</th>
                <th>Điện thoại</th>
                <th>Địa chỉ</th>
                <th>Quận</th>
                <th>Phường</th>
                <th>Voucher</th>
                <th>Trạng Thái</th>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $hoadon->Ten_KH }}</td>
                    <td>{{ $hoadon->DienThoai }}</td>
                    <td>{{ $hoadon->DiaChi }}</td>
                    <?php $quan = DB::Table('Quan')->where('Id_Q', '=', $hoadon->Quan)->first();?>
                    <td>{{ $quan->Ten_Quan }}</td>
                    <td>{{ $hoadon->Phuong }}</td>
                    <td>{{ $hoadon->Voucher }}</td>
                    @if ($hoadon->TrangThai == 1)
                        <td style="color: red">Chờ xử lý</td>
                    @else
                        <td style="color: rgb(62, 241, 62)">Đã thanh toán</td>
                    @endif
                </tr>
            </tbody>
        </table>
    </div>
    <h3 class="text-center mb-3">Sản phẩm đã đặt</h3>
    <div class="table-responsive table--no-card m-b-30">
        <table id="myTable" class="table table-borderless table-striped table-earning">
            <thead class="text-warning">
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Hành động</th>
            </thead>
            <?php
                $cthd = DB::table('chitiethoadon')->select('Id_CT', 'Ten_SP', 'Id_SP', 'So_Luong')->where('Id_HD', '=', $hoadon->Id_HD)->get();
            ?>
            <tbody>
                @foreach ($cthd as $c)
                    <tr>
                        <td>{{ $c->Id_CT }}</td>
                        <td>{{ $c->Ten_SP }}</td>
                        <?php
                            $sp = DB::table('sanpham')->select('Id_SP', 'Gia')->where('Id_SP', '=', $c->Id_SP)->first();
                            $giatien = $sp->Gia * $c->So_Luong;
                        ?>
                        <td>{{ $giatien }}</td>
                        <td>{{ $c->So_Luong }}</td>
                        <td class="td-actions">
                            <form action="detail/{{$c->Id_CT}}" method="GET" class="btn btn-link btn-sm">
                                {{  csrf_field() }}
                                {!! method_field('delete') !!}
                                <button onclick="return confirm('Bạn có chắc muốn xóa ?');"  class="btn btn-danger btn-link btn-sm">
                                    <i class="material-icons">Xóa</i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row justify-content-end">
        <div class="col col-lg-3 col-md-6 mt-2 cart-wrap ftco-animate">
            <div class="cart-total mb-3 text-right">
                <p class=" total-price">
                    <span>Total: </span>
                    <span class="tong-tien ml-4"> {{ $hoadon->Tong_Tien }}Đ</span>
                </p>
            </div>
        </div>
    </div>
    <hr>
</div>


@endsection