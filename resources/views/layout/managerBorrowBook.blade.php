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
			<form action="{route('post.manager.book.add')}}" method="POST" class="form-horizontal" role="form">
				@method('post')
				@csrf
				<div id="form-header" class="row form-border">
					<div class="col-sm-4">
						<div class="form-group disabledbutton">
							<label class="col-sm-12 control-label" for="">Mã Phiếu Mượn</label>
							<div class="col-sm-12">
								<input id="codeBorrow" class="form-control" name="maPhieuMuon" type="text" value="{{$borrowBooks[count($borrowBooks)-1]['soPhieuMuon']+1}}">
							</div>
						</div> <!-- end form-group -->
						<div class="form-group">
							<label class="col-sm-12 control-label" for="">Mã Độc Giả</label>
							<div class="col-sm-12">
								<input class="form-control" id="idReader" name="maSoDG" value="DG001" type="text">
							</div>
						</div> <!-- end form-group --> 
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label class="control-label">Nhân Viên</label>
							<div class="col-sm-12">
								<select class="form-control" name="idNV">
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

									</tr>
								</thead>
								<tbody id="tbodyBooks">
									<!-- insert data -->
								</tbody>
							</table>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label class="col-sm-12 control-label" for="">Mã Phiếu Mượn</label>
							<div class="col-sm-12">
								<input class="form-control" name="giaTien" type="text">
							</div>
						</div> <!-- end form-group -->
						<div class="form-group">
							<label class="col-sm-12 control-label" for="">Mã Sách</label>
							<div class="col-sm-12">
								<input class="form-control" name="giaTien" type="text">
							</div>
						</div> <!-- end form-group -->
						<div class="form-group float-right">
							<div class="col-sm-12">
								<a href="" class="btn btn-primary">+</a>
								<a href="" class="btn btn-primary">-</a>
								<a href="" class="btn btn-primary">x</a>
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
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-12 control-label" for="">Hạn Trả</label>
							<div class="col-sm-12"><input id="termBorrow" class="form-control datepicker-here" name="ngaySinhNV" type="text" data-language='en'></div>
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

	var books = [];
	insertDBArray();
	//console.log(books[books.length-1]);
	
	create.onclick = function(){
		if(checkReader(idReader)){
			var onDisabled = formHeader;
			var offDisabled = formContent;
			onOffDisabled(onDisabled, offDisabled);	
			insertDBTable();
			var htmlSL = '';
			var numberListSelect = 0;
			var rowBooks = document.querySelectorAll('#tbodyBooks tr');
			for (var i = 0; i < rowBooks.length; i++) {
				var rowBook = rowBooks[i];
				rowBook.onclick = function() {		
					numberListSelect = listSelects.childElementCount;
					if(numberListSelect<5){
						htmlSL += '<li class="nav-item">';
						htmlSL += '<a class="nav-link" href="">';
						htmlSL += '<span>'+this.cells[1].innerText+'</span>';
						htmlSL += '</a>';
						htmlSL += '</li>';
						listSelects.innerHTML = htmlSL;
					}else {

					}
					
				}
				
			}
		}else {}
	}

	btnCannel.onclick = function(){
		var onDisabled = formContent;
		var offDisabled = formHeader;
		onOffDisabled(onDisabled, offDisabled);	
		deleteDBTable();
	}

	function checkReader(idReader){
		for (var i = 0; i < readers.length; i++) {
			var reader = readers[i]['maSoDG'];
			if(idReader.value == reader){
				return true;
			}else {
				alert("Mã số độc giả không hợp lệ !!!");
				return false;
			}
		}
		
	}
	
	function onOffDisabled(on, off) {
		on.classList.add('disabledbutton');
		off.classList.remove('disabledbutton');
	}
	
	function insertReadersArray(){
		@foreach($readers as $reader)
		readers.push({maSoDG:"{{$reader['maSoDG']}}"});
		@endforeach
	}

	function insertDBArray(){
		@foreach($books as $book)
		books.push({maSoSach:"{{$book->maSoSach}}",
			tenSach :"{{$book->tenSach}}",
			loaiSach:"{{$book->loaiSach}}",
			tacGia  :"{{$book->tacGia}}",
			hoTenNXB:"{{$book->hoTenNXB}}"});
		@endforeach
	}
	function insertDBTable(){
		var html = '';
		for (var book of books) {
			html += '<tr class="tr-info">';
			html += '<td>' + book.maSoSach + '</td>';
			html += '<td>' + book.tenSach  + '</td>';
			html += '<td>' + book.loaiSach + '</td>';
			html += '<td>' + book.tacGia   + '</td>';
			html += '<td>' + book.hoTenNXB + '</td>';
			html += '</tr>';
		}
		tbodyBooks.innerHTML = html;
	}
	
	function deleteDBTable(){
		var html = '';
		tbodyBooks.innerHTML = html;
		htmlSL = '';
		listSelects.innerHTML = htmlSL;
	}
</script>
@endsection


