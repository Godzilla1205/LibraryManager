<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class typeBook extends Model
{
     protected $fillable = [
        'maLoaiSach', 'loaiSach'
    ];
}
