@extends('backend.layouts.app')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6 pb-2 pb-sm-0">
          <h1 class="textWhite">User List</h1>
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
              <table id="usersTable" style="width: 100%;" class="table table-striped">
                <thead>
                  <tr>
                    <th style="width: 80px">S. No.</th>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Login Mode</th>
                    <th>Purchased Package</th>
                    <th>Purchase Date</th>
                    <th>Expiry Date</th>
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

@include('backend.admin.users.partials.edit_modal')

@endsection

@push('scripts')
<script>
  $(document).ready(function() {
    var usersTable = $('#usersTable').DataTable({
      processing: true,
      serverSide: true,
      pageLength: 50,
      // stateSave: true, 
      stateSaveCallback: function (settings, data) {
        localStorage.setItem('UsersTableState', JSON.stringify(data));
      },
      stateLoadCallback: function (settings) {
        var data = JSON.parse(localStorage.getItem('UsersTableState'));
        return data ? data : null;
      },
      ajax: {
        url: '{{ route('admin.users.index') }}',
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
        { 
          data: 'name', 
          name: 'name',
          render: function (data, type, row) {
            return data ? data : 'N/A';  
          }
        },
        { 
          data: 'phone', 
          name: 'phone',
          render: function (data, type, row) {
            return data ? data : 'N/A';  
          }
        },
        { 
          data: 'login_mode', 
          name: 'login_mode',
          render: function (data, type, row) {
            return data.charAt(0).toUpperCase() + data.slice(1).toLowerCase();
          }
        },
        { 
          data: 'user_package_details.package_pricing.package_name',
          name: 'userPackageDetails.packagePricing.package_name',
          render: function (data, type, row) {
              return data ? data : 'N/A';
          }
        },
        { 
          data: 'user_package_details', 
          name: 'userPackageDetails.purchased_at	',
          render: function (data, type, row) {
            return data && data.purchased_at ? data.purchased_at : 'N/A';
          }
        },
        { 
          data: 'user_package_details', 
          name: 'userPackageDetails.expires_at	',
          render: function (data, type, row) {
            return data && data.expires_at ? data.expires_at : 'N/A';
          }
        },
        { data: 'actions', name: 'actions', orderable: false, searchable: false},
      ],
      order: [],
      responsive: true 
    });

    // Handle the click event on edit buttons within the table
    $('#usersTable').on('click', '.edit-user-btn', function() {
      var userId = $(this).data('id');

      var modal = document.getElementById('modal-edit-user');
      var userIdInput = modal.querySelector('input[name="user_id"]');
      var packageSelect = modal.querySelector('select[name="package_id"]');

      $('#edit-loader').show();

      fetch('/admin/users/' + userId)
        .then(response => response.json())
        .then(data => {
          var user = data.user;
          console.log(user)
          userIdInput.value = user.id;
          packageSelect.value = user.user_package_details.package_id;
          $('#edit-loader').hide();
        })
        .catch(error => console.error('Error fetching user data:', error));
    });


    // Handle Edit User Form Submission
    $('#modal-edit-user form').on('submit', function(e) {
      e.preventDefault();
      const form = $(this);
      const formData = new FormData(this);

      $.ajax({
        url: form.attr('action'),
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function() {   
          form[0].reset();
          successToast('User package successfully updated');
          $('#modal-edit-user').modal('hide');
          usersTable.ajax.reload(null, false);
        },
        error: function(xhr) {
          const errors = xhr.responseJSON.errors;
          for (const key in errors) {
            errorToast(errors[key][0]);
          }
        }
      });
    });

    // Handle Delete User Button Click
    $('#usersTable').on('click', '.delete-user-btn', function() {
      const tagId = $(this).data('id');

      if (confirm('Are you sure you want to delete this user?')) {
        $.ajax({
          url: `/admin/users/${tagId}`,
          type: 'DELETE',
          data: {
            _token: '{{ csrf_token() }}'
          },
          success: function() {
            successToast('User deleted successfully');
            usersTable.ajax.reload(null, false);
          },
          error: function() {
            errorToast('Failed to delete user.');
          }
        });
      }
    });

    
  });
</script>
@endpush