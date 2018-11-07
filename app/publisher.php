<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class publisher extends Model
{
    protected $fillable = [
        'maSoNXB', 'hoTenNXB', 'diaChiNXB','websiteNXB','thongTinKhacNXB'
    ];
}
