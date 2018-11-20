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
    Quản lý người dùng
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
            <a class="btn btn-secondary" href="{{route('get.manager.users.add')}}">
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
          <th scope="col">Tài Khoản</th>
          <th scope="col">Họ Tên</th>
          <th scope="col">Email</th>
          <th scope="col">Chức vụ</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
       @foreach($users as $user)
       <tr class="tr-info" @if($user['level']==1)style='color: #8e35ba;'@endif>
        <th scope="row">
          <div class="checkbox checkbox-primary">
            <input type="checkbox" class="checkboxes"value="1">
          </div>
        </th>
        <td>{{++$stt}}</td>
        <td>{{$user['username']}}</td>
        <td>{{$user['name']}}</td>
        <td>{{$user['email']}}</td>
        <td>@if($user['level']==1){{"admin"}}@else{{"normal"}}@endif</td>
        <td class="action-button">
          <a class="btn btn-success" data-id="{{$user['id']}}">Info</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="show" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <center><h4>Thông tin tài khoản</h4></center>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label class="col-sm-3 control-label" for="">Tài khoản:</label>
                <span id='username' class="col-sm-6"></span>
              </div> <!-- end form-group -->
              <div class="form-group">
                <label class="col-sm-3 control-label" for="">Tên:</label>
                <span id='name' class="col-sm-6"></span>
              </div> <!-- end form-group -->
              <div class="form-group">
                <label class="col-sm-3 control-label" for="">Email:</label>
                <span id='email' class="col-sm-6"></span>
              </div> <!-- end form-group -->
              
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label class="col-sm-3 control-label" for="">Chức vụ:</label>
                <span id='level' class="col-sm-6"></span>
              </div> <!-- end form-group -->
              <div class="form-group">
                <label class="col-sm-3 control-label" for="">Mật khẩu:</label>
                <span id='password' class="col-sm-6">***********</span>
              </div> <!-- end form-group -->
              <div class="form-group">
                <label class="col-sm-3 control-label" for="">Ngày tạo:</label>
                <span id='created_at' class="col-sm-6"></span>
              </div> <!-- end form-group -->

            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
       {{--  <a class="btn btn-primary edit" href="">Edit</a> --}}
        <a class="btn btn-danger" id="btnDelete" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
<script type="text/javascript" src="{{asset('vendor/bootstrapv2.js')}}"></script>
<script type="text/javascript">
  var app_url="{{asset("")}}";


  $(function(){
    $('.btn.btn-success').click(function(event) {
      $('#show').modal('show');
      var id = $(this).data('id');
      $.ajax({ 
        url: app_url+'manager/admin/users/detail/'+id,
        type: 'get',
        success:function(reponse){
         // console.log(reponse['user'])
         var level = reponse['user'].level;
         if(level == 1){
          var position = 'admin';
        }else {
          var position = 'normal';
        }
        $('#username').text(reponse['user'].username);
        $('#name').text(reponse['user'].name);
        $('#email').text(reponse['user'].email);
        $('#level').text(position);
        $('#created_at').text(reponse['user'].created_at);
        $('#btnDelete').attr('href','{{action('UsersController@getManagerUsers_Delete','')}}'+'/'+reponse['user'].id);
      }
    })
    });

  })
</script>
@endsection





