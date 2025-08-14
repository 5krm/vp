@extends('backend.layouts.app')
@section('content')
<div class="hold-transition login-page" style="background: url('{{ asset('assets/backend/dist/img/bg.jpg') }}') no-repeat center center; background-size: cover;">
  <div class="login-box">
    <div class="card card-primary">
      <div class="card-body">
        <h5 class="login-box-msg" style="font-weight: bold;">Reset Your Password Securely and Get Back on Track</h5>
        <form action="" method="post">
          @csrf
          <div class="mb-3">
            <div class="input-group">
              <input type="password" name="password" class="form-control" value="{{ old('password') }}" placeholder="Password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
          </div>
          <div class="mb-3">
            <div class="input-group">
              <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}" placeholder="Confirm Password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block customButton">Reset Password</button>
            </div>
          </div>
        </form>
        <p class="mt-3 mb-1">
          <a href="{{ route('admin.login') }}">Login</a>
        </p>
      </div>
    </div>
  </div>
</div>
@endsection
