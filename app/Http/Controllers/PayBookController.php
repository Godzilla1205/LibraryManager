<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\employees;
use App\readers;
use App\BorrowBooks;
use App\book;
use App\PayBook;
class PayBookController extends Controller
{
	public function getManagerGiveBack() {
		$payBooks = DB::table('pay_books')
		->join('books','pay_books.maSoSach','=','books.id')
		->join('employees','pay_books.maSoNV','=','employees.id')
		->select('pay_books.id','pay_books.soPhieuMuon','books.maSoSach','employees.maSoNV','pay_books.ngayTra','pay_books.ghiChu')->get(); 
		return view('layout.managerGiveBack',compact('payBooks'));
	}
	public function getPayBookContent($maSoDG) {
		$employees = employees::all()->toArray();
		$reader = DB::table('readers')->select('id')->where('maSoDG','=',$maSoDG)->get();
		if(count($reader) > 0) {
			$idReader = $reader[0]->id;
			$detailBorrows = DB::table('info_borrow_books')
			->join('borrow_books','borrow_books.id','=','info_borrow_books.soPhieuMuon')
			->join('books','books.id','=','info_borrow_books.maSoSach')
			->select('info_borrow_books.soPhieuMuon','books.tenSach','info_borrow_books.maSoSach as idSach','books.maSoSach','borrow_books.ngayMuon','info_borrow_books.trangThai')
			->where('borrow_books.maSoDG','=', $idReader)
			->where('info_borrow_books.trangThai','=', '0')
			->get(); 
			if(count($detailBorrows) > 0) {
				return view('layout.PayBookContent',compact('detailBorrows','employees','maSoDG'));
			}else {
				return redirect("manager/GiveBack/create")->with('success', 'Độc giả này đã trả hết sách !!!');;
			}
		}else {
			return back()->withErrors('Mã độc giả không tồn tại !!!');
		}
	}


	public function postPayBookContent(Request $request, $maSoDG) {
		$payBook = $this->validate(request(), [
			'soPhieuMuon' => 'required',
			'maSoSach'=> 'required',
			'maSoNV' => 'required',
			'ngayTra'=> 'required|date',
			'ghiChu' => 'max:200'
		]
		,[
			'required' => ':attribute không được để trống',
			'date' => ':attribute không đúng',
			'max' => ':attribute số ký tự không được lớn hơn :max'
		],
		[
			'soPhieuMuon' => 'Số phiếu mượn',
			'maSoSach' => 'Mã số sách',
			'maSoNV' => 'Mã số nhân viên',
			'ngayTra' => 'Ngày trả',
			'ghiChu' => 'Ghi chú'
		]);

		$payBook['ngayTra'] = date("Y-m-d",strtotime($payBook['ngayTra']));
		PayBook::create($payBook);
		DB::update('update info_borrow_books set trangThai = 1 where soPhieuMuon = :soPhieuMuon AND maSoSach = :maSoSach ', ['soPhieuMuon' => $request->soPhieuMuon, 'maSoSach' => $request->maSoSach]);
		DB::update('update books set soLuong = (soLuong + 1) where id = :id', ['id' => $request->maSoSach]);


		return redirect("manager/GiveBack/create/$maSoDG")->with('success', 'Trả sách thành công !!!');;
	} 
	public function getPayBookHeader() {
		$employees = employees::all()->toArray();
		return view('layout.PayBookHeader',compact('employees'));

	} 
}
