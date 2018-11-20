@extends('index')

@section("datepicker")
<link href="{{asset('vendor/dist/css/datepicker.min.css')}}" rel="stylesheet" type="text/css">
<script src="{{asset('vendor/dist/js/datepicker.min.js')}}"></script>
<script src="{{asset('vendor/dist/js/i18n/datepicker.en.js')}}"></script>
@endsection

@section("menu-admin")
active
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{route('get.manager')}}">Trang chủ</a>
  </li>
  <li class="breadcrumb-item">
    <a href="{{route('get.manager.employees')}}">Quản lý nhân viên</a>
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
    <h2 class="text-center">Thêm mới nhân viên</h2>
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
    <form action="{{route('post.manager.employees.add')}}" method="POST" class="form-horizontal" enctype="multipart/form-data" role="form">
      @method('post')
      @csrf
      <div class="row">
        <div class="col-sm-4">
          <div class="form-group">
            <label class="col-sm-12 control-label" for="">Mã Số NV</label>
            <div class="col-sm-12">
              <input class="form-control" name="maSoNV" type="text">
            </div>
          </div> <!-- end form-group -->
          <div class="form-group">
            <label class="col-sm-12 control-label" for="">Họ Tên NV</label>
            <div class="col-sm-12">
              <input class="form-control" name="hoTenNV" type="text">
            </div>
          </div> <!-- end form-group --> 
          <div class="form-group">
            <label class="col-sm-12 control-label" for="">Địa Chỉ</label>
            <div class="col-sm-12"><input class="form-control" name="diaChiNV" type="text"></div>
          </div> <!-- end form-group --> 
          <div class="form-group">
            <label class="col-sm-12 control-label" for="">Ngày Sinh</label>
            <div class="col-sm-12"><input class="form-control datepicker-here" name="ngaySinhNV" type="text" data-language='en'></div>
          </div> <!-- end form-group -->
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            <div class="col-sm-12">
              <label class="control-label">Giới Tính</label>
              <select class="form-control" name="gioiTinhNV">
                <option value="1">Nam</option>
                <option value="0">Nữ</option>
              </select>
            </div>
          </div> <!-- end form-group -->
          <div class="form-group">
            <label class="col-sm-12 control-label" for="">Số Điện Thoại</label>
            <div class="col-sm-12"><input class="form-control" name="soDTNV" type="text"></div>
          </div> <!-- end form-group -->
          <div class="form-group">
            <label class="col-sm-12 control-label" for="">Email</label>
            <div class="col-sm-12"><input class="form-control" name="emailNV" type="text"></div>
          </div> <!-- end form-group -->
          <div class="form-group">
            <label class="col-sm-12 control-label" for="">Ngày Vào làm</label>
            <div class="col-sm-12"><input class="form-control datepicker-here" name="ngayVaoLam" type="text" data-language='en'></div>
          </div> <!-- end form-group -->
        </div>
        <div class="col-sm-4">
          <fieldset class="form-group">
            <img class="form-control card-img-top img-fluid" src="{{asset('images/employees/FImage.jpg')}}" id="img" style="height: auto; width: 300px; margin-top:20px; ">
            <input type="file" id="avatar" name="avatar" onchange="AutoUpload();">
            <input type="hidden" id="avatarHidden" name="avatarHidden" value="">
          </fieldset>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12 col-sm-offset-5">
          <div class="form-group">
            <input type="submit" name="btnAdd" class="btn btn-primary" value="Thêm">
            <a href="{{route('get.manager.employees')}}" class="btn btn-default">Thoát</a>
          </div> <!-- end form-group -->
        </div>
      </div>
    </form>
  </div>
</div>
</div>
@endsection


@section('scriptBottom')
<script> 
  function AutoUpload() {
   var avatar = document.getElementById("avatar").value;
   var img = document.getElementById("img");
   console.log(avatar)
   var res = avatar.split('\\');
   var resImg = img.src.split('/');
   avatar = res[res.length-1];
   resImg[resImg.length-1] = avatar;
   console.log(resImg);
   img.src = resImg.join("/");
 }
</script>
@endsection



