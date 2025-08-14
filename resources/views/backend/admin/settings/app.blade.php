@extends('backend.layouts.app')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="textWhite">App Settings</h1>
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
              <form action="{{ route('admin.settings.app.update') }}" method="post">
                @csrf
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Login System Configuration</label>
                        <select name="login_system_type" class="form-control">
                          <option value="device_id_required"  @if(optional($appSettings)->login_system_type == 'device_id_required') selected @endif>Email, Password, and Device ID</option>
                          <option value="email_password_only"  @if(optional($appSettings)->login_system_type == 'email_password_only') selected @endif>Email and Password Only</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>FAQ URL</label>
                        <input type="text" class="form-control" name="faq_url" value="{{ optional($appSettings)->faq_url }}" placeholder="FAQ URL">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Contact Us URL</label>
                        <input type="text" class="form-control" name="contact_us_url" value="{{ optional($appSettings)->contact_us_url }}" placeholder="Contact Us URL">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Privacy & Policy URL</label>
                        <input type="text" class="form-control" name="privacy_policy_url" value="{{ optional($appSettings)->privacy_policy_url }}" placeholder="Privacy & Policy URL">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Terms & Conditions URL</label>
                        <input type="text" class="form-control" name="terms_and_conditions_url" value="{{ optional($appSettings)->terms_and_conditions_url }}" placeholder="Terms & Conditions URL">
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