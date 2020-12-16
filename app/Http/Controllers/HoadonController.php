<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\Hoadon;
use  App\Models\ChiTietHoaDon;
class HoadonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hd = hoadon::select('Id_HD', 'Ngay_Dang', 'Tong_Tien', 'TrangThai',
         'PT_TT','AnHien', 'ThuTu', 'Ten_KH', 'Id_KH',
          'DienThoai', 'DiaChi', 'Quan', 'Phuong')
        ->orderBy('Id_HD','desc')->get();
        return view('quantri.hoadon.index', compact('hd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    public function detail($id)
    {
        $kh = hoadon::select('Id_HD', 'Ten_KH', 'DienThoai', 'DiaChi', 'Quan',
         'Phuong', 'TrangThai', 'Voucher','Tong_Tien')->where('Id_HD', '=', $id)->first();
        $data = ["hoadon" => $kh];
        return view('quantri.hoadon.detail', $data);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deletedetail($id)
    {
        $cthd = chitiethoadon::find($id);
        $cthd->delete();
        session()->put('msg', 'Đã xóa hóa đơn thành công');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $hd = hoadon::find($id);
        $hd->delete();
        session()->put('msg', 'Đã xóa hóa đơn thành công');
        return redirect('hoadon');
    }
}
