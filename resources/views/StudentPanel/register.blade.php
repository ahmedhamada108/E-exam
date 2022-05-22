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
      <a href="/" class="h1"><b>@lang('login_register.register_student.smart_exam')</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">@lang('login_register.register_student.register_a_new_student')</p>

      <form action="{{ route('student.register.post') }}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="@lang('login_register.register_student.full_name')" name="name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="@lang('login_register.register_student.email')" name="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="@lang('login_register.register_student.password')">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password_confirmation" placeholder="@lang('login_register.register_student.password_confirmation')">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <!-- select -->
            <div class="form-group">
              <label>@lang('login_register.register_student.select_the_level')</label>
              <select class="form-control" name="level_id">
              @foreach($levels as $level)
                <option value="{{ $level->id }}">{{ $level->name }}</option>
              @endforeach  
              </select>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label>@lang('login_register.register_student.select_the_dept')</label>
              <select class="form-control" name="dept_id">
              @foreach($departments as $department)
                <option value="{{ $department->id }}">{{ $department->name }}</option>
              @endforeach 
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms">
              <label for="agreeTerms">
                @lang('login_register.register_student.i_agree_to_terms')
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">@lang('login_register.register_student.register')</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <a href="{{ route('login.view') }}" class="text-center">@lang('login_register.register_student.i_already_have_a_membership')</a>
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
