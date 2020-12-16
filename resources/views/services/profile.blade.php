@extends('../layoutchild')
    @include('services.backG')
    <?php
        $quan = DB::table('Quan')->select('Id_Q', 'Ten_Quan')->distinct()->where('AnHien','=','1')->get();
    ?>
    <?php
        // Session::has('khachhang');
        $kh = DB::table('khachhang')->select('Id_KH', 'Ten_KH', 'DiaChi', 'DienThoai', 'Quan', 'Phuong')
        ->where('Id_KH', '=', Session::get('khachhang')['Id_KH'])->first();
    ?>
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card bg-black">
                    <div class="card-body">
                        <div class="mx-auto d-block">
                            <div class="vcard bio" >
                                <img src="images/user.png
                                {{-- {{ $ykien->urlHinh ?? 'user.png'}} --}}
                                " alt="Image placeholder">
                                <style>
                                    .vcard img {
                                        width: 91%;
                                        border-radius: 50%;
                                        margin-left: 14px;
                                    }
                                    .card-body{
                                        background-color: black;
                                    }
                                    .card{
                                        background-color: black !important;
                                    }
                                </style>
                              </div>
                            <h5 class="text-sm-center mt-3 mb-1" style="color:#c49b63">{{ $kh->Ten_KH }}</h5>
                            <div class="location text-sm-center">
                                <i class="fa fa-map-marker"></i> {{ $kh->DiaChi }}</div>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
            <div class="col-md-8   ftco-animate">
                <form action="/suahoso/{{Session::get('khachhang')['Id_KH']}}" method="POST" class="billing-form ftco-bg-dark p-3 p-md-5" id="form-1">
                    {{ csrf_field() }}
                        <h3 class="mb-4 billing-heading">Thông tin</h3>
                        <div class="row align-items-end">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Số Điện Thoại</label>
                                <input type="text" name="DienThoai" id="phone" value="{{ $kh->DienThoai }}" class="form-control" placeholder="">
                                <span class="form-message"></span>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="DiaChi" class="col-md-12 col-form-label ">{{ __('Dia Chi') }}</label>

                                <div class="col-md-12">
                                    <input id="DiaChi" type="text" class="form-control" name="DiaChi" value="{{ $kh->DiaChi}}" required autocomplete="new-DiaChi">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="Quan" class="col-md-12 col-form-label ">{{ __('Quan') }}</label>

                                <div class="col-md-12">
                                    <!-- <input id="Quan" type="text" class="form-control" name="Quan" required autocomplete="new-Quan"> -->
                                    
                                    <select name="Quan" id="Quan" class="form-control">
                                        <?php
                                            $quan1 = DB::table('quan')->select('Id_Q', 'Ten_Quan')->where('Id_Q', '=', $kh->Quan)->first();
                                        ?>
                                        <option  value="{{ $kh->Quan }}">{{ $quan1->Ten_Quan }}</option> 
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
                                    <?php
                                        $phuong = DB::table('phuong')->select('Id_P', 'Ten_Phuong')->where('Id_P', '=', $kh->Phuong)->first();
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="Phuong" class="col-md-12 col-form-label ">{{ __('Phuong') }}</label>
                                    <div class="col-md-12">
                                        <select name="Phuong" id="Phuong"  class="form-control">
                                            <option value="{{ $kh->Phuong }}" id="0" value="0">{{ $phuong->Ten_Phuong }}</option>
                                        </select>
                                    
                                    </div>
                            </div>
                        </div>
                            <div class="w-100"></div>
                        </div>
                        <button type="submit" class="btn btn-primary py-3 px-4">Chỉnh sửa</button>
                </form><!-- END -->
            </div>
        </div>
        <div class="row justify-content-center mt-5 mb-3">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <span class="subheading" style="margin-bottom: 15px">Điểm Tích Được</span>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="rewards_new_list_rank">
                    <div class="rewards_new_header_tab ">
                        <ul class="display_flex flex_wrap">
                            <li class=" flex-auto rewards_new_header_tab_item" style="border-bottom: 12px solid #f0b879">
                                <a data-toggle="tab" href="#tab-1">
                                    <span class="rewards_new_header_tab_item_icon"><img src="https://file.hstatic.net/1000075078/file/bean-01_58813161f2b740588a4f7d378c2dad6d.png" alt="Thành Viên Mới"></span>
                                    <span class="rewards_new_header_tab_item_title">Thành Viên Mới</span>
                                    <span class="rewards_new_header_tab_item_point">0 Bean</span></a>
                            </li>
                            <li class=" flex-auto rewards_new_header_tab_item" style="border-bottom: 12px solid #94651e">
                                <a data-toggle="tab" href="#tab-2">
                                    <span class="rewards_new_header_tab_item_icon"><img src="https://file.hstatic.net/1000075078/file/bean-02_7c5a1919e27c4ca7aa1eedf34f1b1d94.png" alt="Thành Viên Đồng"></span>
                                    <span class="rewards_new_header_tab_item_title">Thành Viên Đồng</span>
                                    <span class="rewards_new_header_tab_item_point">100 Bean</span></a>
                            </li>
                            <li class=" flex-auto rewards_new_header_tab_item" style="border-bottom: 12px solid #ededed">
                                <a data-toggle="tab" href="#tab-3">
                                    <span class="rewards_new_header_tab_item_icon"><img src="https://file.hstatic.net/1000075078/file/bean-03_3f5e99d8d7b8478b9e6995774341cd52.png" alt="Thành Viên Bạc"></span>
                                    <span class="rewards_new_header_tab_item_title">Thành Viên Bạc</span>
                                    <span class="rewards_new_header_tab_item_point">200 Bean</span></a>
                            </li>
                            <li class=" flex-auto rewards_new_header_tab_item" style="border-bottom: 12px solid #f2c446">
                                <a data-toggle="tab" href="#tab-4">
                                    <span class="rewards_new_header_tab_item_icon"><img src="https://file.hstatic.net/1000075078/file/bean-04_fdcc7f951e9f4bda8a9634da152a5644.png" alt="Thành Viên Vàng"></span>
                                    <span class="rewards_new_header_tab_item_title">Thành Viên Vàng</span>
                                    <span class="rewards_new_header_tab_item_point">500 Bean</span></a>
                            </li>
                            <li class="active flex-auto rewards_new_header_tab_item" style="border-bottom: 12px solid #ed8626">
                                <a data-toggle="tab" href="#tab-5">
                                    <span class="rewards_new_header_tab_item_icon"><img src="https://file.hstatic.net/1000075078/file/bean-05_c90cf6fc5baf430ba23efd48f2362db4.png" alt="Thành Viên Kim Cương"></span>
                                    <span class="rewards_new_header_tab_item_title">Thành Viên Kim Cương</span>
                                    <span class="rewards_new_header_tab_item_point">3000 Bean</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <span class="rewards_new_header_tab_item_point">Điểm Tích Được :</span></a>
                <?php
                    $diemtich = (Session::get('khachhang')['Tich_diem'] / 1000)/3000 * 100;
                ?>
                <div class="progress">
                    <div id="ctc" class="progress-bar" role="progressbar" style="width: {{ $diemtich }}%" aria-valuenow="{{ $diemtich }}" aria-valuemin="0" aria-valuemax="3000"></div>
                </div>
                <script>
                    var diemtich = {{ $diemtich }}
                    if (diemtich < 100) {
                        document.getElementById("ctc").className = "bg-warning";
                    } else if(diemtich >= 100) {
                        document.getElementById("ctc").className = "bg-nau";
                    } else if(diemtich >= 200){
                        document.getElementById("ctc").className = "bg-w";
                    } else if(diemtich >= 500){
                        document.getElementById("ctc").className = "bg-yl";
                    }else{
                        document.getElementById("ctc").className = "bg-or";
                    }
                </script>
            </div>
        </div>
    </div>
</section>
<style>
    .bg-warning{
        background-color: #f0b879 !important;
    }
    .bg-nau{
        background-color: #94651e;
    }
    .bg-w{
        background-color: #ededed;
    }
    .bg-yl{
        background-color: #f2c446;
    }
    .bg-or{
        background-color: #ed8626;
    }
</style>
@include('bill')