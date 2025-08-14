@extends('backend.layouts.app')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="textWhite">Send Notification</h1>
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
              <form action="{{ route('admin.notifications.send') }}" method="post">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Title</label>
                    <input type="text"  class="form-control" name="title" value="{{ old('title') }}" placeholder="Title">
                  </div>
                  <div class="form-group">
                    <label>Message</label>
                    <textarea type="text" class="form-control" name="message" rows="5" placeholder="Message" >{{ old('message') }}</textarea>
                  </div>
                  <div class="form-group">
                    <label>Image URL</label>
                    <input type="text"  class="form-control" name="image_url" value="{{ old('image_url') }}" placeholder="https://xxxxxxxx.jpg/png/">
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary customButton">Send</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
