@if(session()->get('msg'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session()->get('msg') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                {{ Session::forget('msg') }}
            </button>
        </div>
@endif 
<div class="col-lg-12">
    <div class="chua">
        <form class="form-header" action="" method="GET">
            <input class="au-input au-input--xl" id="myInput" onkeyup="myFunction()" type="text" name="query" placeholder="Tìm tên sản phẩm ..." />
            <button class="au-btn--submit" type="submit">
                <i class="zmdi zmdi-search"></i>
            </button>
        </form>

        <button class="au-btn au-btn-icon au-btn--blue ">
        <a href="{{ route('hoadon.create')}}" style="color: white;"><i class="zmdi zmdi-plus"></i>Thêm hóa đơn</a></button>
    </div>
    <div class="card">
        <div class="card-header">
            Hóa đơn
            <small>
                <code>*</code>
            </small>
        </div>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
                    <i class="fas fa-gear"></i>
                    Chờ xử lý
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
                    <i class="fas  fa-check"></i>
                    Đã thanh toán
                </a>
            </li>
            <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Khác</a>
            </li>
        </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="card-body card-block">
                        <?php 
                            $hd1 = DB::table('hoadon')->select('Id_KH', 'Id_HD', 'Ngay_Dang', 'PT_TT', 'Tong_Tien','TrangThai')->where('TrangThai', '=', 1)->get();    
                        ?>
                            <div class="table-responsive table--no-card m-b-30">
                                <table id="myTable" class="table table-borderless table-striped table-earning">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Ngày</th>
                                            <th>Tổng tiền</th>
                                            <th>PT_Thanh toán</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    @foreach($hd1 as $cc)
                                    <tbody>
                                        <tr>
                                            <td>{{ $cc->Id_HD }}</td>
                                            <td>{{ $cc->Ngay_Dang }}</td>
                                            <td>{{ $cc->Tong_Tien }}</td>
                                            @if ($cc->PT_TT == 1)
                                                <td>Trực tiếp</td>
                                            @elseif($cc->PT_TT == 1)
                                                <td>Chuyển khoản</td>
                                            @else
                                                <td>Ví điện tử</td>
                                            @endif
                                            <td class="td-actions">
                                                <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                                                    <a href="/hoadon/{{$cc->Id_HD}}/detail"><i class="material-icons">Xem</i></a>
                                                </button>
                                              
                                                <form action="{{route('hoadon.destroy',$cc->Id_HD)}}" method="post" class="btn btn-link btn-sm">
                                                    {{  csrf_field() }}
                                                    {!! method_field('delete') !!}
                                                    <button onclick="return confirm('Bạn có chắc muốn xóa ?');"  class="btn btn-danger btn-link btn-sm">
                                                        <i class="material-icons">Xóa</i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    </tbody>
                                    @endforeach
                                </table>
                            </div>
                    </div>
                </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="card-body card-block">
                    <?php 
                        $hd2 = DB::table('hoadon')->select('Id_KH', 'Id_HD', 'Ngay_Dang', 'PT_TT', 'Tong_Tien','TrangThai')->where('TrangThai', '=', 2)->get();    
                    ?>
                        <div class="table-responsive table--no-card m-b-30">
                            <table id="myTable" class="table table-borderless table-striped table-earning">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Ngày</th>
                                        <th>Tổng tiền</th>
                                        <th>PT_Thanh toán</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                @foreach($hd2 as $cc)
                                <tbody>
                                    <tr>
                                        <td>{{ $cc->Id_HD }}</td>
                                        <td>{{ $cc->Ngay_Dang }}</td>
                                        <td>{{ $cc->Tong_Tien }}</td>
                                        @if ($cc->PT_TT == 1)
                                            <td>Trực tiếp</td>
                                        @elseif($cc->PT_TT == 1)
                                            <td>Chuyển khoản</td>
                                        @else
                                            <td>Ví điện tử</td>
                                        @endif
                                        <td class="td-actions">
                                            <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                                                <a href="/hoadon/{{$cc->Id_HD}}/detail"><i class="material-icons">Xem</i></a>
                                            </button>
                                            
                                            <form action="{{route('hoadon.destroy',$cc->Id_HD)}}" method="post" class="btn btn-link btn-sm">
                                                {{  csrf_field() }}
                                                {!! method_field('delete') !!}
                                                <button onclick="return confirm('Bạn có chắc muốn xóa ?');"  class="btn btn-danger btn-link btn-sm">
                                                    <i class="material-icons">Xóa</i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                </div>
            </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
            </div>
        </form>
    </div>
</div>
<script>
    function myFunction() {
      // Declare variables
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");
    
      // Loop through all table rows, and hide those who don't match the search query
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }
</script>
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

    .chua .form-header {
        float: left;
        margin-right: 30px;
    }
    td img {
        width: 45px;
        height: 45px;
    }
</style>