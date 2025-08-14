@extends('backend.layouts.app')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="textWhite">Add New Admin</h1>
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
              <form action="{{ route('admin.admins.insert') }}" method="post"  onsubmit="process(event)">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Username</label>
                    <input type="text"  class="form-control" name="username" value="{{ old('username') }}" placeholder="Username">
                  </div>
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Name">
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                  </div>
                  <div class="form-group">
                    <label>Assign Role</label>
                    <select class="select2" multiple="multiple" data-placeholder="Select a State" name="roles[]" style="width: 100%;">
                      @foreach ($roles as $role)
                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Password Confirmation">
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
