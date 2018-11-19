<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\BorrowBooks;
class StatisticalController extends Controller
{
	function getStatistical() {
		$borrowBooks = BorrowBooks::all()->toArray();
		//var_dump ($borrowBooks);

    	//$month = date("m",strtotime($borrowBooks[0]['ngayMuon']));
    	//echo $month;
		// 	$time = date("H",strtotime($borrowBooks[0]['created_at']));
		// echo $time;
		// die();

		// echo "Today is " . date("Y/m/d") . "<br>";
		// $monthToDay = date("m");
		// // echo $monthToDay;
		// $number = 0;
		// foreach ($borrowBooks as $borrowBook) {   
		// 	$month = date("m",strtotime($borrowBook['created_at'])); 
		// 	if($monthToDay == $month) {
		// 		$number++;
		// 	}

		// }

		function checkMonth($month, &$yeah) {
			$number = 1;
			for ($i = 0; $i < count($yeah); $i++) {
				if($month == $number) {
					$yeah[$i]++;
				}
				$number++;
			}
		}
		//echo $number; // Tức là trong tháng này có number phiếu mượn @@

		
		$yeah2018 = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
		foreach ($borrowBooks as $borrowBook) {   
			$month = date("m", strtotime($borrowBook['ngayMuon'])); 
			checkMonth($month, $yeah2018);
		}
		//var_dump ($yeah2018);
		$strYeah2018 = implode(',', $yeah2018);

		return view('layout.managerStatistical',compact('strYeah2018'));
	}
}
