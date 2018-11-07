<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class employees extends Model
{
     protected $fillable = [
        'maSoNV','hoTenNV','diaChiNV','ngaySinhNV','gioiTinhNV','soDTNV','emailNV','ngayVaoLam','avatar'
    ];
}
