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
    Sửa
  </li> 
</ol>
@endsection

@section('content')
<div class="container-fluid">
 <div class="card">
  <div class="card-body">
    <h2 class="text-center">Sửa nhà xuất bản</h2>
    <br/>  
    <form action="{{action('PublisherController@postManagerPublisher_Edit',$id)}}" method="POST" class="form-horizontal" role="form">
      @method('post')
      @csrf
      <div class="form-group">
        <label class="col-sm-2 control-label" for="">Mã NXB</label>
        <div class="col-sm-5">
          <input class="form-control" name="maSoNXB" type="text" value="{{$publisher['maSoNXB']}}">
        </div>
      </div> <!-- end form-group -->
      <div class="form-group">
        <label class="col-sm-3 control-label" for="">Tên NXB</label>
        <div class="col-sm-5">
          <input class="form-control" name="hoTenNXB" type="text" value="{{$publisher['hoTenNXB']}}">
        </div>
      </div> <!-- end form-group --> 
      <div class="form-group">
        <label class="col-sm-3 control-label" for="">Địa Chỉ</label>
        <div class="col-sm-5"><input class="form-control" name="diaChiNXB" type="text" value="{{$publisher['diaChiNXB']}}"></div>
      </div> <!-- end form-group --> 
      <div class="form-group">
        <label class="col-sm-3 control-label" for="">Web Site</label>
        <div class="col-sm-5"><input class="form-control" name="websiteNXB" type="text" value="{{$publisher['websiteNXB']}}"></div>
      </div> <!-- end form-group -->
      <div class="form-group">
        <label class="col-sm-3 control-label" for="">Thông tin khác</label>
        <div class="col-sm-5"><input class="form-control" name="thongTinKhacNXB" type="text" value="{{$publisher['thongTinKhacNXB']}}"></div>
      </div> <!-- end form-group -->
      <div class="form-group">
        <div class="col-sm-5 col-sm-offset-3">
          <input type="submit" name="btnUpdate" class="btn btn-primary" value="Update">
          <a href="{{route('get.manager.publisher')}}" class="btn btn-default">Thoát</a>
        </div>
      </div> <!-- end form-group -->
    </form>
  </div>
  <div class="container float-right">
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
</div>
</div>

@endsection




