@extends('backend.layouts.app')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="textWhite">Add New Server</h1>
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
              <form action="{{ route('admin.servers.insert') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label class="d-block">Select Country</label>
                    <select name="country_id" class="form-control select2" style="width: 100%">
                      <option selected disabled>Select Country</option>
                      @foreach($countries as $country)
                        <option value="{{ $country->id }}" @if(old('country_id') == $country->id) selected @endif>{{ $country->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>VPN Country</label>
                    <input type="text" class="form-control" name="vpn_country" value="{{ old('vpn_country') }}" placeholder="VPN Country">
                  </div>
                  <div class="form-group">
                    <label>Server Name</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Server Name">
                  </div>
                  <div class="form-group">
                    <label>VPN Username</label>
                    <input type="text" class="form-control" name="vpn_credentials_username" value="{{ old('vpn_credentials_username') }}" placeholder="VPN Username">
                  </div>
                  <div class="form-group">
                    <label>VPN Password</label>
                    <input type="text" class="form-control" name="vpn_credentials_password" value="{{ old('vpn_credentials_password') }}" placeholder="VPN Password">
                  </div>
                  <div class="form-group">
                    <label>OpenVPN Configuration Script (UDP)</label>
                    <textarea type="text" class="form-control" name="udp_configuration" rows="4" placeholder="OpenVPN Configuration Script (UDP)" >{{ old('udp_configuration') }}</textarea>
                  </div>
                  <div class="form-group">
                    <label>OpenVPN Configuration Script (TCP)</label>
                    <textarea type="text" class="form-control" name="tcp_configuration" rows="4" placeholder="OpenVPN Configuration Script (TCP)" >{{ old('tcp_configuration') }}</textarea>
                  </div>
                  <div class="form-group">
                    <label>Access Type</label>
                    <select name="access_type" class="form-control">
                      <option value="free">Free</option>
                      <option value="premium">Premium</option>
                    </select>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary customButton">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
