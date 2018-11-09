<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\book;
use App\publisher;
use App\typeBook;
class BookController extends Controller
{
    public function getManagerBook(){
        // $queryJoinTable = "'type_books','books.idLoaiSach','=','type_books.id'";
        // $queryInfoBook  = "'books.id','books.maSoSach','books.tenSach','type_books.loaiSach','books.tacGia' ,'books.ngaySinh' ,'books.namXB','books.lanXB' ,'books.soLuong','books.giaTien'";

        $books = DB::table('books')->join('type_books','books.idLoaiSach','=','type_books.id')->join('publishers','books.idNXB','=','publishers.id')
        ->select('books.id','books.maSoSach','books.tenSach','type_books.loaiSach','books.tacGia','publishers.hoTenNXB','books.namXB','books.lanXB' ,'books.soLuong','books.giaTien')->get();
 
        $stt = 0;
        return view("layout.managerBook",compact('books','stt'));
    }
    public function getManagerBook_Add(){
    	$typeBooks = typeBook::all()->toArray();
    	$publishers = publisher::all()->toArray();
    	return view("event.managerBook_Add",compact('typeBooks','publishers'));
    }
     public function postManagerBook_Add(Request $request){
       $book = $this->validate(request(), [
             'maSoSach'   => 'required|min:2|max:50|unique:books,maSoSach',
             'idNXB'      => 'required|min:1|max:10',
             'idLoaiSach' => 'required|min:1|max:10',
             'tenSach'    => 'required|min:2|max:100',
             'tacGia'     => 'nullable|max:100',
             'namXB'      => 'nullable|numeric',
             'lanXB'      => 'required|numeric',
             'soLuong'    => 'required|numeric',
             'giaTien'    => 'required|numeric',
             'noiDungTomLuoc'=> 'nullable|max:500',
             'linkAnh'    => 'nullable|max:100'
        ]
        ,[
            'required' => ':attribute không được để trống',
            'min' => ':attribute không được nhỏ hơn :min',
            'max' => ':attribute không được lớn hơn :max',
            'numeric' => ':attribute chỉ được nhập số',
            'unique' => ':attribute đã tồn tại'
        ],
        [
            'maSoSach' => 'Mã số sách',
            'idNXB' => 'Nhà xuất bản',
            'idLoaiSach' => 'Loại sách',
            'tenSach'=> 'Tên sách',
            'tacGia'=> 'Tác giả',
            'namXB'=> 'Năm xuất bản',
            'lanXB'=> 'Lần xuất bản',
            'soLuong'=> 'Số lượng',
            'giaTien'=> 'Giá tiền',
            'noiDungTomLuoc'=> 'Nội dung tóm lược',
            'linkAnh'=> 'Link ảnh'
        ]);
       book::create($book);
       return back()->with('success', 'Publisher has been added');
    }
    public function getManagerBook_Edit($id){
      $book = book::find($id);
      $typeBooks = typeBook::all()->toArray();
      $publishers = publisher::all()->toArray();
      return view("event.managerBook_Edit",compact('book','id','typeBooks','publishers'));
    }

    public function postManagerBook_Edit(Request $request,$id){
        $book = book::find($id);
        $this->validate(request(),[ 
             'maSoSach'   => 'required|min:2|max:50|unique:books,maSoSach',
             'idNXB'      => 'required|min:1|max:10',
             'idLoaiSach' => 'required|min:1|max:10',
             'tenSach'    => 'required|min:2|max:100',
             'tacGia'     => 'nullable|max:100',
             'namXB'      => 'nullable|numeric',
             'lanXB'      => 'nullable|numeric',
             'soLuong'    => 'nullable|numeric',
             'giaTien'    => 'nullable|numeric',
             'noiDungTomLuoc'=> 'nullable|max:500',
             'linkAnh'    => 'nullable|max:100'
        ]
        ,[
            'required' => ':attribute không được để trống',
            'min' => ':attribute không được nhỏ hơn :min',
            'max' => ':attribute không được lớn hơn :max',
            'numeric' => ':attribute chỉ được nhập số',
            'unique' => ':attribute đã tồn tại'
        ],
        [
            'maSoSach' => 'Mã số sách',
            'idNXB' => 'Nhà xuất bản',
            'idLoaiSach' => 'Loại sách',
            'tenSach'=> 'Tên sách',
            'tacGia'=> 'Tác giả',
            'namXB'=> 'Năm xuất bản',
            'lanXB'=> 'Lần xuất bản',
            'soLuong'=> 'Số lượng',
            'giaTien'=> 'Giá tiền',
            'noiDungTomLuoc'=> 'Nội dung tóm lược',
            'linkAnh'=> 'Link ảnh'
        ]);
        $book->maSoSach = $request->get('maSoSach');
        $book->idNXB = $request->get('idNXB');
        $book->idLoaiSach = $request->get('idLoaiSach');
        $book->tenSach = $request->get('tenSach');
        $book->tacGia = $request->get('tacGia');
        $book->namXB = $request->get('namXB');
        $book->lanXB = $request->get('lanXB');
        $book->soLuong = $request->get('soLuong');
        $book->giaTien = $request->get('giaTien');
        $book->noiDungTomLuoc = $request->get('noiDungTomLuoc');
        $book->linkAnh = $request->get('linkAnh');
        $book->save();
        return redirect("manager/Book/Edit/$id")->with('success','Publisher has been updated');
    }

    public function getManagerBook_Delete($id){
         $book = book::find($id);
         $book->delete();
         return redirect('manager/Book');
    }
    
}
