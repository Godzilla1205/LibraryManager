@extends('index')

@section("menu-manager-readers")
sl-active
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{route('get.manager')}}">Trang chủ</a>
  </li>
  <li class="breadcrumb-item active">
    Quản lý độc giả
  </li> 
</ol>
@endsection

@section('content')
<div class="container-fluid">
  <div class="card">
    <div class="card-body">
      <div class="portlet-title">
        <div class="row">
          <div class="col-sm-7">
            <div class="caption">
              <div class="wrapper-action">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Bulk Actions
                </button>
                <div class="dropdown-menu">
                 <a class="dropdown-item" href="#">Update</a>
                 <a class="dropdown-item" href="#">Delete</a>
               </div>  
             </div>
           </div>
         </div>
         <div class="col-sm-5">
          <div class="portlet-title-right">
            <a class="btn btn-secondary" href="{{route('get.manager.readers.add')}}">
             <i class="fa fa-plus"></i> Create </a>
             <button class="btn btn-secondary">
              <i class="fas fa-sync"></i> Reload
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-sm table-hover">
        <thead class="thead-light">
          <tr>
            <th scope="col">
              <div class="checkbox checkbox-primary table-checkbox">
                <input type="checkbox" class="checkboxes"value="1">
              </div>
            </th>
            <th scope="col">STT</th>
            <th scope="col">Mã DG</th>
            <th scope="col">Họ Tên</th>
            <th scope="col">Khoa</th>
            <th scope="col">Ngày Sinh</th>
            <th scope="col">Ngày Cấp</th>
            <th scope="col">Hạn Sử Dung</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($readers as $reader)
          <tr class="tr-info">
            <th scope="row">
              <div class="checkbox checkbox-primary">
                <input type="checkbox" class="checkboxes"value="1">
              </div>
            </th>
            <td>{{++$stt}}</td>
            <td>{{$reader->maSoDG}}</td>
            <td>{{$reader->hoTenDG}}</td>
            <td>{{$reader->tenKhoa}}</td>
            <td>{{$reader->ngaySinh}}</td>
            <td>{{$reader->ngayCap}}</td>
            <td>{{$reader->hanSuDung}}</td>
            <td class="action-button">
              <a class="btn btn-info" href="{{action('ReadersController@getManagerReaders_Detail',$reader->id)}}">Info</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection




