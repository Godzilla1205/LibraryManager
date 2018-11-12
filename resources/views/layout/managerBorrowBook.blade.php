@extends('index')

@section("datepicker")
<link href="{{asset('vendor/dist/css/datepicker.min.css')}}" rel="stylesheet" type="text/css">
<script src="{{asset('vendor/dist/js/datepicker.min.js')}}"></script>
<script src="{{asset('vendor/dist/js/i18n/datepicker.en.js')}}"></script>
@endsection

@section("menu-manager-borrowBook")
sl-active
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item">
		<a href="{{route('get.manager')}}">Trang chủ</a>
	</li>
	<li class="breadcrumb-item active">
		Tạo phiếu mượn
	</li> 
</ol>
@endsection

@section('content')
<div id="content" class="container-fluid">
	<div class="card">
		<div class="card-body">
			<h2 class="text-center">Tạo Phiếu Mượn</h2>
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
			<form action="{{route('post.manager.borrowBook')}}" method="POST" class="form-horizontal" role="form">
				@method('post')
				@csrf
				<div id="form-header" class="row form-border">
					<div class="col-sm-4">
						<div class="form-group disabledbutton">
							<label class="col-sm-12 control-label" for="">Mã Phiếu Mượn</label>
							<div class="col-sm-12">
								<input id="codeBorrow" class="form-control" name="soPhieuMuon" type="text" value="@if(isset($borrowBooks[count($borrowBooks)-1]->soPhieuMuon)){{$borrowBooks[count($borrowBooks)-1]->soPhieuMuon+1}}@else{{1}}@endif">
							</div>
						</div> <!-- end form-group -->
						<div class="form-group">
							<label class="col-sm-12 control-label" for="">Mã Độc Giả</label>
							<div class="col-sm-12">
								<input class="form-control" id="idReader" value="DG002" type="text">
								<input type="hidden" id="maSoDG" name="maSoDG">
							</div>
						</div> <!-- end form-group --> 
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label class="control-label">Nhân Viên</label>
							<div class="col-sm-12">
								<select class="form-control" name="maSoNV">
									@foreach($employeess as $employees)
									<option value="{{$employees['id']}}">
									{{$employees['hoTenNV']}}</option>
									@endforeach
								</select>
							</div>
						</div> <!-- end form-group -->
						<div class="form-group">
							<label class="col-sm-12 control-label" for="">Ngày Mượn</label>
							<div class="col-sm-12"><input id="dayBorrow" class="form-control datepicker-here" name="ngayMuon" type="text" data-language='en'></div>
						</div> <!-- end form-group -->
					</div>
					<div class="col-sm-4">
						<div class="form-group float-right">
							<div class="col-sm-12">
								<a href="#" id="create" class="btn btn-secondary">Tạo mới</a>
								<a href="{{route('get.manager')}}" class="btn btn-default">Thoát</a>
							</div>
						</div>
					</div>
				</div>
				<div id="form-content" class="row form-border disabledbutton">
					<div class="col-sm-8">
						<div class="table-responsive-xl">
							<table class="table table-sm table-hover">
								<thead class="thead-light">
									<tr>
										<th scope="col">Mã Sách</th>
										<th scope="col">Tên Sách</th>
										<th scope="col">Loại Sách</th>
										<th scope="col">Tác Giả</th>
										<th scope="col">NXB</th>
										<th scope="col">Còn</th>
									</tr>
								</thead>
								<tbody id="tbodyBooks" class="cursorPointer">
									<!-- insert data -->
								</tbody>
							</table>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group disabledbutton">
							<label class="col-sm-12 control-label" for="">Mã Phiếu Mượn</label>
							<div class="col-sm-12">
								<input class="form-control" name="soPhieuMuonEnd" id="codeBorrowEnd" type="text">
							</div>
						</div> <!-- end form-group -->
						<div class="form-group">
							<label class="col-sm-12 control-label" for="">Mã Sách</label>
							<div class="col-sm-12">
								<input class="form-control" id="codeBook" type="text">
							</div>
						</div> <!-- end form-group -->
						<div class="form-group float-right">
							<div class="col-sm-12">
								<a id="addBook" href="javascript:void(0)" class="btn btn-secondary waves-effect waves-light disabledbutton"><i class="fa fa-plus"></i></a>
								<a id="editBook" href="javascript:void(0)" class="btn btn-secondary waves-effect waves-light disabledbutton"><i class="fa fa-minus"></i></a>
								<a id="deleteBook" href="javascript:void(0)" class="btn btn-secondary waves-effect waves-light disabledbutton"><i class="fa fa-times"></i></a>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-12 control-label" for="">Mã Chọn</label>
							<div class="row select-border">
								<div class="col-md-12">
									<ul id="listSelects" class="side-nav select-sider-menu">
										<!-- insert listSelects -->
									</ul>
								</div>
								<input type="hidden" id="Book_ids" name="Book_ids" class="btn btn-primary">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-12 control-label" for="">Hạn Trả</label>
							<div class="col-sm-12"><input id="termBorrow" class="form-control datepicker-here" name="hanTra" type="text" data-language='en'></div>
						</div> <!-- end form-group -->
						<div class="form-group float-right">
							<div class="col-sm-12">
								<input type="submit" id="btnAdd" name="btnAdd" class="btn btn-primary" value="Xác Nhận">
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
	var create = document.getElementById('create');
	var formContent = document.getElementById('form-content');
	var formHeader = document.getElementById('form-header');
	var btnCannel = document.getElementById('btnCannel');
	var tbodyBooks = document.getElementById('tbodyBooks');
	var codeBorrow = document.getElementById('codeBorrow');
	var dayBorrow = document.getElementById('dayBorrow');
	var termBorrow = document.getElementById('termBorrow');
	var idReader = document.getElementById('idReader');
	var listSelects = document.getElementById('listSelects');
	var Book_ids = document.getElementById('Book_ids');
	
	// get Date
	var date = new Date();
	var month = date.getMonth()+1;
	var day = date.getDate();
	var yeah = date.getFullYear();
	var toDay = month+"/"+day+"/"+yeah;
	dayBorrow.value = toDay;
	termBorrow.value = toDay;
	var readers = [];
	insertReadersArray();
	var numberListSelect = 5;
	var books = [];
	var detailBorrows = [];
	var detailBorrow = [];
	insertDBArray();
	//console.log(books[books.length-1]);
	
	create.onclick = function(){
		if(checkReader(idReader.value)){
			var onDisabled = formHeader;
			var offDisabled = formContent;
			onOffDisabled(onDisabled, offDisabled);	
			insertDBTable();
			var htmlSL = '';
			var rowBooks = document.querySelectorAll('#tbodyBooks tr');
			var codeBorrowEnd = document.getElementById('codeBorrowEnd');
			var codeBook = document.getElementById('codeBook');
			codeBorrowEnd.value = codeBorrow.value;
			var giveBook;
			for (var i = 0; i < rowBooks.length; i++) {
				var rowBook = rowBooks[i];
				rowBook.onclick = function() {
					var idBook = this.firstChild.defaultValue;
					// console.log(idBook);
					// console.log(getBook(idBook));
					giveBook = [getBook(idBook)];
					// console.log(giveBook)
					// this.firstChild.defaultValue,
					// this.cells[0].innerText,
					// this.cells[1].innerText,
					// this.cells[5].innerText
					
					codeBook.value = giveBook[0].maSoSach;

					deActiveRow('.tr-info.row-active');
					deActiveRow('.nav-item.cursorPointer.row-active');
					this.classList.add('row-active');
					enableBtnAdd();
					disableBtnEdit();
					disableBtnDelete();
				}

			}




			codeBook.onkeyup = function() {
				deActiveRow('.tr-info.row-active');
				deActiveRow('.nav-item.cursorPointer.row-active');
				enableBtnAdd();
				enableBtnEdit();
				enableBtnDelete();
			}

			var BookObjects = [];
			var addBook = document.getElementById('addBook');
			var deleteBook = document.getElementById('deleteBook');
			var editBook = document.getElementById('editBook');

			function formatText(str, start, end, replace) {
				if(str.length>end) {
					str = str.slice(start,end) + replace;
				}
				return str;
			}

			addBook.onclick = function() {
				var numberBook = giveBook[0].soLuong;
				var nameBook = giveBook[0].tenSach;
				var idBook = giveBook[0].id;
				nameBook = formatText(nameBook, 0, 20, "...");
				if(numberBook>0){
					if(checkDetailBorrows(idBook)){
						if(checkObject(BookObjects, giveBook)){
							if(numberListSelect>0){
								htmlSL += '<li class="nav-item cursorPointer">';
								htmlSL += '<a class="nav-link" href="javascript:void(0)">';
								htmlSL += '<span><span class="spanCodeBook">'+ codeBook.value + "</span> | 	" +  nameBook + '</span>';
								htmlSL += '</a>';
								htmlSL += '</li>';
								listSelects.innerHTML = htmlSL;
								BookObjects.push(giveBook);
								createSelectItem();
								addBook_ids(BookObjects);
								codeBook.value = "";
								disableBtnAdd();
								numberListSelect -= 1;
							}else {
								alert('Quá giới hạn cho mượn sách của độc giả này !!!');
							}
						}else {
							alert('Sách đã được chọn rồi!!!');
						}
					}else {
						alert('Độc giả đã mượn sách này trước đó !!!');
					}

				}else {
					alert('Số lượng sách đã hết không thể mượn thêm !!!');
				}			
			}
			
			
			deleteBook.onclick = function() {
				if(codeBook.value !== "") {
					if(BookObjects == false) {
						console.log('Không có thằng nào để xóa !!!');
					}else {
						console.log('Xóa theo id');
					}

				}else {
					alert("Cháu không biết !!!");
				}
			}

			editBook.onclick = function() {

			}



		}else {}
	}

	btnCannel.onclick = function(){
		var onDisabled = formContent;
		var offDisabled = formHeader;
		onOffDisabled(onDisabled, offDisabled);	
		deleteDBTable();
	}

	function addBook_ids(BookObjects){
		Book_ids.value = "";
		//console.log(BookObjects)
		for (var i = 0; i < BookObjects.length; i++) {
			var BookObject = BookObjects[i];
			var book_id = BookObject[0];
			Book_ids.value += book_id + ",";
		}
		//console.log(Book_ids.value)
	}

	function getBook(id) {
		for (var i = 0; i < books.length; i++) {
			book = books[i];
			if(book.id == id) {
				return book;
			}else {}
		}
		return null;
	}
	function enableBtnAdd() {
		addBook.classList.remove('disabledbutton');
	}
	function disableBtnAdd() {
		addBook.classList.add('disabledbutton');
	}
	function enableBtnEdit() {
		editBook.classList.remove('disabledbutton');
	}
	function disableBtnEdit() {
		editBook.classList.add('disabledbutton');
	}
	function enableBtnDelete() {
		deleteBook.classList.remove('disabledbutton');
	}
	function disableBtnDelete() {
		deleteBook.classList.add('disabledbutton');
	}


	function createSelectItem(){
		var itemSelects = document.querySelectorAll('.nav-item.cursorPointer');
		for (var i = 0; i < itemSelects.length; i++) {
			itemSelect = itemSelects[i];
			itemSelect.onclick = function() {
				var res = this.innerText.split(' | ');
				codeBook.value = res[0];
				deActiveRow('.tr-info.row-active');
				deActiveRow('.nav-item.cursorPointer.row-active');
				this.classList.add('row-active');
				disableBtnAdd();
				enableBtnEdit();
				enableBtnDelete();
			}
		}
	}

	function checkObject(BookObjects,giveBook){
		for (var i = 0; i < BookObjects.length; i++) {
			var BookObject = BookObjects[i];
			if(BookObject[0] == giveBook[0]){
				return false;
			}else {}
		}
		return true;
	}

	function checkReader(idReader){
		for (var i = 0; i < readers.length; i++) {
			var reader = readers[i]['maSoDG'];
			if(idReader == reader){
				var maSoDG = document.getElementById("maSoDG");
				maSoDG.value = readers[i]['id'];
				console.log(detailBorrows)
				for (var i = 0; i < detailBorrows.length; i++) {
					if(detailBorrows[i]['maSoDG'] == maSoDG.value) {
						var numberBookBorrow = detailBorrows[i]['maSoSach'].length;
						var maxBorrowBook = 5;
						if(numberBookBorrow == maxBorrowBook){
							alert("Độc giả đã mượn " + maxBorrowBook + " quyển sách không thể mượn thêm !!!");
							return false;
						}else {
							numberListSelect = maxBorrowBook - numberBookBorrow;
							detailBorrow = detailBorrows[i];
						}
					}else {}
				}
				alert("Độc giả có thể mượn " + numberListSelect + " quyển sách !!!")
				return true;
			}else {}
		}
		alert("Mã số độc giả không hợp lệ !!!");
		return false;

	}


	function onOffDisabled(on, off) {
		on.classList.add('disabledbutton');
		off.classList.remove('disabledbutton');
	}

	function deActiveRow(selector) {
		var rowBook = document.querySelectorAll(selector);
		for (var i = 0; i < rowBook.length; i++) {
			var rowBook = rowBook[i];
			rowBook.classList.remove('row-active');
		}
	}

	function insertReadersArray(){
		@foreach($readers as $reader)
		readers.push({id:"{{$reader['id']}}", maSoDG:"{{$reader['maSoDG']}}"});
		@endforeach
	}

	function insertDBArray(){
		@foreach($books as $book)
		books.push({
			id:"{{$book->id}}",
			maSoSach :"{{$book->maSoSach}}",
			tenSach :"{{$book->tenSach}}",
			loaiSach:"{{$book->loaiSach}}",
			tacGia  :"{{$book->tacGia}}",
			hoTenNXB:"{{$book->hoTenNXB}}",
			soLuong:"{{$book->soLuong}}"})
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
		console.log(detailBorrows)
	}
	function checkDetailBorrows(idBook) {
		//console.log("id muon:" + idBook);
		if(detailBorrow['maSoSach'] != null){
			for (var i = 0; i < detailBorrow['maSoSach'].length; i++) {
				//console.log("id muon truoc do:" + detailBorrow['maSoSach'][i])
				if(detailBorrow['maSoSach'][i] == idBook){
					return false;
				} else {}
			}
		}
		return true;
	}

	function insertDBTable(){
		var html = '';
		for (var book of books) {
			html += '<tr class="tr-info">';
			html += '<input type="hidden" value="' + book.id + '"/>';
			html += '<td>' + book.maSoSach + '</td>';
			html += '<td>' + book.tenSach  + '</td>';
			html += '<td>' + book.loaiSach + '</td>';
			html += '<td>' + book.tacGia   + '</td>';
			html += '<td>' + book.hoTenNXB + '</td>';
			html += '<td>' + book.soLuong + '</td>';
			html += '</tr>';
		}
		tbodyBooks.innerHTML = html;
	}

	function deleteDBTable(){
		var html = '';
		tbodyBooks.innerHTML = html;
		htmlSL = '';
		listSelects.innerHTML = htmlSL;
		detailBorrow = [];
		numberListSelect = 5;
		codeBorrowEnd.value = "";
		codeBook.value = "";
	}
</script>
@endsection


