@extends('backend.layouts.app')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 pb-2 pb-sm-0">
            <h1 class="textWhite">Pricing List</h1>
          </div>
          <div class="col-sm-6 text-sm-right">
            <a href="{{ url('admin/pricings/add') }}" class="btn btn-primary customButton">Add New Pricing</a>
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
                <table id="pricingTable" style="width: 100%;" class="table table-striped">
                  <thead>
                    <tr>
                      <th style="width: 80px">S. No.</th>
                      <th>Package Name</th>
                      <th>Durarion (in days)</th>
                      <th>Price</th>
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
    var table = $('#pricingTable').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: '{{ route('admin.pricings.index') }}',
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
        { data: 'package_name', name: 'package_name' },
        { data: 'package_duration', name: 'package_duration' },
        { data: 'package_price', name: 'package_price' },
        { data: 'status', name: 'status' },
        { data: 'actions', name: 'actions', orderable: false, searchable: false },
      ],
      responsive: true 
    });
    

  });
</script>
@endpush