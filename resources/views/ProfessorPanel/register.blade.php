<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Smart Exam</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
  <link rel="icon" href="{{ asset('assets_web/logo.png') }}" type="image/x-icon" />
  <link rel="shortcut icon" href="{{ asset('assets_web/logo.png') }}" type="image/x-icon" />
</head>
<body class="hold-transition register-page">
<div class="register-box" style="width: 380px !important;">
  @include('layouts.errors')
  @include('layouts.sessions_messages')
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="/" class="h1"><b>@lang('login_register.register_professor.smart_exam')</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">@lang('login_register.register_professor.register_a_new_professor')</p>

      <form action="{{ route('professor.register.post') }}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input value="{{old('name')}}"  type="text" class="form-control" placeholder="@lang('login_register.register_professor.full_name')" name="name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" value="{{ old('email') }}" class="form-control" placeholder="@lang('login_register.register_professor.email')" name="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="@lang('login_register.register_professor.password')">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password_confirmation" placeholder="@lang('login_register.register_professor.password_confirmation')">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" style="width: 121%;!important" class="btn btn-primary btn-block">@lang('login_register.register_professor.register')</button>
          </div>
          <!-- /.col -->
      </form>

      <a href="{{ url('/login') }}" class="text-center">@lang('login_register.register_professor.i_already_have_a_membership')</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
</body>
</html>
