<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Giohang;
class TestController extends Controller
{
    public function index(Request $req){
        $req->session()->has('khachhang');
        $gh = Giohang::where('Id_KH', '=', $req->session()->get('khachhang')['Id_KH'])->get();
        return view('/', compact('gh'));
    }

    public function addcart(Request $request, $id){
        $gh = new giohang([
            'Ten_SP' => $request->get('Ten_SP'),
            'So_Luong' => $request->get('So_Luong'),
            'AnHien' => $request->get('AnHien'),
            'ThuTu' => $request->get('ThuTu'),
            'Id_SP' => $request->get('Id_SP'),
            'Id_KH' => $request->get('Id_KH'),
        ]);
        $gh->save();

        return view('cartchild');
    }

    public function updatecart(Request $request){
        $gh = Giohang::find($request->id);
        $gh->So_Luong = $request->get('So_Luong');
        $gh->save();
        return view('cartchild');
    }

    public function deletecart($id){
        $gh=Giohang::find($id);
        $gh->delete();
        return view('cartchild');
    }
}
