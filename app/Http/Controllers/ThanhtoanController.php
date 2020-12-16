<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HoaDon;
use App\Models\GioHang;
use App\Models\ChiTietHoaDon;
class ThanhtoanController extends Controller
{
    function index(){
        $d=array('title'=>'Thanh toán');
        return view("services.checkout", $d);
    }
    public function thanhtoan(Request $request, $id){
        
        $hd = new hoadon([
            'Ngay_Dang' => $request->get('Ngay_Dang'),
            'Tong_Tien' => $request->get('Tong_Tien'),
            'DiaChi' => $request->get('DiaChi'),
            'DienThoai' => $request->get('DienThoai'),
            'Quan' => $request->get('Quan'),
            'Phuong' => $request->get('Phuong'),
            'Ten_KH' => $request->get('Ten_KH'),
            'AnHien' => $request->get('AnHien'),
            'PT_TT' => $request->get('PT_TT'),
            'ThuTu' => $request->get('ThuTu'),
            'Voucher' => $request->get('Voucher'),
            'TrangThai' => $request->get('TrangThai'),
            'Id_KH' => $request->get('Id_KH'),
        ]);
        $hd->save();
    
        $cartitem = \Cart::session($request->session()->get('khachhang')['Id_KH'])->getContent();
        
        foreach ($cartitem as $key => $c) { 
            $cthd = new chitiethoadon([
                'Id_SP' => $c->id,
                'Ten_SP' => $c->name,
                'So_Luong' => $c->quantity,
                'Id_HD' => $hd->Id_HD,
            ]);
            $cthd->save();
            $dcart = \Cart::session($request->session()->get('khachhang')['Id_KH'])->remove($c->id);
        }
        
        return redirect('/');
    }
}
