@extends('backend.layouts.app')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 pb-2 pb-sm-0">
            <h1 class="textWhite">Role List</h1>
          </div>
          <div class="col-sm-6 text-sm-right">
            <a href="{{ url('admin/roles/add') }}" class="btn btn-primary customButton">Add New Role</a>
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
              <div class="card-body table-responsive p-3">
                <table id="roleTable" style="width: 100%;" class="table table-striped">
                  <thead>
                    <tr>
                      <th style="width: 80px">S. No.</th>
                      <th>Role Name</th>
                      <th>Permissions</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection

@push('scripts')
<script>
  $(document).ready(function() {
    var table = $('#roleTable').DataTable({
      processing: true,
      serverSide: true,
      ajax: '{{ route('admin.roles.index') }}',
      columns: [
        {
          data: null, 
          name: 'serial',
          orderable: false,
          searchable: false,
          render: function (data, type, full, meta) {
            return meta.row + 1; 
          }
        },
        { data: 'name', name: 'name' },
        {
          data: 'permissions', 
          name: 'permissions',
          render: function(permissions) {
            // Check if permissions is an array and has items
            if (permissions && Array.isArray(permissions) && permissions.length > 0) {
              return permissions.map(function(permission) {
                return '<span class="badge badge-success">' + permission + '</span>';
              }).join(' '); // Join all badges with a space
              
            } else {
              return '<span class="badge badge-secondary">No Permissions</span>';
            }
          },
          orderable: false,
          searchable: false
        },
        { data: 'actions', name: 'actions', orderable: false, searchable: false },
      ],
      responsive: true 
    });
  });
</script>
@endpush