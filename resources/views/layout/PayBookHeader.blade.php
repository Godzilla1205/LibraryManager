@extends('layout.PayBook')

@section('form-content')
<form action="" method="POST" class="form-horizontal" role="form">
	@method('post')
	@csrf
	<div id="form-header" class="row form-border">
		<div class="col-sm-4">
			<div class="form-group">
				<label class="col-sm-12 control-label" for="">Mã Độc Giả</label>
				<div class="col-sm-12">
					<input class="form-control" id="codeReader" type="text">
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
					<a href="javascript:void(0)" id="btnCheckReader" class="btn btn-secondary">Kiểm tra</a>
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
					<select class="form-control" name="trangThai">
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
	var codeReader = document.querySelector('#codeReader');
	var btnCheckReader = document.querySelector('#btnCheckReader');

	codeReader.onkeyup = function() {
		btnCheckReader.setAttribute('href',"{{action('PayBookController@getPayBookContent',"")}}" + "/" + codeReader.value);

	}
</script>
@endsection


