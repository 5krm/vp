@extends('backend.layouts.app')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="textWhite">Add New Page</h1>
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
              <form action="{{ route('admin.pages.insert') }}" method="post" >
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Title</label>
                    <input type="text"  class="form-control" name="title" value="{{ old('title') }}" placeholder="Title">
                  </div>
                  <div class="form-group">
                    <label>Page Content</label>
                    <textarea
                      name="page_content"
                      class="form-control"
                      rows="5"
                    >
                      {!! old('page_content') !!}
                    </textarea>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary customButton">Submit</button>
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
    var editor = CKEDITOR.replace( 'page_content' , {
      toolbar: [
        { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike'] },
        { name: 'paragraph', items: ['NumberedList', 'BulletedList'] },
        { name: 'links', items: ['Link', 'Unlink'] },
        { name: 'document', items: ['Source'] } // Source code view
      ],
      customConfig: "{{ asset('assets/backend/plugins/ckeditor/config.js') }}",
      removeButtons: 'Image',
      allowedContent: true,
    });
  </script>
@endsection
