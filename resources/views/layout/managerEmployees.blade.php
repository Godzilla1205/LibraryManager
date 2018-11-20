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
    Quản lý nhân viên
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
            <a class="btn btn-secondary" href="{{route('get.manager.employees.add')}}">
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
            <th scope="col">Mã NV</th>
            <th scope="col">Tên NV</th>
            <th scope="col">Địa Chỉ</th>
            <th scope="col">Giới Tính</th>
            <th scope="col">Số Điện Thoại</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
           @foreach($employeess as $employees)
            <tr class="tr-info">
              <th scope="row">
                <div class="checkbox checkbox-primary">
                  <input type="checkbox" class="checkboxes"value="1">
                </div>
              </th>
              <td>{{++$stt}}</td>
              <td>{{$employees['maSoNV']}}</td>
              <td>{{$employees['hoTenNV']}}</td>
              <td>{{$employees['diaChiNV']}}</td>
              <td>{{$employees['gioiTinhNV']}}</td>
              <td>{{$employees['soDTNV']}}</td>
              <td class="action-button">
                 <a class="btn btn-primary" href="{{action('EmployeesController@getManagerEmployees_Edit',$employees['id'])}}"><i class="fa fa-edit"></i></a>
                <a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');" href="{{action('EmployeesController@getManagerEmployees_Delete',$employees['id'])}}"><i class="fa fa-trash"></i></a>
              </td>
            </tr>
           @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection






