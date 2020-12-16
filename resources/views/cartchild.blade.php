<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
{{-- <div id="change-item-cart">
    <table class="carts">
        <thead>
            <tr>
                <th></th>
                <th>Tên</th>
                <th>Số Ly</th>
                <th>Giá</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cartitem as $cart)
                <?php
                    $sp = DB::table('sanpham')->select('Id_SP', 'urlHinh1')->where('Id_SP', '=' ,$cart->id)->first();
                ?>
                <tr id="sid{{ $cart->id }}">
                    <td><img width="70px" height="70px" class="mt-3 mb-3 c" src="./images/{{$sp->urlHinh1}}" alt=""></td>
                    <td>{{$cart->name}}</td>
                    <td>{{$cart->quantity}}</td>
                    <td class="totals">{{ number_format($cart->price) }}đ</td>
                    <td class="product-remove dl"><a href="javascript:" onclick="deleteCart({{$cart->id}})"><span class="icon-close"></span></a></td>
                </tr>
            @endforeach
        </tbody>
        <tbody class="bd2">
            <tr>
                <th class="ml-2 mt-3 mb-3">Tổng tiền:</th>
                <th></th>
                <th></th>
                <th></th>
                <th class="tien">{{number_format(\Cart::getSubTotal())}}đ</th>
            </tr>
        </tbody>
    </table>
</div> --}}
<li class="nav-item cart" id="change-item-cart">
    <a href="{{ url('/gio-hang') }}" class="nav-link">
        <span class="icon icon-shopping_cart"></span>
        <span class="bag d-flex justify-content-center align-items-center">
            <small id="slgh">{{$cartitem->count()}}</small>
        </span>
    </a>
    <div class="khung">
        <div >
            <table class="carts">
                <thead>
                    <tr>
                        <th></th>
                        <th>Tên</th>
                        <th>Số Ly</th>
                        <th>Giá</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cartitem as $cart)
                        <?php
                            $sp = DB::table('sanpham')->select('Id_SP', 'urlHinh1')->where('Id_SP', '=' ,$cart->id)->first();
                        ?>
                        <tr id="sid{{ $cart->id }}">
                            <td><img width="70px" height="70px" class="mt-3 mb-3 c" src="./images/{{$sp->urlHinh1}}" alt=""></td>
                            <td>{{$cart->name}}</td>
                            <td>{{$cart->quantity}}</td>
                            <td class="totals">{{ number_format($cart->price) }}đ</td>
                            <td class="product-remove dl"><a href="javascript:" onclick="deleteCart({{$cart->id}})"><span class="icon-close"></span></a></td>
                        </tr>
                    @endforeach
                </tbody>
                <tbody class="bd2">
                    <tr>
                        <th class="ml-2 mt-3 mb-3">Tổng tiền:</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th class="tien">{{number_format(\Cart::getSubTotal())}}đ</th>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="but ml-2 mr-2 mt-2 mb-2">
            <a type="submit" href="/thanh-toan" class="btn btn-primary">Thanh toán</a>
        </div>
    </div>
</li>
<script>
    function deleteCart(id) {
        $.ajax({
            type: "GET",
            url: "/del/" + id,
            data: {
                _token : $("input[name=_token]").val()
            },
            success: function (response) {
                $("#sid"+id).remove();
                $("#change-item-cart").html(response);
                alertify.error('Sản phẩm đã được xóa');
            }
        });
    }
</script>