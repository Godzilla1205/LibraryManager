<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\BorrowBooks;
use App\PayBook;
use App\InfoBorrowBooks;
use App\readers;

class ManagerController extends Controller
{
	public function getManager(){
		$borrowBooks = BorrowBooks::all()->toArray();
		$payBooks = DB::select('select soPhieuMuon, ngayTra, Count(*) from pay_books Group By soPhieuMuon,ngayTra');	


		//$infoBorrowBooks = InfoBorrowBooks::all()->where('trangThai','=','0')->toArray();
		$infoBorrowBooks = DB::select('select soPhieuMuon, hanTra, Count(*) from info_borrow_books Group By soPhieuMuon, trangThai, hanTra having trangThai = 0');

		$readers = readers::all()->toArray();
		// echo "<pre>";
		// var_dump ($payBooks);
		// echo "</pre>";
		// die();
		// $month = date("m",strtotime($borrowBooks[0]['ngayMuon']));
		// echo $month;
		// $time = date("H",strtotime($borrowBooks[0]['created_at']));
		// echo $time;
		// die();

		//echo "Today is " . date("Y/m/d") . "<br>";

		$dayToDay = date("d");
		
		$numberBorrowToDay = 0;
		foreach ($borrowBooks as $borrowBook) {   
			$day = date("d", strtotime($borrowBook['ngayMuon'])); 
			if($day == $dayToDay) {
				$numberBorrowToDay++;
			}
		}

		$numberGiveToDay = 0;
		foreach ($payBooks as $payBook) {   
			$day = date("d", strtotime($payBook->ngayTra)); 
			if($day == $dayToDay) {
				$numberGiveToDay++;
			}
		}

		$numberDelay = 0;
		foreach ($infoBorrowBooks as $infoBorrowBook) {   
			$day = date("d", strtotime($infoBorrowBook->hanTra)); 
			if($day < $dayToDay) {
				$numberDelay++;
			}
		}

		//echo $numberDelay;
		$numberReaders = count($readers);

		return view("layout.manager",compact('numberBorrowToDay','numberGiveToDay','numberDelay','numberReaders'));
	}
}
