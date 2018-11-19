@extends('layout.managerBorrowGiveBack')

@section("menu-manager-borrowBook")
sm-active
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{route('get.manager')}}">Trang chủ</a>
  </li>
  <li class="breadcrumb-item active">
    Quản lý mượn sách
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
            <a class="btn btn-secondary" href="{{route('get.borrowBook')}}">
             <i class="fa fa-plus"></i> Create </a>
           </a> 
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
        <th scope="col">Mã Phiếu</th>
        <th scope="col">Mã Độc Giả</th>
        <th scope="col">Mã Nhân Viên</th>
        <th scope="col">Ngày Mượn</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($borrowBooks as $borrowBook)
      <tr class="tr-info">
        <td>{{$borrowBook->soPhieuMuon}}</td>
        <td>{{$borrowBook->maSoDG}}</td>
        <td>{{$borrowBook->maSoNV}}</td>
        <td>{{$borrowBook->ngayMuon}}</td>
        <td class="action-button">
          <a class="btn btn-info" data-id="{{$borrowBook->id}}">Info</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
</div>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="show" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <center><h4>Thông tin phiếu</h4></center>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row">
            <div class="col-sm-4">
              <div class="form-group">
                <label class="col-sm-5 control-label" for="">Mã Phiếu:</label>
                <span id='soPhieuMuon' class="col-sm-5"></span>
              </div> <!-- end form-group -->
            </div>
          </div>
          <div class="row">
            <div class="col-sm-7">
              <div class="table-responsive-xl">
                <table class="table table-sm table-hover">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col">Mã Sách</th>
                      <th scope="col">Hạn Trả</th>
                      <th scope="col">Tình Trạng</th>
                    </tr>
                  </thead>
                  <tbody id="tbodyDetail" class="cursorPointer">
                    <!-- insert data -->
                  </tbody>
                </table>
              </div>
            </div>
            <div class="col-sm-5">
              <div class="form-group">
                <label class="col-sm-6 control-label" for="">Mã Độc Giả:</label>
                <span id='maSoDG' class="col-sm-6"></span>
              </div> <!-- end form-group -->
              <div class="form-group">
                <label class="col-sm-6 control-label" for="">Mã Nhân Viên:</label>
                <span id='maSoNV' class="col-sm-6"></span>
              </div> <!-- end form-group -->
              <div class="form-group">
                <label class="col-sm-6 control-label" for="">Ngày Mượn:</label>
                <span id='ngayMuon' class="col-sm-6"></span>
              </div> <!-- end form-group -->
            </div>
          </div>
        </div>
      </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>



  <script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
  <script type="text/javascript" src="{{asset('vendor/bootstrapv2.js')}}"></script>
  <script type="text/javascript">
    var app_url="{{asset("")}}";
    var listGiveBacks;

    function setHTML(selector, html) {
      var element = document.querySelector(selector);
      element.innerHTML = html;
    }

    function readerlistGiveBacks() {
     var html = '';
     var trangThai = '';
     for (var listGiveBack of listGiveBacks) {
      if(listGiveBack.trangThai == 1) {
        trangThai = "Đã trả sách";
      }else {
        trangThai = "Chưa trả sách";
      }

      html += '<tr class="tr-info">';
      html += '<td>'+ listGiveBack.maSoSach +'</td>';
      html += '<td>'+ listGiveBack.hanTra +'</td>';
      html += '<td>'+ trangThai +'</td>';
      html += '</tr>';
    }
    setHTML('#tbodyDetail', html);
  }

  $(function(){
    $('.btn.btn-info').click(function(event) {
      $('#show').modal('show');
      var id = $(this).data('id');
      $.ajax({ 
        url: app_url+'manager/BorrowBook/'+id,
        type: 'get',
        success:function(reponse){
          listGiveBacks = reponse['listGiveBacks'];
          var borrowBook = reponse['borrowBooks'][0];
          $('#soPhieuMuon').text(borrowBook.soPhieuMuon);
          $('#maSoDG').text(borrowBook.maSoDG);
          $('#maSoNV').text(borrowBook.maSoNV);
          $('#ngayMuon').text(borrowBook.ngayMuon);
          readerlistGiveBacks();
        }
      })
    });

  })
</script>
@endsection