<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class book extends Model
{
    protected $fillable = [
        'maSoSach','idNXB','idLoaiSach','tenSach','tacGia','namXB','lanXB','soLuong','giaTien','noiDungTomLuoc','linkAnh'
    ];
}
