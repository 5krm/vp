@extends('backend.layouts.app')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 pb-2 pb-sm-0">
            <h1 class="textWhite">Server List</h1>
          </div>
          <div class="col-sm-6 text-sm-right">
            <a href="{{ url('admin/servers/add') }}" class="btn btn-primary customButton">Add New Server</a>
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
                <table id="serverTable" style="width: 100%;" class="table table-striped">
                  <thead>
                    <tr>
                      <th style="width: 80px">S. No.</th>
                      <th>Server Name</th>
                      <th>Country</th>
                      <th>VPN Username</th>
                      <th>VPN Password</th>
                      <th>Is Premium?</th>
                      <th>Status</th>
                      <th>Actions</th>
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
    var table = $('#serverTable').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: '{{ route('admin.servers.index') }}',
      },
      columns: [
        {
          data: null, 
          name: 'serial',
          orderable: false,
          searchable: false,
          render: function (data, type, full, meta) {
            return meta.row + 1 + meta.settings._iDisplayStart;
          }
        },
        { data: 'name', name: 'name' },
        { data: 'country_name', name: 'country_name' },
        { data: 'vpn_credentials_username', name: 'vpn_credentials_username' },
        { data: 'vpn_credentials_password', name: 'vpn_credentials_password' },
        {
            data: 'access_type',
            name: 'access_type',
            render: function (data, type, full, meta) {
                return data.charAt(0).toUpperCase() + data.slice(1);
            }
        },
        { data: 'status', name: 'status' },
        { data: 'actions', name: 'actions', orderable: false, searchable: false },
      ],
      responsive: true 
    });
    

  });
</script>
@endpush