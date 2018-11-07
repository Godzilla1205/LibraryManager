<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class readers extends Model
{
	protected $fillable = ['maSoDG','idKhoa','hoTenDG','diaChiDG','ngaySinh','email','gioiTinh','ngayCap','hansuDung'];
}
