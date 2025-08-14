@extends('backend.layouts.app')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 pb-2 pb-sm-0">
            <h1 class="textWhite">Page List</h1>
          </div>
          <div class="col-sm-6 text-sm-right">
            <a href="{{ url('admin/pages/add') }}" class="btn btn-primary customButton">Add New Page</a>
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
                <table id="pageTable" style="width: 100%;" class="table table-striped">
                  <thead>
                    <tr>
                      <th style="width: 80px">S. No.</th>
                      <th>Title</th>
                      <th>Slug</th>
                      <th>Status</th>
                      <th>Operate</th>
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
    var table = $('#pageTable').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: '{{ route('admin.pages.index') }}',
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
        { data: 'title', name: 'title' },
        { data: 'slug', name: 'slug' },
        { data: 'status', name: 'status' },
        { data: 'actions', name: 'actions', orderable: false, searchable: false },
      ],
      responsive: true 
    });


  });
</script>
@endpush