<div class="pt-5 mt-5">
  <h3 class="mb-5">Bình luận</h3>
  <ul class="comment-list">
  @foreach($binhluan as $ykien)
    <?php
        $nv = DB::table('khachhang')->select('Id_KH', 'Ten_KH')
        ->where('Id_KH','=',$ykien->Id_KH)->first();
    ?>
    <li class="comment" id="binhluanTable">
      <div class="vcard bio" >
        <img src="images/user.png
        {{-- {{ $ykien->urlHinh ?? 'user.png'}} --}}
        " alt="Image placeholder">
      </div>
      
      <div class="comment-body">
        <h3>{{ $nv->Ten_KH }}</h3>
        <div class="meta">{{ $ykien->updated_at }}</div>
          <p>{{ $ykien->Noi_Dung }}</p>
        @if(Session::has('khachhang') && (Session::get('khachhang')['Id_KH'] == $ykien->Id_KH))
          <button type="submit" value="{{ $ykien->Id_BL }}" name="edit" class="btn btn-primary reply" data-toggle="modal" data-target="#{{ $ykien->Id_BL }}" data-whatever="@mdo">Sửa</button>
          <a href="dl/{{ $ykien->Id_BL }}" onclick="return confirm('Bạn có chắc muốn xóa ?');" class="reply">Xóa</a>
        @else
          
        @endif
        <div class='modal fade' id='{{ $ykien->Id_BL }}' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
          <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='exampleModalLabel'>Sửa Bình Luận</h5>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </div>
                <div class='modal-body' >
                  <form action="capnhat/{{ $ykien->Id_BL }}" method="POST">
                    {{ csrf_field() }}
                    <div class='form-group'>
                      <label for='message-text' class='col-form-label'>Nội Dung :</label>
                       <input class='form-control' name='Noi_Dung' value='{{ $ykien->Noi_Dung }}' id='message-text'>
                     </div>
                      <div class='modal-footer'>
                       <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                      <button type='submit' class='btn btn-primary'>Cập nhật</button>
                      </div>
                  </form>
                </div>
              </div>
          </div>
        </div>
      </div>
    </li>
    
  @endforeach
  <!-- END comment-list -->
  @if(Session::has('khachhang'))
  <div class="comment-form-wrap pt-5">
    <h3 class="mb-5">Phần bình luận</h3>
    <form id="binhluan">
      {{ csrf_field() }}
        <div class="form-group">
          <label for="name">Nội dung</label>
          <input type="text" id="Noi_Dung" name="Noi_Dung" class="form-control">
        </div>
        
        <div class="form-group" style="display: none">
          <input type="text" id="ThuTu" name="ThuTu" value="1">
          <input type="text" id="AnHien" name="AnHien" value="1">
          <input type="text" id="Id_KH" name="Id_KH" value="{{ Session::get('khachhang')['Id_KH'] }}">
          <input type="text" id="Id_TT" name="Id_TT" value="{{ $tintuc->Id_TT }}">
          <input type="text" id="TT_TB" value="1">
        </div>
        <div class="form-group">
          <button type="submit" class="btn py-3 px-4 btn-primary">Post Comment</button>
        </div>
    </form>
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