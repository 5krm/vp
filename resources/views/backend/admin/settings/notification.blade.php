@extends('backend.layouts.app')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="textWhite">Notification Setting</h1>
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
              <form action="{{ route('admin.settings.upload.firebase.credentials') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="alert alert-warning" role="alert">
                    <h4 class="alert-heading">Warning!</h4>
                    <p>Uploading new Firebase credentials will overwrite the current stored credentials. Ensure you have a backup of the existing credentials if needed.</p>
                    <hr>
                    <p class="mb-0">Please verify that the new credentials are correct and up-to-date before proceeding with the upload.</p>
                  </div>
                  <div class="form-group">
                    <label>Upload Firebase Credentials</label>
                    <input type="file"  class="form-control" name="firebase_credentials" accept=".json">
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary customButton">Upload</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection

