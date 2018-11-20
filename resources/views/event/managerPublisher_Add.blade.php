@extends('index')

@section("menu-manager-publisher")
sl-active
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{route('get.manager')}}">Trang chủ</a>
  </li>
  <li class="breadcrumb-item">
    <a href="{{route('get.manager.publisher')}}">Quản lý nhà xuất bản</a>
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
    <h2 class="text-center">Thêm mới nhà xuất bản</h2>
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
    <form action="{{route('post.manager.publisher.add')}}" method="POST" class="form-horizontal" role="form">
      @method('post')
      @csrf
      <div class="form-group">
        <label class="col-sm-2 control-label" for="">Mã NXB</label>
        <div class="col-sm-5">
          <input class="form-control" name="maSoNXB" type="text">
        </div>
      </div> <!-- end form-group -->
      <div class="form-group">
        <label class="col-sm-3 control-label" for="">Tên NXB</label>
        <div class="col-sm-5">
          <input class="form-control" name="hoTenNXB" type="text">
        </div>
      </div> <!-- end form-group --> 
      <div class="form-group">
        <label class="col-sm-3 control-label" for="">Địa Chỉ</label>
        <div class="col-sm-5"><input class="form-control" name="diaChiNXB" type="text"></div>
      </div> <!-- end form-group --> 
      <div class="form-group">
        <label class="col-sm-3 control-label" for="">Web Site</label>
        <div class="col-sm-5"><input class="form-control" name="websiteNXB" type="text"></div>
      </div> <!-- end form-group -->
      <div class="form-group">
        <label class="col-sm-3 control-label" for="">Thông tin khác</label>
        <div class="col-sm-5"><input class="form-control" name="thongTinKhacNXB" type="text"></div>
      </div> <!-- end form-group -->
      <div class="form-group">
        <div class="col-sm-5 col-sm-offset-3">
          <input type="submit" name="btnAdd" class="btn btn-primary" value="Thêm">
          <a href="{{route('get.manager.publisher')}}" class="btn btn-default">Thoát</a>
        </div>
      </div> <!-- end form-group -->
    </form>
  </div>
</div>
</div>

@endsection




