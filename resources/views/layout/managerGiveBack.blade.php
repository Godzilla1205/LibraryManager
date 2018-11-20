@extends('layout.managerBorrowGiveBack')

@section("menu-manager-giveBack")
sm-active
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{route('get.manager')}}">Trang chủ</a>
  </li>
  <li class="breadcrumb-item active">
    Quản lý trả sách
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
            <a class="btn btn-secondary" href="{{route('get.payBook')}}">
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
            <th scope="col">Mã Phiếu</th>
            <th scope="col">Mã Sách</th>
            <th scope="col">Mã Nhân Viên</th>
            <th scope="col">Ngày Trả</th>
            <th scope="col">Ghi Chú</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($payBooks as $payBook)
          <tr class="tr-info">
            <td>{{$payBook->soPhieuMuon}}</td>
            <td>{{$payBook->maSoSach}}</td>
            <td>{{$payBook->maSoNV}}</td>
            <td>{{$payBook->ngayTra}}</td>
            <td>{{$payBook->ghiChu}}</td>
            <td class="action-button">
              <a class="btn btn-primary" href="#"><i class="fa fa-edit"></i></a>
              <a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');" href="{{action('PayBookController@getManagerGiveBack_Delete',$payBook->id)}}"><i class="fa fa-trash"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection




