<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\readers;
use App\faculty;

class ReadersController extends Controller
{
	public function getManagerReaders(){
		$readers = DB::table('readers')
                ->join('faculties','readers.idKhoa','=','faculties.id')
                ->select('readers.id'		,'readers.maSoDG'	,'faculties.tenKhoa',
                		 'readers.hoTenDG'	,'readers.diaChiDG'	,'readers.ngaySinh'	,
                		 'readers.email'	,'readers.gioiTinh'	,'readers.ngayCap'	,
                		 'readers.hanSuDung')
                ->get();
        // $readers = $readers->result_array();
        $stt= 0;
        return view("layout.managerReaders",compact('readers','stt'));

    }
    
}
