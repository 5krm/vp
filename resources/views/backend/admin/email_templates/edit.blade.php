@extends('backend.layouts.app')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="textWhite">Edit Email Template</h1>
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
              <form action="{{ route('admin.email.templates.update') }}" method="post">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name', $emailTemplate->name) }}" placeholder="Name">
                    <input type="hidden" class="form-control" name="email_template_id" value="{{ $emailTemplate->id }}">
                  </div>
                  <div class="form-group">
                    <label>Slug</label>
                    <input type="text" class="form-control" name="slug" value="{{ old('slug', $emailTemplate->slug) }}" placeholder="Slug" readonly>
                  </div>
                  <div class="form-group">
                    <label>Subject</label>
                    <input type="text" class="form-control" name="subject" value="{{ old('subject', $emailTemplate->subject) }}" placeholder="Subject">
                  </div>
                  <div class="form-group">
                        <label>Email Body</label>
                        <textarea
                          name="content"
                          class="form-control"
                          rows="5"
                        >
                          {!! old('content', $emailTemplate->content ?? '') !!}
                        </textarea>
                      </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary customButton">Update</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
    <script src="{{asset('assets/backend/plugins/ckeditor/ckeditor.js')}}"></script>
  <script>
    var editor = CKEDITOR.replace( 'content' , {
      customConfig: "{{ asset('assets/backend/plugins/ckeditor/config.js') }}",
      removeButtons: 'Image',
      allowedContent: true,
    });
  </script>
@endsection