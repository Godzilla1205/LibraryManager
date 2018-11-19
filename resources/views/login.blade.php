<!DOCTYPE html>
<html lang="en">
<head>
  <title>Quản lý thư viện </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{asset('vendor/1.css')}}">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script src="{{asset('vendor/1.js')}}"></script>  
</head>
<body>
  <section class="login-block @if($errors->any()) red fail @endif">
    <div class="container">
      <div class="row">
        <div class="col-md-4 login-sec">
          @if (Session::has('success'))
          <p>{{ Session::get('success') }}</p>
          @endif
          <form action="{{action('LoginController@postAdminLogin')}}" method="POST" class="form-horizontal" role="form">
            @method('post')
            @csrf
            <h2 class="text-center">Admin login</h2>
            <div class="form-group">
              <label class="text-uppercase">Username</label>
              <input type="text" class="form-control" id="userName" value="a@Gmail.com" name="email" placeholder="">
            </div>
            <div class="form-group">
              <label class="text-uppercase">Password</label>
              <input type="password" class="form-control" id="passWord" value="123456" name="password" placeholder="">
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input type="checkbox" checked="checked" class="form-check-input">
                <small>Remember Me</small>
              </label>
              <button type="submit" class="btn btn-login float-right">Submit</button>
            </div>
          </form>
        </div>
        <div class="col-md-8 banner-sec">
          <img class="d-block img-fluid" src="{{asset('images/06.jpg')}}" alt="First slide">
        </div>
      </div>
    </section>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.4.1/js/mdb.min.js"></script>
  </body>
  </html>





