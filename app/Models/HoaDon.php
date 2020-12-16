<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoaDon extends Model
{
    use HasFactory;
    protected $table = 'hoadon';
    protected $primaryKey='Id_HD';
    protected $fillable = [
        'Ngay_Dang',
        'Tong_Tien',
        'AnHien',
        'ThuTu',
        'Ten_KH',
        'DienThoai',
        'DiaChi',
        'Quan',
        'Phuong',
        'Voucher',
        'PT_TT',
        'TrangThai',
        'Id_KH',   
    ];
}
