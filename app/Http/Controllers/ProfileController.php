<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KhachHang;
class ProfileController extends Controller
{
    function index(){
        $d=array('title'=>'Trang Cá Nhân');
        return view('services.profile', $d);
    }
    public function update(Request $request, $id)
    {
        $kh = khachhang::find($id);
        $kh -> DienThoai = $request->get('DienThoai');
        $kh -> DiaChi = $request->get('DiaChi');
        $kh -> Quan = $request->get('Quan');
        $kh -> Phuong = $request->get('Phuong');
        $kh ->save();
        return redirect()->back();
    }
}
