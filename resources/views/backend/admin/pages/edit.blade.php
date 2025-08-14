@extends('backend.layouts.app')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="textWhite">Edit Page</h1>
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
              <form action="{{ route('admin.pages.update') }}" method="post">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="title" value="{{ old('title', $page->title) }}" placeholder="Title">
                    <input type="hidden" class="form-control" name="page_id" value="{{ $page->id }}">
                  </div>
                  <div class="form-group">
                    <label>Page Content</label>
                    <textarea
                      name="page_content"
                      class="form-control"
                      rows="5"
                    >
                      {!! old('page_content', $page->page_content) !!}
                    </textarea>
                  </div>
                  <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                      <option value="0" @if($page->status == '0') selected @endif>Active</option>
                      <option value="1" @if($page->status == '1') selected @endif>Inactive</option>
                    </select>
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