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
  <li class="breadcrumb-item">
    <a href="{{action('ReadersController@getManagerReaders_Detail',$id)}}">Thông tin chi tiết</a>
  </li>
  <li class="breadcrumb-item active">
    Sửa thông tin
  </li> 
</ol>
@endsection

@section('content')
<div class="container-fluid">
 <div class="card">
  <div class="card-body">
    <h2 class="text-center">Sửa thông tin độc giả</h2>
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
    <form action="{{action('ReadersController@postManagerReaders_Edit',$id)}}" method="POST" class="form-horizontal" role="form">
      @method('post')
      @csrf
      <div class="row">
        <div class="col-sm-4">
          <div class="form-group">
            <label class="col-sm-12 control-label" for="">Mã Số Độc Giả</label>
            <div class="col-sm-12">
              <input class="form-control" name="maSoDG" type="text" value="{{$reader->maSoDG}}">
            </div>
          </div> <!-- end form-group -->
          <div class="form-group">
            <label class="col-sm-12 control-label" for="">Họ Tên</label>
            <div class="col-sm-12">
              <input class="form-control" name="hoTenDG" type="text" value="{{$reader->hoTenDG}}">
            </div>
          </div> <!-- end form-group --> 
          <div class="form-group">
            <div class="col-sm-12">
              <label class="control-label">Giới Tính</label>
              <select class="form-control" name="gioiTinh">
                <option @if( $reader->gioiTinh == 1 ){{'selected'}}@endif value="1">Nam</option>
                <option @if( $reader->gioiTinh == 0 ){{'selected'}}@endif value="0">Nữ</option>
              </select>
            </div>
          </div> <!-- end form-group -->
          <div class="form-group">
            <label class="col-sm-12 control-label" for="">Ngày Sinh</label>
            <div class="col-sm-12"><input class="form-control datepicker-here" name="ngaySinh" type="text" data-language='en' value="{{$reader->ngaySinh}}"></div>
          </div> <!-- end form-group -->
          <div class="form-group">
            <div class="col-sm-12">
              <label class="control-label">Khoa</label>
              <select class="form-control" name="idKhoa">
               @foreach($facultys as $faculty)
               <option  @if( $reader->idKhoa == $faculty['id'] ){{'selected'}}@endif value="{{$faculty['id']}}">{{$faculty['tenKhoa']}}</option>
               @endforeach
             </select>
           </div>
         </div> <!-- end form-group -->
       </div>
       <div class="col-sm-4">
         <div class="form-group">
          <label class="col-sm-12 control-label" for="">Ngày Cấp</label>
          <div class="col-sm-12"><input class="form-control datepicker-here" name="ngayCap" type="text" data-language='en' value="{{$reader->ngayCap}}"></div>
        </div> <!-- end form-group -->
        <div class="form-group">
          <label class="col-sm-12 control-label" for="">Hạn Sử Dụng</label>
          <div class="col-sm-12"><input class="form-control datepicker-here" name="hansuDung" type="text" data-language='en' value="{{$reader->hansuDung}}"></div>
        </div> <!-- end form-group -->
        <div class="form-group">
          <label class="col-sm-12 control-label" for="">Email</label>
          <div class="col-sm-12">
            <input class="form-control" name="email" type="text" value="{{$reader->email}}">
          </div>
        </div> <!-- end form-group --> 
        <div class="form-group">
          <label class="col-sm-12 control-label" for="">Địa Chỉ</label>
          <div class="col-sm-12">
            <input class="form-control" name="diaChiDG" type="text" value="{{$reader->diaChiDG}}">
          </div>  
        </div> <!-- end form-group --> 
      </div>
    </div>
    <div class="row">
      <div class="col-sm-8">
        <div class="form-group">
          <div class="col-sm-12">
            <input type="submit" name="btnUpdate" class="btn btn-primary" value="Update">
            <a href="{{action('ReadersController@getManagerReaders_Detail',$id)}}" class="btn btn-default">Thoát</a>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
</div>
</div>
@endsection




