<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CT_To_HD extends Model
{
    use HasFactory;
    protected $table='ct_to_hd';
    protected $fillable = [
        'Id_HD',
        'Id_CT',
    ];
}
