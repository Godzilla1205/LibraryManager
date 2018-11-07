<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BorrowBooks extends Model
{
	protected $fillable = [
        'soPhieuMuon','maSoDG','maSoNV','ngayMuon'
    ];

    
}
