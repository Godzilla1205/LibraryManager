@extends('index')


@section("menu-manager-book")
sl-active
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{route('get.manager')}}">Trang chủ</a>
  </li>
  <li class="breadcrumb-item">
    <a href="{{route('get.manager.book')}}">Quản lý sách</a>
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
    <h2 class="text-center">Sửa thông tin quyển sách</h2>
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
    <form action="{{action('BookController@postManagerBook_Edit',$id)}}" method="POST" class="form-horizontal" role="form">
      @method('post')
      @csrf
      <div class="row">
        <div class="col-sm-8">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label class="col-sm-12 control-label" for="">Mã Số Sách</label>
                <div class="col-sm-12">
                  <input class="form-control" name="maSoSach" type="text" value="{{$book['maSoSach']}}">
                </div>
              </div> <!-- end form-group -->
              <div class="form-group">
                <label class="col-sm-12 control-label" for="">Tên Sách</label>
                <div class="col-sm-12">
                  <input class="form-control" name="tenSach" type="text" value="{{$book['tenSach']}}">
                </div>
              </div> <!-- end form-group --> 
              <div class="form-group">
                <div class="col-sm-12">
                  <label class="control-label">Loại Sách</label>
                  <select class="form-control" name="idLoaiSach">
                    @foreach($typeBooks as $typeBook)
                    <option @if($typeBook['id']==$book['idLoaiSach']){{'selected'}}@endif value="{{$typeBook['id']}}">{{$typeBook['loaiSach']}}</option>
                    @endforeach
                  </select>
                </div>
              </div> <!-- end form-group -->
              <div class="form-group">
                <label class="col-sm-12 control-label" for="">Tác Giả</label>
                <div class="col-sm-12">
                  <input class="form-control" name="tacGia" type="text" value="{{$book['tacGia']}}">
                </div>
              </div> <!-- end form-group --> 
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <div class="col-sm-12">
                  <label class="control-label">Tên NXB</label>
                  <select class="form-control" name="idNXB">
                   @foreach($publishers as $publisher)
                   <option value="{{$publisher['id']}}">{{$publisher['hoTenNXB']}}</option>
                   @endforeach
                 </select>
               </div>
             </div> <!-- end form-group -->
             <div class="form-group">
              <div class="container">
                <div class="row">
                  <div class="col-sm-6">
                   <label class="control-label" for="">Năm XB</label>
                   <input class="col-sm-12 form-control" name="namXB" type="text" value="{{$book['namXB']}}">
                 </div>
                 <div class="col-sm-6">
                   <label class="control-label" for="">Lần XB</label>
                   <input class="col-sm-12 form-control" name="lanXB" type="text" value="{{$book['lanXB']}}">
                 </div>
               </div>
             </div>
           </div> <!-- end form-group -->
           <div class="form-group">
            <label class="col-sm-12 control-label" for="">Giá Tiền</label>
            <div class="col-sm-12">
              <input class="form-control" name="giaTien" type="text" value="{{$book['giaTien']}}">
            </div>
          </div> <!-- end form-group --> 
          <div class="form-group">
            <label class="col-sm-12 control-label" for="">Số lượng</label>
            <div class="col-sm-12">
              <input class="form-control" name="soLuong" type="text" value="{{$book['soLuong']}}">
            </div>
          </div> <!-- end form-group --> 
        </div>
      </div>
      <div class="row">
          <div class="col-sm-8">
           <div class="form-group">
            <label class="col-sm-12 control-label" for="">Nội dung tóm lược</label>
            <div class="col-sm-12">
              <textarea class="form-control" name="noiDungTomLuoc" data-maxlength="500" cols="100" rows="8">{{$book['noiDungTomLuoc']}}</textarea>
            </div>
          </div>
        </div>
      </div>
    </div>
  <div class="col-sm-4">
    <fieldset class="form-group">
      <img class="form-control card-img-top img-fluid" src="{{asset('images')."/".$book['linkAnh']}}" id="img" style="height: auto; width: 300px; margin-top:20px; ">
      <input type="file" id="avatar" onchange="AutoUpload();">
      <input type="hidden" id="avatarHidden" name="linkAnh" value="{{$book['linkAnh']}}">
    </fieldset>
  </div>
</div>

<div class="row">
  <div class="col-sm-8">
    <div class="form-group">
      <div class="col-sm-12">
        <input type="submit" name="btnUpdate" class="btn btn-primary" value="Update">
        <a href="{{route('get.manager.book')}}" class="btn btn-default">Thoát</a>
      </div>
    </div>
  </div>
</div>
</form>
</div>
</div>
</div>
@endsection


@section('scriptBottom')
<script> 
  function AutoUpload() {
   var avatar = document.getElementById("avatar").value;
   var img = document.getElementById("img");
   var avatarHidden = document.getElementById("avatarHidden");
   var res = avatar.split('\\');
   var resImg = img.src.split('/');
   avatar = res[res.length-1];
   avatarHidden.value = avatar;
   resImg[resImg.length-1] = avatar;
   img.src = resImg.join("/");
 }
</script>
@endsection



