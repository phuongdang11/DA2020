owl-carousel
$('#dmm').submit(function (e) { 
    e.preventDefault();

    let Ten_SP1 = $('#Ten_SP1').val();
    let Id_SP1= $('#Id_SP1').val();
    let So_Luong1 = $('#So_Luong1').val();
    let Id_KH1 = $('#Id_KH1').val();
    let AnHien1 = $('#AnHien1').val();
    let ThuTu1 = $('#ThuTu1').val();
    let _token1 = $("input[name=_token]").val();

    $.ajax({
        type: "POST",
        url: "{{route('cart.add')}}",
        data: {
            Ten_SP:Ten_SP1,
            Id_SP:Id_SP1,
            So_Luong:So_Luong1,
            Id_KH:Id_KH1,
            AnHien:AnHien1,
            ThuTu:ThuTu1,
            _token:_token1,
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
$("updateform-{{ $showsp->Id_SP }}").submit(function (e) { 
														e.preventDefault();
														let Id_GH = $("#id").val();
														let So_Luong = $('#So_Luong1-{{ $showsp->Id_SP }}').val();
														let _token = $("input[name=_token]").val();

														$.ajax({
															url: "{{route('cart.ud')}}",
															type: "POST",
															data: {
																So_Luong:So_Luong,
																_token:_token,
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

        function AddCart1(){
		$('#cartform1').ready(function (e) { 
			e.preventDefault();

			let Ten_SP = $('#Ten_SP1').val();
			let Id_SP = $('#Id_SP1').val();
			let So_Luong = $('#So_Luong1').val();
			let Id_KH = $('#Id_KH1').val();
			let AnHien = $('#AnHien1').val();
			let ThuTu = $('#ThuTu1').val();
			let _token = $("input[name1=_token]").val();

			$.ajax({
				type: "POST",
				url: "{{route('cart.add')}}",
				data: {
					Ten_SP:Ten_SP,
					Id_SP:Id_SP,
					So_Luong:So_Luong,
					Id_KH:Id_KH,
					AnHien:AnHien,
					ThuTu:ThuTu,
					_token:_token,
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
	}
</script>
$('#comment_show').prepend('<li class="comment"> <div class="vcard bio"><img src="images/user.png" alt="Image placeholder"></div><div class="comment-body" ><h3>{{$nv->Ten_KH}}</h3><div class="meta">{{$cm->updated_at}}</div><p>{{$cm->Noi_Dung}}</p></div></li>');