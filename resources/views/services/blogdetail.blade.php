@extends('layoutchild')
  @include('services.backG')
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<section class="ftco-section">
      <div class="container">
        <div class="row">
          <div class="col-md-8 ftco-animate">
            <h2 class="mb-3">{{ $tintuc->Tieu_De }}</h2>
            {{-- Chuyển thành dạng Html {{}} -> {!! !!} --}}
            {!! $tintuc->ND_dai !!}
            <div class="tag-widget post-tag-container mb-5 mt-5">
              <div class="tagcloud">
                <?php
                  $ttt = DB::table('tt_to_tag')->select('Id_Tag', 'Id_TT')->where("Id_TT", '=' , $tintuc->Id_TT)->get();
                ?>
                @foreach ($ttt as $tag)
                  <?php
                    $tags = DB::table('tags')->select('Id_Tag', 'Ten_Tag')->where('Id_Tag', '=', $tag->Id_Tag)->get();
                  ?>
                  @foreach ($tags as $t)
                    <a href="#" class="tag-cloud-link">{{ $t->Ten_Tag }}</a>
                  @endforeach  
                @endforeach
                
                <a href="#" class="tag-cloud-link">{{ $tintuc->Tags ?? '' }}</a>
              </div>
            </div>

            <div class="pt-5 mt-5">
              <h3 class="mb-5">Bình luận</h3>
              <ul class="comment-list" >
                <form>
                  @csrf
                  <div id="comment_show">
                      @foreach ($binhluan as $cm)
                        <?php
                            $nv = DB::table('khachhang')->select('Id_KH', 'Ten_KH')
                            ->where('Id_KH','=',$cm->Id_KH)->first();
                        ?>
                        <li class="comment">
                          <div class="vcard bio" >
                              <img src="images/user.png" alt="Image placeholder">
                          </div>
                          
                          <div class="comment-body" >
                              <h3 id="tenkh">{{$nv->Ten_KH}}</h3>
                              <div class="meta">{{$cm->updated_at}}</div>
                              <p>{{$cm->Noi_Dung}}</p>
                          </div>
                        </li>
                      @endforeach
                  </div>
                </form>
              
              <!-- END comment-list -->
              @if(Session::has('khachhang'))
              <div class="comment-form-wrap pt-5">
                <h3 class="mb-5">Phần bình luận</h3>
                <form id="comment">
                  @csrf
                    <div class="form-group">
                      <label for="name">Nội dung</label>
                      <input type="text" name="Noi_Dung" id="Noi_Dung" class="form-control">
                    </div>
                    
                    <div class="form-group" style="display: none">
                      <input type="text" name="ThuTu" id="ThuTu" value="1">
                      <input type="text" name="AnHien" id="AnHien" value="1">
                      <input type="text" name="Id_KH" id="Id_KH" value="{{ Session::get('khachhang')['Id_KH'] }}">
                      <input type="text" name="Id_TT" id="Id_TT" value="{{ $tintuc->Id_TT }}">
                      <input type="text" id="TT_TB" id="TT_TB" value="1">
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn py-3 px-4 btn-primary">Post Comment</button>
                    </div>
                </form>
                <script>
                  $('#comment').submit(function (e) { 
                    let ThuTu = $('#ThuTu').val();
                    let AnHien = $('#AnHien').val();
                    let Id_TT = $('#Id_TT').val();
                    let Id_KH = $('#Id_KH').val();
                    let Noi_Dung = $('#Noi_Dung').val();
                    let TT_TB = $('#TT_TB').val();
                    e.preventDefault();
                      $.ajax({
                        type: "POST",
                        url: "{{route('cm.add')}}",
                        data: {
                          "_token": "{{ csrf_token() }}",
                          Id_TT:Id_TT,
                          Noi_Dung:Noi_Dung,
                          AnHien: AnHien,
                          ThuTu: ThuTu,
                          Id_KH: Id_KH,
                          TT_TB: TT_TB,
                        },
                        success: function (response) {
                          if(response){
                            $('#comment_show').prepend('<li class="comment"> <div class="vcard bio"><img src="images/user.png" alt="Image placeholder"></div><div class="comment-body" ><h3>{{$nv->Ten_KH}}</h3><div class="meta">{{$cm->updated_at}}</div><p>{{$cm->Noi_Dung}}</p></div></li>');
                            alertify.success('Bình luận đã được thêm');
                          }
                        }
                      });
                  }); 
                </script>
              </div>
            </div>
            @else
              <div class="comment-form-wrap pt-5">
                <h3 class="mb-5">Phần bình luận</h3>
                <h5 class="ml-4 red">Cần 
                <a href="{{ url('/dang-nhap') }}" class="active">Đăng Nhập</a>  
                  Để Bình Luận</h5>
              </div>
            </div>
            @endif
          </div> <!-- .col-md-8 -->
          <div class="col-md-4 sidebar ftco-animate">
            <div class="sidebar-box">
              <form action="#" class="search-form">
                <div class="form-group">
                	<div class="icon">
	                  <span class="icon-search"></span>
                  </div>
                  <input type="text" class="form-control" placeholder="Search...">
                </div>
              </form>
            </div>
            @include('danhmuc')

            @include('blogchild')

            @include('tags')

            <div class="sidebar-box ftco-animate">
              <h3>Paragraph</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus itaque, autem necessitatibus voluptate quod mollitia delectus aut, sunt placeat nam vero culpa sapiente consectetur similique, inventore eos fugit cupiditate numquam!</p>
            </div>
          </div>

        </div>
      </div>
      
      
    </section>
<style>
  .t{
    margin-top: 0.9rem !important;
  }
</style>
