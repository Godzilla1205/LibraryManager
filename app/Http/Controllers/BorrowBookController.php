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
        

        $borrowBooks = DB::select('select id, soPhieuMuon, maSoDG from borrow_books');
        $detailBorrows = [];
        foreach ($borrowBooks as $borrowBook) {
            $detailBorrowBooks = DB::select('select maSoSach from info_borrow_books where soPhieuMuon = :idBorrowBook', ['idBorrowBook' => $borrowBook->id]);
            $detailBorrows = [$borrowBook->id => $detailBorrowBooks];
            array_push($detailBorrows,$detailBorrowBooks);
        }
        return view("layout.managerBorrowBook",compact('employeess','detailBorrows','readers','borrowBooks','books'));
    }
    public function postBorrowBook(Request $request){
        // $borrowBook = $this->validate(request(), [
        //      'soPhieuMuon' => 'required',
        //      'maSoDG'=> 'required',
        //      'maSoNV' => 'required',
        //      'ngayMuon'=> 'required|date',
        //      'Book_ids' => 'required',
        //      'hanTra' => 'required|date'
        // ]
        // ,[
        //     'required' => ':attribute không được để trống',
        //     'date' => ':attribute không đúng'
        // ],
        // [
        //     'soPhieuMuon' => 'Số phiếu mượn',
        //     'maSoDG' => 'Mã số độc giả',
        //     'maSoNV' => 'Mã số nhân viên',
        //     'ngayMuon' => 'Ngày mượn',
        //     'Book_ids' => 'Mã số sách',
        //     'hanTra' => 'Hạn trả'
        // ]);

        // DB::insert('insert into borrow_books (soPhieuMuon, maSoDG, maSoNV, ngayMuon) values (?, ?, ?, ?)', [$request->soPhieuMuonEnd,$request->maSoDG, $request->maSoNV,date("Y-m-d",strtotime($request->ngayMuon))]);
        $checkBook = $this->validate(request(), [
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
        
        $borrow_Books = DB::table('borrow_books')->select('id')->get()->toArray();
        $idBorrow_Book = $borrow_Books[count($borrow_Books)-1];
        $infoBorrowBook['hanTra'] = date("Y-m-d",strtotime($infoBorrowBook['hanTra']));

        $array = ['soPhieuMuon'=>$idBorrow_Book->id,'soLuong'=>1,'trangThai'=>0];
        $infoBorrowBook = array_merge($infoBorrowBook,$array);
        $Book_ids = explode(",",$request->Book_ids);
        array_pop($Book_ids);
        foreach ($Book_ids as $Book_id) {
           $arrayBookId = ['maSoSach'=>$Book_id];
           $detailBorrowBook = array_merge($infoBorrowBook,$arrayBookId);
           InfoBorrowBooks::create($detailBorrowBook);
       }
       return back()->with('success', 'Borrow book has been added');
   }
}
