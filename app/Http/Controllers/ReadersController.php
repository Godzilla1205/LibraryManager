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

    public function getManagerReaders_Edit($id) {
         $facultys = faculty::all()->toArray();
         $reader = readers::find($id);
         $reader['ngaySinh'] = date("m/d/Y",strtotime($reader['ngaySinh']));
         $reader['ngayCap'] = date("m/d/Y",strtotime($reader['ngayCap']));
         $reader['hansuDung'] = date("m/d/Y",strtotime($reader['hansuDung']));
        return view("event.managerReaders_Edit",compact('id','facultys','reader'));
    }
    public function postManagerReaders_Edit(Request $request, $id) {
        $reader = readers::find($id);
        $this->validate(request(), [
            'maSoDG' => 'required|min:2|max:50',
            'idKhoa'=> 'required|min:1|max:10',
            'hoTenDG' => 'required|min:1|max:100',
            'diaChiDG'=> 'nullable|max:100',
            'ngaySinh'=> 'nullable|date',
            'email'=> 'nullable|max:100',
            'gioiTinh'=> 'nullable|max:1|numeric',
            'ngayCap'=> 'nullable|date',
            'hansuDung'=> 'nullable|date'
        ]
        ,[
            'required' => ':attribute không được để trống',
            'min' => ':attribute không được nhỏ hơn :min',
            'max' => ':attribute không được lớn hơn :max',
            'numeric' => ':attribute chỉ được nhập số',
            'date' => ':attribute không đúng',
        ],
        [
            'maSoDG' => 'Mã số độc giả',
            'idKhoa' => 'Khoa',
            'hoTenDG' => 'Họ tên độc giả',
            'diaChiDG' => 'Địa chỉ độc giả',
            'ngaySinh'=> 'Ngày sinh độc giả',
            'email'=> 'Email độc giả',
            'gioiTinh'=> 'Giới tính độc giả',
            'ngayCap'=> 'Ngày cấp',
            'hansuDung'=> 'Hạn sử dụng'
        ]);
        $reader->maSoDG = $request->get('maSoDG');
        $reader->idKhoa = $request->get('idKhoa');
        $reader->hoTenDG = $request->get('hoTenDG');
        $reader->diaChiDG = $request->get('diaChiDG');
        $reader->ngaySinh = date("Y-m-d",strtotime($request->get('ngaySinh')));
        $reader->email = $request->get('email');
        $reader->gioiTinh = $request->get('gioiTinh');
        $reader->ngayCap = date("Y-m-d",strtotime($request->get('ngayCap')));
        $reader->hansuDung = date("Y-m-d",strtotime($request->get('hansuDung')));
        $reader->save();
        return back()->with('success', 'Readers has been added');
    }

    public function getManagerReaders_Delete($id) {
        try {
           $reader = readers::find($id);
           $reader->delete();
           return redirect('manager/Readers');
        }
        catch (\Exception $e) {
             return back()->withErrors('Các cụ bảo là xóa hộ bố mày cái !!!');
        }
    }


    public function getManagerReaders_Detail($id) {
        $stt = 0;
        $reader = DB::table('readers')
        ->join('faculties','faculties.id','=','readers.idKhoa')
        ->select('readers.maSoDG','faculties.tenKhoa','readers.hoTenDG','readers.diaChiDG','readers.ngaySinh','readers.email','readers.gioiTinh','readers.ngayCap','readers.hansuDung')
        ->where('readers.id','=',$id)
        ->get();
        $reader = $reader[0]; // Nếu để ko thì phải thêm [0] ở phần view

        $readerBorrowBooks = DB::table('info_borrow_books')
        ->join('borrow_books','borrow_books.id','=','info_borrow_books.soPhieuMuon')
        ->join('books','books.id','=','info_borrow_books.maSoSach')
        ->select('info_borrow_books.soPhieuMuon','books.maSoSach','borrow_books.ngayMuon','info_borrow_books.hanTra','info_borrow_books.trangThai')
        ->where('borrow_books.maSoDG','=',$id)
        ->get(); 
        $reader->ngaySinh = date("m/d/Y",strtotime($reader->ngaySinh));
        $reader->ngayCap = date("m/d/Y",strtotime($reader->ngayCap));
        $reader->hansuDung = date("m/d/Y",strtotime($reader->hansuDung));
        return view('event.managerReaders_Detail',compact('reader','readerBorrowBooks','id','stt'));
    }
    

    public function postManagerReaders_Add(Request $request) {
       $readers = $this->validate(request(), [
        'maSoDG' => 'required|min:2|max:50|unique:readers,maSoDG',
        'idKhoa'=> 'required|min:1|max:10',
        'hoTenDG' => 'required|min:1|max:100',
        'diaChiDG'=> 'nullable|max:100',
        'ngaySinh'=> 'nullable|date',
        'email'=> 'nullable|max:100',
        'gioiTinh'=> 'nullable|max:1|numeric',
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
        'diaChiDG' => 'Địa chỉ độc giả',
        'ngaySinh'=> 'Ngày sinh độc giả',
        'email'=> 'Email độc giả',
        'gioiTinh'=> 'Giới tính độc giả',
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
