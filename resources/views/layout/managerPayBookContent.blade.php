@extends('layout.managerPayBook')

@section('form-content')
<form action="{{action('PayBookController@postPayBookContent', $maSoDG)}}" method="POST" class="form-horizontal" role="form">
	@method('post')
	@csrf
	<div id="form-header" class="row form-border disabledbutton">
		<div class="col-sm-4">
			<div class="form-group">
				<label class="col-sm-12 control-label" for="">Mã Độc Giả</label>
				<div class="col-sm-12">
					<input class="form-control" id="codeReader" value="{{$maSoDG}}" type="text">
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
	<div id="form-content-header" class="row form-border">
		<div class="col-sm-12">
			<div class="container">
				<div class="row">
					<div class="col-sm-3">
						<span class="form-control-label">Chọn cuốn sách mang trả</span>
					</div>
					<div class="col-sm-6">
						<select class="form-control" id="listBorrowBooks">
							<option value="-1">---</option>
							@foreach($detailBorrows as $detailBorrow)
							<option value="{{$detailBorrow->idSach}}">{{$detailBorrow->tenSach}}</option>
							@endforeach
						</select>
					</div>
					<div class="col-sm-2 offset-1">
						<a href="{{route('get.manager.payBook')}}" id="btnExit" class="btn btn-secondary">Thoát</a>
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
					<input class="form-control" id="maSoSach" name="maSoSach" type="hidden">
				</div>
			</div> <!-- end form-group -->
			<div class="form-group disabledbutton">
				<label class="col-sm-12 control-label" for="">Ngày Mượn</label>
				<div class="col-sm-12"><input id="dayBorrow" class="form-control datepicker-here" name="ngayMuon" type="text" data-language='en'></div>
			</div> <!-- end form-group -->
			<div class="form-group disabledbutton">
				<label class="col-sm-12 control-label">Tình Trạng</label>
				<div class="col-sm-12">
					<select class="form-control" id="trangThai" name="trangThai">
						<option value="0">Chưa trả sách</option>
						<option value="1">Đã trả sách</option>
					</select>
				</div>
			</div> <!-- end form-group -->
			<div class="form-group float-left">
				<div class="col-sm-12">
					<a href="#wrapper" id="btnPhat" class="btn btn-default">Phạt</a>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label class="col-sm-12 control-label" for="">Ngày Trả</label>
				<div class="col-sm-12">
					<input id="ngayTra" class="form-control datepicker-here" name="ngayTra" type="text" data-language='en'>
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
					<a href="javascript:void(0)" id="btnCannel" class="btn btn-default">Hủy</a>
				</div>
			</div>
		</div>
	</div>
</form>
@endsection

@section('scriptBottom')
<script>

var detailBorrows = [];

var listBorrowBooks = getElement('#listBorrowBooks');

var btnCannel = getElement('#btnCannel');
var ngayTra = document.getElementById('ngayTra');
var formContentHeader = getElement('#form-content-header');
var formContentBottom = getElement('#form-content-bottom');
insertDBArray();

// get Date
var date = new Date();
var month = date.getMonth()+1;
var day = date.getDate();
var yeah = date.getFullYear();
var toDay = month + "/" + day + "/" + yeah;


btnCannel.onclick = function() {
	listBorrowBooks.value = -1;
	deFormPay();
	enableFormContentHeader();
	disableFormContentBottom();
}

listBorrowBooks.onchange = function() {
	if(listBorrowBooks.value == -1){
	} else {
		enableFormContentBottom();
		disableFormContentHeader();
		for (var i = 0; i < detailBorrows.length; i++) {
			detailBorrow = detailBorrows[i];
			if(listBorrowBooks.value == detailBorrow.idSach ) {
				// Insert
				readerFormPay(detailBorrow);
			}
		}
	}
	
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


function getElement(selector) {
	var element = document.querySelector(selector);
	return element;
}
function setHTML(selector, html) {
	var element = document.querySelector(selector);
	element.innerHTML = html;
}
function setValue(selector, value) {
	var element = document.querySelector(selector);
	element.value = value;
}


/*---------------------------------- render ----------------------------------------*/	

function readerFormPay(detailBorrow) {
	setValue('#codeBorrow', detailBorrow.soPhieuMuon);
	setValue('#codeBook', detailBorrow.maSoSach);
	setValue('#maSoSach', detailBorrow.idSach);
	setValue('#dayBorrow', detailBorrow.ngayMuon);
	setValue('#trangThai', detailBorrow.trangThai);
	ngayTra.value = toDay;
}


function deFormPay() {
	setValue('#codeBorrow', '');
	setValue('#codeBook', '');
	setValue('#maSoSach', '');
	setValue('#dayBorrow','');
	setValue('#trangThai', '');
	ngayTra.value = '';
}

/*-------------------------------- end render --------------------------------------*/


/*------------------------------- insert by DB -------------------------------------*/
function insertDBArray() { 
	@foreach($detailBorrows as $detailBorrow)
	detailBorrows.push({
		soPhieuMuon:"{{$detailBorrow->soPhieuMuon}}",
		idSach:"{{$detailBorrow->idSach}}",
		maSoSach :"{{$detailBorrow->maSoSach}}",
		ngayMuon :"{{$detailBorrow->ngayMuon}}",
		trangThai:"{{$detailBorrow->trangThai}}"})
	@endforeach
}

</script>
@endsection


