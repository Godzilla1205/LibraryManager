<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfoBorrowBooks extends Model
{
	protected $fillable = [
         'soPhieuMuon','maSoSach','soLuong','hanTra','trangThai' 
    ];
   
}
