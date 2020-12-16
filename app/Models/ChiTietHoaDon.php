<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietHoaDon extends Model
{
    use HasFactory;
    protected $table = 'chitiethoadon';
    protected $primaryKey='Id_CT';
    protected $fillable = [
        'Ten_SP',
        'Id_SP',
        'Id_HD',
        'So_Luong',  
    ];
}
