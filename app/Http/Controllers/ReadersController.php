<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\readers;
use App\faculty;
use App\BorowBooks;
use App\infoBorrowBooks;
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

    public function getManagerReaders_Add() {
        $facultys = faculty::all()->toArray();
        return view("event.managerReaders_Add",compact('facultys'));
    }


    public function getManagerReaders_Detail($id) {
        $stt = 0;
        $reader = DB::table('readers')
        ->join('faculties','faculties.id','=','readers.idKhoa')
        ->select('readers.maSoDG','faculties.tenKhoa','readers.hoTenDG','readers.diaChiDG','readers.ngaySinh','readers.email','readers.gioiTinh','readers.ngayCap','readers.hanSuDung')
        ->where('readers.id','=',$id)
        ->get();
        $reader = $reader[0]; // Nếu để ko thì phải thêm [0] ở phần view

        $readerBorrowBooks = DB::table('info_borrow_books')
        ->join('borrow_books','borrow_books.id','=','info_borrow_books.soPhieuMuon')
        ->join('books','books.id','=','info_borrow_books.maSoSach')
        ->select('info_borrow_books.soPhieuMuon','books.maSoSach','borrow_books.ngayMuon','info_borrow_books.hanTra','info_borrow_books.trangThai')
        ->where('borrow_books.maSoDG','=',$id)
        ->get(); 

        return view('event.managerReaders_Detail',compact('reader','readerBorrowBooks','id','stt'));
    }
    

    public function postManagerReaders_Add(Request $request) {
       $readers = $this->validate(request(), [
        'maSoDG' => 'required|min:2|max:50|unique:readers,maSoDG',
        'idKhoa'=> 'required|min:1|max:10',
        'hoTenDG' => 'required|min:1|max:100',
        'diChiDG'=> 'nullable|max:100',
        'ngaySinh'=> 'nullable|date',
        'emailNV'=> 'nullable|max:100',
        'gioiTinhNV'=> 'nullable|max:1|numeric',
        'ngayCap'=> 'nullable|date',
        'hansuDung'=> 'nullable|date'
    ]
    ,[
        'required' => ':attribute không được để trống',
        'min' => ':attribute không được nhỏ hơn :min',
        'max' => ':attribute không được lớn hơn :max',
        'numeric' => ':attribute chỉ được nhập số',
        'date' => ':attribute không đúng',
        'unique' => ':attribute đã tồn tại'
    ],
    [
        'maSoDG' => 'Mã số độc giả',
        'idKhoa' => 'Khoa',
        'hoTenDG' => 'Họ tên độc giả',
        'diChiDG' => 'Địa chỉ độc giả',
        'ngaySinh'=> 'Ngày sinh độc giả',
        'emailNV'=> 'Email độc giả',
        'gioiTinhNV'=> 'Giới tính độc giả',
        'ngayCap'=> 'Ngày cấp',
        'hansuDung'=> 'Hạn sử dụng'
    ]);
       $readers['ngaySinh'] = date("Y-m-d",strtotime($readers['ngaySinh']));
       $readers['ngayCap'] = date("Y-m-d",strtotime($readers['ngayCap']));
       $readers['hansuDung'] = date("Y-m-d",strtotime($readers['hansuDung']));
       readers::create($readers);
       return back()->with('success', 'Readers has been added');
   }

}
