<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\employees;
use App\readers;
use App\BorrowBooks;
use App\book;
class PayBookController extends Controller
{
    public function getPayBook() {
    	$employees = employees::all()->toArray();
    	$readers = readers::all()->toArray();
    	$books = book::all()->toArray();
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
               
              $idBooksBorrow = DB::table('info_borrow_books')->join('borrow_books','borrow_books.id','=','info_borrow_books.soPhieuMuon')->select('info_borrow_books.maSoSach')->where('borrow_books.maSoDG','=',$readerBorrow->maSoDG)->get(); 
              $listBorrowBooks  = [];
              $idReader = getValueObject($idReadersBorrow,'maSoDG');
             
              changObjectToArray($listBorrowBooks, $idBooksBorrow, ['maSoSach']);

              $arrayIdReader = setNameKeyArray('maSoDG', $idReader);
              $arrayIdBooks = setNameKeyArray('maSoSach', $listBorrowBooks);
              $arrayBorrowBook = array_merge($arrayIdReader, $arrayIdBooks);
              array_push($detailBorrows, $arrayBorrowBook);
        }
       //        dumpArray($detailBorrows);
       
       // die();


    	return view('layout.managerPayBook',compact('employees','readers','detailBorrows','books'));
    } 
}
