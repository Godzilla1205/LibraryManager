<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayBook extends Model
{
   protected $fillable = [
         'soPhieuMuon','maSoSach','maSoNV','ngayTra','ghiChu' 
    ];
}
