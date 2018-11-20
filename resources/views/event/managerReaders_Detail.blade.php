@extends('index')

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
  <li class="breadcrumb-item active">
    Thông tin chi tiết
  </li> 
</ol>
@endsection

@section('content')
<div class="container-fluid">
 <div class="card">
  <div class="card-body">
    <h2 class="text-center">Thông tin độc giả</h2>
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
    <div class="container">
      <div class="row form-border">
        <div class="col-sm-6">
          <div class="container">
            <div class="form-group">
              <label class="col-sm-4 control-label" for="">Mã Số Độc Giả:</label>
              <span class="col-sm-8">{{$reader->maSoDG}}</span>
            </div> <!-- end form-group -->
            <div class="form-group">
              <label class="col-sm-4 control-label" for="">Họ Tên:</label>
              <span class="col-sm-8">{{$reader->hoTenDG}}</span>
            </div> <!-- end form-group --> 
            <div class="form-group">
              <label class="col-sm-4 control-label" for="">Giới Tính:</label>
              <span class="col-sm-8">
                @if($reader->gioiTinh == 1)
                  {{"Nam"}}
                @else
                  {{"Nữ"}}
                @endif
              </span>
            </div> <!-- end form-group -->
            <div class="form-group">
              <label class="col-sm-4 control-label" for="">Ngáy Sinh:</label>
              <span class="col-sm-8">{{$reader->ngaySinh}}</span>
            </div> <!-- end form-group -->
            <div class="form-group">
             <label class="col-sm-4 control-label" for="">Khoa:</label>
             <span class="col-sm-8">{{$reader->tenKhoa}}</span>
           </div> <!-- end form-group -->
         </div>
       </div>
       <div class="col-sm-6">
         <div class="container">
           <div class="form-group">
            <label class="col-sm-4 control-label" for="">Ngày Cấp:</label>
            <span class="col-sm-8">{{$reader->ngayCap}}</span>
          </div> <!-- end form-group -->
          <div class="form-group">
            <label class="col-sm-4 control-label" for="">Hạn Sử Dụng:</label>
            <span class="col-sm-8">{{$reader->hansuDung}}</span>
          </div> <!-- end form-group -->
          <div class="form-group">
            <label class="col-sm-4 control-label" for="">Email:</label>
            <span class="col-sm-8">{{$reader->email}}</span>
          </div> <!-- end form-group --> 
          <div class="form-group">
            <label class="col-sm-4 control-label" for="">Địa Chỉ:</label>
            <span class="col-sm-8">{{$reader->diaChiDG}}</span>
          </div> <!-- end form-group --> 
          <div class="form-group">
            <label class="col-sm-4 control-label" for="">Bị phạt:</label>
            <span class="col-sm-4">2 lần</span>
            <span class="col-sm-4"><a class="btn btn-primary waves-effect waves-light" style="position: absolute;top: -20px;width: 65px;padding: 13px 13px 10px 15px;height: 43px;" href="#"><i class="fa fa-edit"></i></a></span>
          </div> <!-- end form-group --> 
        </div>
      </div>
    </div>
    @if(count($readerBorrowBooks)>0)
      <div class="row form-border">
        <div class="col-sm-12">
          <div class="table-responsive-xl">
            <table class="table table-sm table-hover">
              <thead class="thead-light">
                <tr>
                  <th scope="col">STT</th>
                  <th scope="col">Số Phiếu Mượn</th>
                  <th scope="col">Mã Số Sách</th>
                  <th scope="col">Ngày Mượn</th>
                  <th scope="col">Hạn Trả</th>
                  <th scope="col">Tình Trạng</th>
                </tr>
              </thead>
              <tbody id="tbodyBooks" class="cursorPointer">
                @foreach($readerBorrowBooks as $readerBorrowBook)           
                <tr class="tr-info">
                  <td>{{++$stt}}</td>
                  <td>{{$readerBorrowBook->soPhieuMuon}}</td>
                  <td>{{$readerBorrowBook->maSoSach}}</td>
                  <td>{{$readerBorrowBook->ngayMuon}}</td>
                  <td>{{$readerBorrowBook->hanTra}}</td>
                  <td>
                    @if($readerBorrowBook->trangThai == 0)
                    {{"Chưa trả sách"}}
                    @else 
                    {{"Đã trả sách"}}
                    @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    @else
    <h4 class="text-center">Độc giả chưa mượn cuốn sách nào !!!</h4>
    @endif
  </div>
  <div class="row">
    <div class="col-sm-12">
      <div class="form-group text-center">
          <a href="{{action('ReadersController@getManagerReaders_Edit',$id)}}" class="btn btn-warning">Sửa</a>
          <a href="{{action('ReadersController@getManagerReaders_Delete',$id)}}" class="btn btn-danger">Xóa</a>
          <a href="{{route('get.manager.readers')}}" class="btn btn-default">Thoát</a>
      </div>
    </div>
  </div>
</form>
</div>
</div>
</div>
@endsection



