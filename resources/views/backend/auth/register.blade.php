@extends('backend.layouts.app')
@section('content')
<div class="hold-transition login-page" style="background: url('{{ asset('assets/backend/dist/img/bg.jpg') }}') no-repeat center center; background-size: cover;">
  <div class="login-box">
    <div class="card card-primary">
      <div class="card-body">
        <h5 class="login-box-msg pb-0" style="font-weight: bold;">Create Admin Account</h5>
        <p class="text-center text-muted pb-2">
          Fill the form below to create an admin account. The account will get full permissions.
        </p>
        <form action="{{ route('admin.register') }}" method="post">
          @csrf
          <div class="mb-3">
            <div class="input-group">
              <input type="text" name="username" class="form-control" value="{{ old('username') }}" placeholder="Username" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
          </div>
          <div class="mb-3">
            <div class="input-group">
              <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Full Name" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-id-badge"></span>
                </div>
              </div>
            </div>
          </div>
          <div class="mb-3">
            <div class="input-group">
              <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
          </div>
          <div class="mb-3">
            <div class="input-group">
              <input type="password" name="password" class="form-control" placeholder="Password" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
          </div>
          <div class="mb-3">
            <div class="input-group">
              <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block customButton">Sign Up</button>
            </div>
          </div>
        </form>
        <p class="mb-1 mt-2 text-center">
          <a href="{{ route('admin.loginView') }}">Already have an account? Sign In</a>
        </p>
      </div>
    </div>
  </div>
</div>
@endsection