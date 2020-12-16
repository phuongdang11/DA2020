<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sanpham;
class CtController extends Controller
{
    function index(Request $request)
    {
        $cartitem = \Cart::session($request->session()->get('khachhang')['Id_KH'])->getContent();
        return view('cartchild', compact('cartitem'));
    }

    function addcart(Request $request)
    {
        $sp = sanpham::find($request->id);
        $userID = $request->session()->get('khachhang')['Id_KH'];
        $cart = \Cart::session($userID)->add(array(
            'id' => $sp->Id_SP,
            'name' => $sp->Ten_SP,
            'price' => $sp->Gia,
            'quantity' => 1,
            
        ));
        $cartitem = \Cart::session($request->session()->get('khachhang')['Id_KH'])->getContent();
        return view('cartchild', compact('cartitem'));
    }

    function addcartdt(Request $request)
    {
        $sp = sanpham::find($request->id);
        $userID = $request->session()->get('khachhang')['Id_KH'];
        $cart = \Cart::session($userID)->add(array(
            'id' => $sp->Id_SP,
            'name' => $sp->Ten_SP,
            'price' => $sp->Gia,
            'quantity' => request('quantity'),
        ));
        $cartitem = \Cart::session($request->session()->get('khachhang')['Id_KH'])->getContent();
        return view('cartchild', compact('cartitem'));
    }

    function upCart(Request $request,$id){
        $userID = $request->session()->get('khachhang')['Id_KH'];
        \Cart::session($userID)->update($id, [
            'quantity' => array(
                'relative' => false,
                'value' => request('quantity'),
            ),
        ]);
        $cartitem = \Cart::session($request->session()->get('khachhang')['Id_KH'])->getContent();
        return view('cartchild', compact('cartitem'));
    }

    function deleteCart(Request $request, $id)
    {
        $cartdel = \Cart::session($request->session()->get('khachhang')['Id_KH'])->remove($id);
        $cartitem = \Cart::session($request->session()->get('khachhang')['Id_KH'])->getContent();
        return view('cartchild', compact('cartitem'));
    }
}
