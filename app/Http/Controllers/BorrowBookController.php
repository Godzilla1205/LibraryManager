<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\employees;
use App\book;
use App\publisher;
use App\typeBook;
use App\BorrowBooks;
use App\readers;

class BorrowBookController extends Controller
{
	public function getBorrowBook(){
		$employeess = employees::all()->toArray();
        $borrowBooks = BorrowBooks::all()->toArray();
		$readers = readers::all()->toArray();
		$books = DB::table('books')->join('type_books','books.idLoaiSach','=','type_books.id')->join('publishers','books.idNXB','=','publishers.id')
        ->select('books.id','books.maSoSach','books.tenSach','type_books.loaiSach','books.tacGia','publishers.hoTenNXB','books.soLuong')->get();
        // var_dump ($readers);

        // die();
        return view("layout.managerBorrowBook",compact('employeess','readers','borrowBooks','books'));
    }
    
}
