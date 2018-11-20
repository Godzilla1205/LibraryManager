@extends('index')

@section("menu-manager-book")
sl-active
@endsection

@section('breadcrumb')
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{route('get.manager')}}">Trang chủ</a>
    </li>
    <li class="breadcrumb-item active">
      Quản lý sách
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
                  <a class="btn btn-secondary" href="{{route('get.manager.book.add')}}">
                 <i class="fa fa-plus"></i> Create </a>
                  <button class="btn btn-secondary">
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
                  <th scope="col">Mã Sách</th>
                  <th scope="col">Tên Sách</th>
                  <th scope="col">Loại Sách</th>
                  <th scope="col">Tác Giả</th>
                  <th scope="col">NXB</th>
                  <th scope="col">Năm XB</th>
                  <th scope="col">Lần XB</th>
                  <th scope="col">Số Lượng</th>
                  <th scope="col">Giá Tiền</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($books as $book)
                <tr class="tr-info">
                  <th scope="row">
                    <div class="checkbox checkbox-primary">
                      <input type="checkbox" class="checkboxes"value="1">
                    </div>
                  </th>
                  <td>{{++$stt}}</td>
                  <td>{{$book->maSoSach}}</td>
                  <td>{{$book->tenSach}}</td>
                  <td>{{$book->loaiSach}}</td>
                  <td>{{$book->tacGia}}</td>
                  <td>{{$book->hoTenNXB}}</td>
                  <td>{{$book->namXB}}</td>
                  <td>{{$book->lanXB}}</td>
                  <td>{{$book->soLuong}}</td>
                  <td>{{$book->giaTien}}</td>
                  <td class="action-button">
                    <a class="btn btn-primary" href="{{action('BookController@getManagerBook_Edit',$book->id)}}"><i class="fa fa-edit"></i></a>
                    <a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');" href="{{action('BookController@getManagerBook_Delete',$book->id)}}"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
@endsection





