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
			<form action="{route('post.manager.borrowBook')}}" method="POST" class="form-horizontal" role="form">
				@method('post')
				@csrf
				<div id="form-header" class="row form-border">
					<div class="col-sm-4">
						<div class="form-group">
							<label class="col-sm-12 control-label" for="">Mã Độc Giả</label>
							<div class="col-sm-12">
								<input class="form-control" id="codeReader" value="DG002" type="text">
								<input type="hidden" id="maSoDG" name="maSoDG">
							</div>
						</div> <!-- end form-group --> 
						<div class="form-group">
							<label class="col-sm-12 control-label">Nhân Viên</label>
							<div class="col-sm-12">
								<select class="form-control" name="maSoNV">
									@foreach($employees as $employee)
									<option value="{{$employee['id']}}">
									{{$employee['hoTenNV']}}</option>
									@endforeach
								</select>
							</div>
						</div> <!-- end form-group -->
					</div>
					<div class="col-sm-4 offset-sm-3">
						<div class="form-group float-right">
							<div class="col-sm-12">
								<a href="javascript:void(0)" id="btnCheckReader" class="btn btn-secondary">Kiêm tra</a>
								<a href="{{route('get.manager')}}" class="btn btn-default">Thoát</a>
							</div>
						</div>
					</div>
				</div>
				<div id="form-content-header" class="row form-border disabledbutton">
					<div class="col-sm-12">
						<div class="container">
							<div class="row">
								<div class="col-sm-3">
									<span class="form-control-label">Chọn cuốn sách mang trả</span>
								</div>
								<div class="col-sm-6">
									<select class="form-control" id="listBorrowBooks" name="maSoSach">
										
									</select>
								</div>
								<div class="col-sm-2 offset-1">
									<a href="javascript:void(0)" id="btnExit" class="btn btn-secondary">Thoát</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="form-content-bottom" class="row form-border disabledbutton">
					<div class="col-sm-6">
						<div class="form-group disabledbutton">
							<label class="col-sm-12 control-label" for="">Mã Phiếu Mượn</label>
							<div class="col-sm-12">
								<input class="form-control" name="soPhieuMuon" id="codeBorrow" type="text">
							</div>
						</div> <!-- end form-group -->
						<div class="form-group disabledbutton">
							<label class="col-sm-12 control-label" for="">Mã Sách</label>
							<div class="col-sm-12">
								<input class="form-control" id="codeBook" type="text">
							</div>
						</div> <!-- end form-group -->
						<div class="form-group">
							<label class="col-sm-12 control-label" for="">Ngày Mượn</label>
							<div class="col-sm-12"><input id="dayBorrow" class="form-control datepicker-here" name="ngayMuon" type="text" data-language='en'></div>
						</div> <!-- end form-group -->
						<div class="form-group">
							<label class="col-sm-12 control-label">Tình Trạng</label>
							<div class="col-sm-12">
								<select class="form-control" name="maSoNV">
									foreach($employees as $employee)
									<option value="{$employee['id']}}">
									{$employee['hoTenNV']}}</option>
									endforeach
								</select>
							</div>
						</div> <!-- end form-group -->
						<div class="form-group float-left">
							<div class="col-sm-12">
								<a href="#wrapper" id="btnCannel" class="btn btn-default">Phạt</a>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label class="col-sm-12 control-label" for="">Ngày Trả</label>
							<div class="col-sm-12">
								<input id="termBorrow" class="form-control datepicker-here" name="ngayTra" type="text" data-language='en'>
							</div>
						</div> <!-- end form-group -->
						<div class="form-group">
							<label class="col-sm-12 control-label" for="">Ghi Chú</label>
							<div class="col-sm-12">
								<textarea class="form-control" name="ghiChu" data-maxlength="500" cols="100" rows="8" style="height: 234px;"></textarea>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12">
								<input type="submit" id="btnAdd" name="btnAdd" class="btn btn-primary" value="Trả sách">
								<a href="#wrapper" id="btnCannel" class="btn btn-default">Hủy</a>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection



@section('scriptBottom')
<script>
// create array
var readers = [];
var books = [];
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
// get form
var formHeader = getElement('#form-header');
var formContentHeader = getElement('#form-content-header');

console.log(books)
btnCheckReader.onclick = function() {
	if(checkReader(codeReader.value)) {
		disableFormHeader();
		enableFormContentHeader();
		listBorrows = getBorrow(idReader);
	}
}
btnExit.onclick = function() {
	disableFormContentHeader();
	enableFormHeader();
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

// function renderListBorrowBooks(listBorrow) {
// 	var html = '';
// 	for (var i = 0; i < detailBorrows.length; i++) {
// 		detailBorrow = detailBorrows[i];
// 		html += '<option value="' + detailBorrow. + '">' + detailBorrow + '</option>';
// 	}
// 	setHTML('#listSelects', html);
// }

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

</script>
@endsection


