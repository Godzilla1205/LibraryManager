@extends('index')

@section("datepicker")
<link href="{{asset('vendor/dist/css/datepicker.min.css')}}" rel="stylesheet" type="text/css">
<script src="{{asset('vendor/dist/js/datepicker.min.js')}}"></script>
<script src="{{asset('vendor/dist/js/i18n/datepicker.en.js')}}"></script>
@endsection

@section("menu-manager-payBook")
sl-active
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item">
		<a href="{{route('get.manager')}}">Trang chủ</a>
	</li>
	<li class="breadcrumb-item active">
		Duyệt phiếu trả
	</li> 
</ol>
@endsection

@section('content')
<div id="content" class="container-fluid">
	<div class="card">
		<div class="card-body">
			<h2 class="text-center">Duyệt Phiếu Trả</h2>
			<br/>  
			<div class="container">
				<div class="row">
					<div class="col-md-5">
						@if ($errors->any())
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div><br />
						@endif
						@if (Session::has('success'))
						<div class="alert alert-success">
							<p>{{ Session::get('success') }}</p>
						</div><br />
						@endif
					</div>
				</div>
			</div>
			@yield('form-content')
		</div>
	</div>
</div>
@endsection



@section('scriptBottom')
{{-- <script>
// create array
var readers = [];
var books = [];
var totalBorrows = [];
var detailBorrows = [];
var listBorrows = [];
var idReader = "";
// add Data to array
insertReadersArray();
insertDBArray();
// get input, selector
var codeReader = getElement('#codeReader');
var listBorrowBooks = getElement('#listBorrowBooks');
// get btn
var btnCheckReader = getElement('#btnCheckReader');
var btnExit = getElement('#btnExit');
var btnCannel = getElement('#btnCannel');
// get form
var formHeader = getElement('#form-header');
var formContentHeader = getElement('#form-content-header');
var formContentBottom = getElement('#form-content-bottom');

btnCheckReader.onclick = function() {
	if(checkReader(codeReader.value)) {
		disableFormHeader();
		enableFormContentHeader();
		listBorrows = getBorrow(idReader);
		console.log(listBorrows)
		renderListBorrowBooks(listBorrows);
	}
}
btnExit.onclick = function() {
	disableFormContentHeader();
	enableFormHeader();
}
btnCannel.onclick = function() {
	listBorrowBooks.value = -1;
	enableFormContentHeader();
	disableFormContentBottom();
}

listBorrowBooks.onchange = function() {
	//console.log(listBorrowBooks.value)
	if(listBorrowBooks.value == -1){
	} else {
		enableFormContentBottom();
		disableFormContentHeader();
	}
	
}

function disableFormHeader() {
	formHeader.classList.add('disabledbutton');
}
function enableFormHeader() {
	formHeader.classList.remove('disabledbutton');
}
function disableFormContentHeader() {
	formContentHeader.classList.add('disabledbutton');
}
function enableFormContentHeader() {
	formContentHeader.classList.remove('disabledbutton');
}
function disableFormContentBottom() {
	formContentBottom.classList.add('disabledbutton');
}
function enableFormContentBottom() {
	formContentBottom.classList.remove('disabledbutton');
}

function checkReader(codeReader){
	for (var i = 0; i < readers.length; i++) {
		var reader = readers[i]['maSoDG'];
		if(codeReader == reader){
			idReader = readers[i]['id'];
			return true;
		}else {}
	}
	alert("Mã số độc giả không hợp lệ !!!");
	return false;

}

function getElement(selector) {
	var element = document.querySelector(selector);
	return element;
}
function setHTML(selector, html) {
	var element = document.querySelector(selector);
	element.innerHTML = html;
}


/*---------------------------------- render ----------------------------------------*/	

function renderListBorrowBooks(listBorrow) {
	var html = '<option value="-1">---</option>';
	for (var i = 0; i < listBorrow.length; i++) {
		idBorrowBook = listBorrow[i];
		for (var j = 0; j < books.length; j++) {
			book = books[j];
			if(book.id == idBorrowBook){
				html += '<option value="' + book.id + '">' + book.tenSach + '</option>';
			}
		}
	}
	setHTML('#listBorrowBooks', html);
}

//Lấy tất cả dach sách quyển sách của độc giả từ id nhận được khi check thông tin thành công
function getBorrow(idReader) {
	var listIdBorrow = [];
	for (var i = 0; i < detailBorrows.length; i++) {
		var codeReader = detailBorrows[i]['maSoDG'];
		if(idReader == codeReader){
			listIdBorrow = detailBorrows[i]['maSoSach'];
			return listIdBorrow;
		}
	}
}
/*-------------------------------- end render --------------------------------------*/


/*------------------------------- insert by DB -------------------------------------*/
function insertReadersArray(){
	@foreach($readers as $reader)
	readers.push({id:"{{$reader['id']}}", maSoDG:"{{$reader['maSoDG']}}"});
	@endforeach
}
function insertDBArray(){ 

	
	@foreach($books as $book)
	books.push({
		id:"{{$book['id']}}",
		maSoSach :"{{$book['maSoSach']}}",
		tenSach :"{{$book['tenSach']}}"})
	@endforeach

	@foreach($totalBorrows as $totalBorrow)
	totalBorrows.push({
		soPhieuMuon:"{{$totalBorrow->soPhieuMuon}}",
		maSoSach :"{{$totalBorrow->maSoSach}}",
		ngayMuon :"{{$totalBorrow->ngayMuon}}",
		trangThai:"{{$totalBorrow->trangThai}}"})
	@endforeach

	@foreach($detailBorrows as $detailBorrow)
	var array = [];
	@foreach($detailBorrow['maSoSach'] as $maSoSach)
	array.push({{$maSoSach}});
	@endforeach
	detailBorrows.push({
		maSoDG:"{{$detailBorrow['maSoDG']}}",
		maSoSach:array
	})
	@endforeach
}

</script> --}}
@endsection


