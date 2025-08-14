@extends('backend.layouts.app')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6 pb-2 pb-sm-0">
          <h1 class="textWhite">Country List</h1>
        </div>
        <div class="col-sm-6 text-sm-right">
          <button type="button" class="btn btn-primary customButton" data-toggle="modal" data-target="#modal-add-country">Add New Country</button>
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
              <table id="countryTable" style="width: 100%;" class="table table-striped">
                <thead>
                  <tr>
                    <th style="width: 80px">S. No.</th>
                    <th>Name</th>
                    <th>Icon</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Dynamic data will be loaded here by DataTables -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

@include('backend.admin.countries.partials.add_modal')
@include('backend.admin.countries.partials.edit_modal')

@endsection

@push('scripts')
<script>
  // Yajra datatable
  $(document).ready(function() {
    var countryTable = $('#countryTable').DataTable({
      processing: true,
      serverSide: true,
      stateSaveCallback: function (settings, data) {
        localStorage.setItem('CountryTableState', JSON.stringify(data));
      },
      stateLoadCallback: function (settings) {
        var data = JSON.parse(localStorage.getItem('CountryTableState'));
        return data ? data : null;
      },
      ajax: {
        url: '{{ route('admin.countries.index') }}',
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
        { 
          data: 'icon', 
          name: 'icon',
          render: function(data, type, row, meta) {
            if (data) {
              return '<img src="{{ asset('') }}' + data + '" alt="Icon" style="width: 70px; height: 50px;">';
            }
            return 'N/A';
          }
        },
        { data: 'status', name: 'status' },
        { data: 'actions', name: 'actions', orderable: false, searchable: false },
      ],
      order: [],
      responsive: true 
    });


    handleAddFormSubmission();
    handleEditFormSubmission();
    handleEditCountry();
    handleDeleteCountry();

    // Handle Add Form Submission
    function handleAddFormSubmission() {
      $('#modal-add-country form').on('submit', function(e) {
        e.preventDefault();
        let form = $(this);
        let formData = new FormData(this);

        $.ajax({
          url: form.attr('action'),
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          success: function(response) {
            form[0].reset();
            if(response.status == 'success'){
              successToast(response.message);
            }else {
              errorToast(response.message);
            }
            $('#modal-add-country').modal('hide');
            countryTable.page(0).draw('page'); // Reset DataTable to first page
          },
          error: function(xhr) {
            let errors = xhr.responseJSON.errors;
            for (let key in errors) {
              errorToast(errors[key][0]);
            }
          }
        });
      });
    }

    // Handle Edit Form Submission
    function handleEditFormSubmission() {
      $('#modal-edit-country form').on('submit', function(e) {
        e.preventDefault();
        let form = $(this);
        let formData = new FormData(this);

        $.ajax({
          url: form.attr('action'),
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          success: function (response) {
            if(response.status == 'success'){
              successToast(response.message);
            }else {
              errorToast(response.message);
            }
            $('#modal-edit-country').modal('hide');
            countryTable.ajax.reload(null, false);
          },
          error: function (xhr) {
            let errors = xhr.responseJSON.errors;
            for (let key in errors) {
              errorToast(errors[key][0]);
            }
          }
        });
      });
    }

    function handleEditCountry() {
      $('#countryTable').on('click', '.edit-country-btn', function() {
        var countryId = $(this).data('id');
        var modal = document.getElementById('modal-edit-country');
        var countryIdIdInput = modal.querySelector('input[name="country_id"]');
        var iconPreview = modal.querySelector('#icon-preview');
        var statusSelect = modal.querySelector('select[name="status"]');
        
        fetch('/admin/countries/' + countryId)
          .then(response => response.json())
          .then(data => {
            console.log(data);
            countryIdIdInput.value = data.id;
            iconPreview.src = "{{ asset('') }}" + data.icon;
            modal.querySelector('input[name="name"]').value = data.name;
            statusSelect.value = data.status;
          })
          .catch(error => console.error('Error fetching country data:', error));
      });
    }

    function handleDeleteCountry() {
      $('#countryTable').on('click', '.delete-country-btn', function() {
        let countryId = $(this).data('id');

        if (confirm('Are you sure you want to delete this country?')) {
          $.ajax({
            url: `/admin/countries/${countryId}`,
            type: 'DELETE',
            data: {
              _token: '{{ csrf_token() }}'
            },
            success: function(response) {
              if(response.status == 'success'){
                successToast(response.message);
              }else {
                errorToast(response.message);
              }
              countryTable.ajax.reload(null, false);
            },
            error: function(xhr) {
              errorToast('An error occurred. Please try again');
            }
          });
        }
      });
    }

    
  });
</script>
@endpush