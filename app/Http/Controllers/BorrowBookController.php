<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\employees;
use App\book;
use App\publisher;
use App\typeBook;
use App\BorrowBooks;
use App\InfoBorrowBooks;
use App\readers;

class BorrowBookController extends Controller
{
	public function getBorrowBook(){

		$employeess = employees::all()->toArray();
        //$borrowBooks = BorrowBooks::all()->toArray();
        $readers = readers::all()->toArray();
        $books = DB::table('books')->join('type_books','books.idLoaiSach','=','type_books.id')->join('publishers','books.idNXB','=','publishers.id')
        ->select('books.id','books.maSoSach','books.tenSach','type_books.loaiSach','books.tacGia','publishers.hoTenNXB','books.soLuong')->get();
        

        function changObjectToArray(&$nameArray, $nameObject, $selector) {
            for ($i = 0; $i <count($nameObject); $i++) {
                for ($j = 0; $j <count($selector); $j++) {
                     array_push($nameArray, getValueObject($nameObject, $selector[$j], $i));
                }
            }
        }
        

        function getValueObject($nameObject, $nameGet, $index = 0) {
            return $nameObject[$index] -> $nameGet;
        }

        function setNameKeyArray($nameKey, $value) {
            return [$nameKey => $value];
        }

        function dumpArray($nameArray) {
           echo "<pre>";
           var_dump ($nameArray);
           echo "</pre>";
        }



        $readerBorrows = DB::select('select maSoDG, Count(*) from borrow_books Group By maSoDG');
        
        $borrowBooks = DB::select('select id, soPhieuMuon from borrow_books');
        
        $detailBorrows = [];
        
        foreach ($readerBorrows as $readerBorrow) {    
              $idReadersBorrow = DB::table('borrow_books')->select('borrow_books.soPhieuMuon','borrow_books.maSoDG')->where('borrow_books.maSoDG','=',$readerBorrow->maSoDG)->get(); 
               
              $idBooksBorrow = DB::table('info_borrow_books')->join('borrow_books','borrow_books.id','=','info_borrow_books.soPhieuMuon')->select('info_borrow_books.maSoSach')
              ->where('borrow_books.maSoDG','=',$readerBorrow->maSoDG)
              ->where('info_borrow_books.trangThai','=', '0')
              ->get(); 
              $listBorrowBooks  = [];

              $idReader = getValueObject($idReadersBorrow,'maSoDG');
             
              changObjectToArray($listBorrowBooks, $idBooksBorrow, ['maSoSach']);

              $arrayIdReader = setNameKeyArray('maSoDG', $idReader);
              $arrayIdBooks = setNameKeyArray('maSoSach', $listBorrowBooks);
              $arrayBorrowBook = array_merge($arrayIdReader, $arrayIdBooks);
              array_push($detailBorrows, $arrayBorrowBook);
        }
  /*            dumpArray($detailBorrows);
       
       die();*/
       return view("layout.managerBorrowBook",compact('employeess','detailBorrows','readers','borrowBooks','books'));
   }
   public function postBorrowBook(Request $request){
    $checkIds = $this->validate(request(), [
        'Book_ids'=> 'required'
    ]
    ,[
        'required' => ':attribute không được để trống'
    ],
    [
        'Book_ids' => 'Mã số sách',
    ]);

    $borrowBook = $this->validate(request(), [
        'soPhieuMuon' => 'required',
        'maSoDG'=> 'required',
        'maSoNV' => 'required',
        'ngayMuon'=> 'required|date'
    ]
    ,[
        'required' => ':attribute không được để trống',
        'date' => ':attribute không đúng'
    ],
    [
        'soPhieuMuon' => 'Số phiếu mượn',
        'maSoDG' => 'Mã số độc giả',
        'maSoNV' => 'Mã số nhân viên',
        'ngayMuon' => 'Ngày mượn'
    ]);

    $infoBorrowBook = $this->validate(request(), [
        'soPhieuMuon' => '',
        'hanTra'=> 'required|date'
    ]
    ,[
        'required' => ':attribute không được để trống',
        'date' => ':attribute không đúng'
    ],
    [
        'soPhieuMuon' => 'Số phiếu mượn',
        'hanTra' => 'Hạn trả'
    ]);

    $borrowBook['ngayMuon'] = date("Y-m-d",strtotime($borrowBook['ngayMuon']));
    BorrowBooks::create($borrowBook);

    $borrow_Books = DB::table('borrow_books')->select('id')->where('soPhieuMuon','=',$request->soPhieuMuon)->get()->toArray();
    //$idBorrow_Book = $borrow_Books[count($borrow_Books)-1];

    $infoBorrowBook['hanTra'] = date("Y-m-d", strtotime($infoBorrowBook['hanTra']));
    $array = ['soPhieuMuon' => $borrow_Books[0]->id, 'soLuong'=>1, 'trangThai'=>0];
    $infoBorrowBook = array_merge($infoBorrowBook, $array);
    $Book_ids = explode(",", $request->Book_ids);
    array_pop($Book_ids);
    foreach ($Book_ids as $Book_id) {
       $arrayBookId = ['maSoSach'=>$Book_id];
       $detailBorrowBook = array_merge($infoBorrowBook, $arrayBookId);
       InfoBorrowBooks::create($detailBorrowBook);
       DB::update('update books set soLuong = (soLuong - 1) where id = :id', ['id' => $Book_id]);
   }


   return back()->with('success', 'Borrow book has been added');
}
}
