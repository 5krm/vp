@extends('backend.layouts.app')
@section('content')
<div class="hold-transition login-page" style="background: url('{{ asset('assets/backend/dist/img/bg.jpg') }}') no-repeat center center; background-size: cover;">
  <div class="login-box">
    <div class="card card-primary">
      <div class="card-body">
        <h5 class="login-box-msg" style="font-weight: bold;">Enter Your Email to Reset Your Password</h5>
        <form action="{{ route('admin.password.email') }}" method="post">
          @csrf
          <div class="mb-3">
            <div class="input-group">
              <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block customButton">Send Reset Link Email</button>
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
