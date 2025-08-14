@extends('backend.layouts.app')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 pb-2 pb-sm-0">
            <h1 class="textWhite">Admin List</h1>
          </div>
          <div class="col-sm-6 text-sm-right">
            <a href="{{ url('admin/admins/add') }}" class="btn btn-primary customButton">Add New Admin</a>
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
              <div class="card-header">
                <div class="row">
                  <div class="col-sm-6 col-lg-4 col-xl-2">
                    <select id="status_filter" class="form-control">
                      <option value="">Filter by Status</option>
                      <option value="0">Active</option>
                      <option value="1">Inactive</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="card-body table-responsive p-3">
                <table id="adminTable" style="width: 100%;" class="table table-striped">
                  <thead>
                    <tr>
                      <th style="width: 80px">S. No.</th>
                      <th>Username</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Roles</th>
                      <th>Status</th>
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
    var table = $('#adminTable').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: '{{ route('admin.admins.index') }}',
        data: function (d) {
          d.status_filter = $('#status_filter').val();
        }
      },
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
        { data: 'username', name: 'username' },
        { data: 'name', name: 'name' },
        { data: 'email', name: 'email' },
        { data: 'roles', name: 'roles', orderable: false, searchable: false },
        { data: 'status', name: 'status' },
        { data: 'actions', name: 'actions', orderable: false, searchable: false },
      ],
      responsive: true 
    });

    $('#status_filter').change(function(){
      table.draw();
    });
  });
</script>
@endpush