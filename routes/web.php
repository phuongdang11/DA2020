<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'IndexController@index');
Route::get('/gioi-thieu', "IndexController@gioithieu");
Route::get("/thuc-don","IndexController@menu");
Route::get("/dich-vu","IndexController@services");
Route::get("/lien-he","IndexController@lienhe");

Route::get("/san-pham","ProductController@product");
Route::get("/san-pham-{Id_SP}","ProductController@detailproduct");
Route::get("/sptodm-{Id_DM}","ProductController@sptodm");
Route::post("/danh-gia", "ProductController@danhgia");
Route::post('/suadanhgia/{id}', 'ProductController@suadanhgia');

Route::get("/tin-tuc","BlogController@blog");
Route::get("/tin-tuc-{Id_TT}","BlogController@blogdetail");
Route::post('/binh-luan', 'BlogController@binhluan')->name('bl.add');
Route::get('dl/{id}', 'BlogController@delete');
Route::post('/capnhat/{id}', 'BlogController@capnhat');

Route::post("/giohang","GiohangController@addcart");
Route::get("/gio-hang","GiohangController@index");
Route::post("capnhatsl/{id}","GiohangController@updateSL");
Route::get('delete/{id}', 'GiohangController@delete');

Route::get("/thanh-toan","ThanhtoanController@index");
Route::post("/thanhtoan/{id}","ThanhtoanController@thanhtoan");

Route::post("/addcart","TestController@addcart")->name('gh.add');
Route::put("/udcart", "TestController@updatecart")->name('gh.update');
Route::delete("/dlcart/{id}", "TestController@deletecart");
// Route::get('/admin', function () {
//     return view('quantri.layoutquantri');
// });

Route::get('/dang-ky', 'RegisterController@index');

Route::post('/create', 'RegisterController@create');

Route::get('/dang-nhap', 'DangnhapController@index');

Route::get('/ho-so', 'ProfileController@index');
Route::post('/suahoso/{id}', 'ProfileController@update');

Route::post('/logined', 'DangnhapController@login');
Route::get('/logouted', function(){
    Session::forget('khachhang');
    return redirect('/dang-nhap');
});

Route::get('/check', 'UserController@userOnlineStatus');


Route::get('/quantophuong/{Id_Q}', function($Id_Q){
    $qtp = DB::table('quan_to_phuong')->select('Id_Q', 'Id_P')->where("Id_Q", '=' , $Id_Q)->get();
    foreach($qtp as $dm){
        $phuong = DB::table('Phuong')->select('Id_P', 'Ten_Phuong')->where("Id_P", '=' ,$dm->Id_P )->get();
        foreach($phuong as $p)
            echo "<option value= '$p->Id_P' > $p->Ten_Phuong </option>";
    }
});



Route::group(['middleware' => ['protectPage']], function () {
    Route::resource('danhmuc', 'DanhMucController');
    Route::resource('loaisp', 'LoaiSPController');
    Route::resource('sanpham', 'SanPhamController');
        Route::post('sanpham.store', 'SanPhamController@store')->name('sanpham.store');
    Route::resource('khachhang', 'KhachhangController');
    Route::resource('nhanvien', 'NhanvienController');
    Route::resource('tintuc', 'TintucController');
        Route::post('tintuc.store', 'TintucController@store')->name('tintuc.store');
    Route::resource('binhluan', 'BinhluanController');
        Route::post('cpTB/{id}', 'BinhluanController@upTB');
    Route::resource('danhgia', 'DanhgiaController');
    Route::resource('cart', 'CartController');
        Route::get('/cart/{Id_SP}', function($Id_SP){
            $sp = DB::table('sanpham')->select('Id_SP', 'Ten_SP')->where("Id_SP", '=' , $Id_SP)->first();
                    echo "<option value= '$sp->Ten_SP' > $sp->Ten_SP </option>";
            }
        );
    Route::resource('tags', 'TagsController');
    Route::resource('hoadon', 'HoadonController');
    Route::get('hoadon/{id}/detail', 'HoadonController@detail');
    Route::get('detail/{id}', 'HoadonController@deletedetail');
    Route::get('/qt', function(){
        return view('quantri.dashboard');
    });
    Route::get('/admin', function () {
        return view('quantri.layoutquantri');
    });
});
Route::get('/loginad', 'LoginAdminController@index');
Route::post('/loginad', 'LoginAdminController@loginad');
Route::get('/logoutad', function(){
    Session::forget('nhanvien');
    return redirect('/loginad');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', 'Auth\LoginController@logout');


Route::post('/test',  'CtController@addcart')->name('ct.add');
Route::post('/acdt',  'CtController@addcartdt')->name('ctdt.add');
Route::get('/del/{id}',  'CtController@deleteCart');
Route::post('/upd/{id}',  'CtController@upCart');
Route::get('/list',  'CtController@index')->name('ct.index');

Route::post('/load-comment',  'BlogController@loadCm');
Route::post('/comment',  'BlogController@commentAjax')->name('cm.add');



