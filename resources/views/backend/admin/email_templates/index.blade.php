@extends('backend.layouts.app')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 pb-2 pb-sm-0">
            <h1 class="textWhite">Email Template List</h1>
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
                <table id="emailTemplateTable" style="width: 100%;" class="table table-striped">
                  <thead>
                    <tr>
                      <th style="width: 80px">S. No.</th>
                      <th>Name</th>
                      <th>Subject</th>
                      <th>Slug</th>
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
    var table = $('#emailTemplateTable').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: '{{ route('admin.email.templates.index') }}',
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
        { data: 'name', name: 'name' },
        { data: 'subject', name: 'subject' },
        { data: 'slug', name: 'slug' },
        { data: 'actions', name: 'actions', orderable: false, searchable: false },
      ],
      responsive: true 
    });
  });
</script>
@endpush