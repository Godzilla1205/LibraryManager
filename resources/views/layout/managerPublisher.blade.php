@extends('index')

@section("menu-manager-publisher")
sl-active
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{route('get.manager')}}">Trang chủ</a>
  </li>
  <li class="breadcrumb-item active">
    Quản lý nhà xuất bản
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
            <a class="btn btn-secondary" href="{{route('get.manager.publisher.add')}}">
             <i class="fa fa-plus"></i> Create </a>
            </a> 
            <button class="btn btn-secondary" onclick="myFunction()">
              <i class="fas fa-sync"></i> Reload
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="table-responsive-xl">
      <table class="table table-sm table-hover">
        <thead class="thead-light">
          <tr>
            <th scope="col">
              <div class="checkbox checkbox-primary table-checkbox">
                <input type="checkbox" class="checkboxes"value="1">
              </div>
            </th>
            <th scope="col">STT</th>
            <th scope="col">Mã NXB</th>
            <th scope="col">Tên NXB</th>
            <th scope="col">Địa Chỉ</th>
            <th scope="col">Web Site</th>
            <th scope="col">Thông tin khác</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($publishers as $publisher)
            <tr class="tr-info">
              <th scope="row">
                <div class="checkbox checkbox-primary">
                  <input type="checkbox" class="checkboxes"value="1">
                </div>
              </th>
              <td>{{++$stt}}</td>
              <td>{{$publisher['maSoNXB']}}</td>
              <td>{{$publisher['hoTenNXB']}}</td>
              <td>{{$publisher['diaChiNXB']}}</td>
              <td>{{$publisher['websiteNXB']}}</td>
              <td>{{$publisher['thongTinKhacNXB']}}</td>
              <td class="action-button">
                <a class="btn btn-primary" href="{{action('PublisherController@getManagerPublisher_Edit',$publisher['id'])}}"><i class="fa fa-edit"></i></a>
                <a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');" href="{{action('PublisherController@getManagerPublisher_Delete',$publisher['id'])}}"><i class="fa fa-trash"></i></a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection



