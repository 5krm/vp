@extends('backend.layouts.app')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="textWhite">Edit Admin</h1>
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
              <form action="{{ route('admin.admins.update') }}" method="post">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" value="{{ old('username', $admin->username) }}" placeholder="Username">
                    <span class="text-danger">{{ $errors->has('username') ? $errors->first('username') : "" }}</span>
                  </div>
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name', $admin->name) }}" placeholder="Name">
                    <input type="hidden" class="form-control" name="admin_id" value="{{ $admin->id }}">
                    <span class="text-danger">{{ $errors->has('name') ? $errors->first('name') : "" }}</span>
                  </div>
                  <div class="form-group">
                    <label>Assign Role</label>
                    <select class="select2 customSelect2" multiple="multiple" data-placeholder="Select a State" name="roles[]" style="width: 100%;">
                      @foreach ($roles as $role)
                        <option value="{{ $role->name }}" {{ $admin->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                      <option value="0" @if($admin->status == '0') selected @endif>Active</option>
                      <option value="1" @if($admin->status == '1') selected @endif>Inactive</option>
                    </select>
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