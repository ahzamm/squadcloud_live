<!DOCTYPE html>
<html>
<head>
    @php
            $general_configuration = DB::table('general_configurations')->first();
        @endphp
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin Login | Blink Broadband</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="{{ asset('frontend_assets/images/' . $general_configuration->brand_logo) }}" sizes="32x32" />
  <link rel="icon" href="{{ asset('frontend_assets/images/' . $general_configuration->brand_logo) }}" sizes="192x192" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('backend/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('backend/dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="http://logon.com.pk/" target="_blank"><img src="{{ asset('frontend_assets/images/' . $general_configuration->brand_logo) }}" alt="">
      </a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        @if (Session::has('message'))
        <p class="login-box-msg text-danger">{{Session::get('message')}}</p>
        @endif
        <form action="{{route('admin.verifyOTP.post')}}" method="post">
          @csrf
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="token" placeholder="OTP Token" value="{{old('token')}}">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          @error('token')
          <p class="text-danger">{{$message}}</p>
          @enderror
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-outline-primary btn-block">Submit</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->
  <!-- jQuery -->
  <script src="{{asset('backend/plugins/jquery/jquery.min.js')}}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('backend/dist/js/adminlte.min.js')}}"></script>
</body>
</html>
