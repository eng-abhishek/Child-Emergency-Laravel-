<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Child Emergency Admin Login</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{asset('assets/dist/css/AdminLTE.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="{{asset('assets/plugins/iCheck/square/blue.css')}}" rel="stylesheet" type="text/css" />
  </head>
  <body class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="#"><b>Admin</b> Child Emergency</a>
      </div><!-- /.login-logo -->
@if(Session::get('err_msg'))
<div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong></strong> {{Session::get('err_msg')}}
</div>
@endif

      <div class="login-box-body">
        <p class="login-box-msg">Login Here..</p>
        
        <form action="{{url('admin-login-post')}}" method="post">
          <div class="form-group has-feedback">
            <input type="text" name="email" class="form-control" placeholder="Email" required=""/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            @error('email')
            <div>{{$message}}</div>
            @enderror
          </div>

          @csrf
          <div class="form-group has-feedback">
            <input type="password" name="password" class="form-control" placeholder="Password" required=""/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            @error('password')
            <div>{{$message}}</div>
            @enderror
          </div>
          <div class="row">
<!--             <div class="col-xs-8">    
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> Remember Me
                </label>
              </div>                        
            </div> -->
            <!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
        </form>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.3 -->
    <script src="{{asset('assets/plugins/jQuery/jQuery-2.1.3.min.js')}}"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="{{asset('assets/plugins/iCheck/icheck.min.js')}}" type="text/javascript"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>