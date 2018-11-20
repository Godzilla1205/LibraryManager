@extends('index')

@section("datepicker")
<link href="{{asset('vendor/dist/css/datepicker.min.css')}}" rel="stylesheet" type="text/css">
<script src="{{asset('vendor/dist/js/datepicker.min.js')}}"></script>
<script src="{{asset('vendor/dist/js/i18n/datepicker.en.js')}}"></script>
@endsection

@section("menu-manager-readers")
sl-active
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{route('get.manager')}}">Trang chủ</a>
  </li>
  <li class="breadcrumb-item">
    <a href="{{route('get.manager.readers')}}">Quản lý độc giả</a>
  </li>
  <li class="breadcrumb-item active">
    Thêm mới
  </li> 
</ol>
@endsection

@section('content')
<div class="container-fluid">
 <div class="card">
  <div class="card-body">
    <h2 class="text-center">Thêm mới độc giả</h2>
    <br/>  
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          @if ($errors->any())
          <div class="alert alert-danger alert-dismissible">
            <a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div><br />
          @endif
          @if (Session::has('success'))
          <div class="alert alert-success alert-dismissible">
            <a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong> {{ Session::get('success') }}
          </div>
          @endif
        </div>
      </div>
    </div> 
    <form action="{{route('post.manager.readers.add')}}" method="POST" class="form-horizontal" role="form">
      @method('post')
      @csrf
      <div class="row">
        <div class="col-sm-4">
          <div class="form-group">
            <label class="col-sm-12 control-label" for="">Mã Số Độc Giả</label>
            <div class="col-sm-12">
              <input class="form-control" name="maSoDG" type="text">
            </div>
          </div> <!-- end form-group -->
          <div class="form-group">
            <label class="col-sm-12 control-label" for="">Họ Tên</label>
            <div class="col-sm-12">
              <input class="form-control" name="hoTenDG" type="text">
            </div>
          </div> <!-- end form-group --> 
          <div class="form-group">
            <div class="col-sm-12">
                <label class="control-label">Giới Tính</label>
                <select class="form-control" name="gioiTinh">
                  <option value="1">Nam</option>
                  <option value="0">Nữ</option>
                </select>
            </div>
          </div> <!-- end form-group -->
          <div class="form-group">
            <label class="col-sm-12 control-label" for="">Ngày Sinh</label>
            <div class="col-sm-12"><input class="form-control datepicker-here" name="ngaySinh" type="text" data-language='en'></div>
          </div> <!-- end form-group -->
          <div class="form-group">
            <div class="col-sm-12">
              <label class="control-label">Khoa</label>
              <select class="form-control" name="idKhoa">
               @foreach($facultys as $faculty)
               <option value="{{$faculty['id']}}">{{$faculty['tenKhoa']}}</option>
               @endforeach
             </select>
           </div>
         </div> <!-- end form-group -->
        </div>
        <div class="col-sm-4">
         <div class="form-group">
            <label class="col-sm-12 control-label" for="">Ngày Cấp</label>
            <div class="col-sm-12"><input class="form-control datepicker-here" name="ngayCap" type="text" data-language='en'></div>
          </div> <!-- end form-group -->
         <div class="form-group">
            <label class="col-sm-12 control-label" for="">Hạn Sử Dụng</label>
            <div class="col-sm-12"><input class="form-control datepicker-here" name="hansuDung" type="text" data-language='en'></div>
          </div> <!-- end form-group -->
       <div class="form-group">
        <label class="col-sm-12 control-label" for="">Email</label>
        <div class="col-sm-12">
          <input class="form-control" name="email" type="text">
        </div>
      </div> <!-- end form-group --> 
      <div class="form-group">
        <label class="col-sm-12 control-label" for="">Địa Chỉ</label>
        <div class="col-sm-12">
          <input class="form-control" name="diaChiDG" type="text">
        </div>  
      </div> <!-- end form-group --> 
    </div>
  </div>
  <div class="row">
    <div class="col-sm-8">
      <div class="form-group">
        <div class="col-sm-12">
          <input type="submit" name="btnAdd" class="btn btn-primary" value="Thêm">
          <a href="{{route('get.manager.readers')}}" class="btn btn-default">Thoát</a>
        </div>
      </div>
    </div>
  </div>
</form>
</div>
</div>
</div>
@endsection



