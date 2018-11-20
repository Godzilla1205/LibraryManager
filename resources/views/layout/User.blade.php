@extends('index')

@section("menu-admin")
active
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{route('get.manager')}}">Trang chủ</a>
  </li>
  <li class="breadcrumb-item active">
    Tài khoản của tôi
  </li> 
</ol>
@endsection

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-6 col-md-6 col-lg-6 mt-6">
      <div class="card">
        <a class="img-background" href="#">
          <img class="card-img-top h-262" src="{{asset('images/onecentimets.jpg')}}">
        </a>
        <a class="img-background" href="#">
          <img class="img-avatar" src="{{asset('images/icon-user.png')}}">
        </a>

        <h4 class="name-user card-title text-center">{{$user->name}}</h4>
        <div class="info-user card-block">
          <div class="card-text">
            <p>User Name: <span class="detail-user">{{$user->username}}</span></p>
            <p>Account: @if($user->level==1){{"admin"}}@else{{"normal"}}@endif</p>
            <p>Email: {{$user->email}}</p>
          </div>
        </div>
        <div class="card-footer">
          <!-- bla -->
        </div>
      </div>
    </div>
    {{-- <div class="col-sm-6 col-md-6 col-lg-6 mt-6">
      <div class="card">
        <div class="form-group">
          <label class="col-sm-4 control-label" for="">User Name</label>
          <div class="col-sm-12">
            <input class="form-control" name="maSoSach" type="text">
          </div>
        </div> <!-- end form-group -->
        <div class="form-group">
          <label class="col-sm-12 control-label" for="">Tên Sách</label>
          <div class="col-sm-12">
            <input class="form-control" name="tenSach" type="text">
          </div>
        </div> <!-- end form-group --> 
        <div class="form-group">
          <label class="col-sm-12 control-label" for="">Tác Giả</label>
          <div class="col-sm-12">
            <input class="form-control" name="tacGia" type="text">
          </div>
        </div> <!-- end form-group --> 
      </div>
    </div> --}}
  </div>
</div>
@endsection




