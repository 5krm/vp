@extends('backend.layouts.app')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="textWhite">Email Configuration</h1>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <form action="{{ route('admin.email.configuration.update') }}" method="post">
                @csrf
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Email Send Method</label>
                        <input type="text" class="form-control" name="email_send_method" value="{{ $emailConfiguration ? $emailConfiguration->email_send_method : '' }}" placeholder="Email Send Method">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Mail Host</label>
                        <input type="text" class="form-control" name="mail_host" value="{{ $emailConfiguration ? $emailConfiguration->mail_host : '' }}" placeholder="Mail Host">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Mail Port</label>
                        <input type="text" class="form-control" name="mail_port" value="{{ $emailConfiguration ? $emailConfiguration->mail_port : '' }}" placeholder="Mail Port">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Mail Encryption Method</label>
                        <input type="text" class="form-control" name="mail_encryption_method" value="{{ $emailConfiguration ? $emailConfiguration->mail_encryption_method : '' }}" placeholder="Mail Encryption Method">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Mail Username</label>
                        <input type="text" class="form-control" name="mail_username" value="{{ $emailConfiguration ? $emailConfiguration->mail_username : '' }}" placeholder="Mail Username">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Mail Password</label>
                        <input type="text" class="form-control" name="mail_password" value="{{ $emailConfiguration ? $emailConfiguration->mail_password : '' }}" placeholder="Mail Password">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Mail From Address</label>
                        <input type="text" class="form-control" name="mail_from_address" value="{{ $emailConfiguration ? $emailConfiguration->mail_from_address : '' }}" placeholder="Mail From Address">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Mail From Name</label>
                        <input type="text" class="form-control" name="mail_from_name" value="{{ $emailConfiguration ? $emailConfiguration->mail_from_name : '' }}" placeholder="Mail From Name">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary customButton">Update</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection