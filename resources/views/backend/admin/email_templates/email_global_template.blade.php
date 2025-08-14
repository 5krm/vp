@extends('backend.layouts.app')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="textWhite">Email Global Template</h1>
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
              <form action="{{ route('admin.email.global-template.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Email Header Logo</label>
                        <input type="file" class="form-control" name="email_header">
                      </div>
                      @if(!empty($emailGlobalTemplate->email_header))
                        <img src="{{ asset($emailGlobalTemplate->email_header) }}" style="height: 100px; width: 100px; margin-top: 10px;" alt="image">
                      @endif
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Email Footer</label>
                        <textarea
                          name="email_footer"
                          class="form-control"
                          rows="5"
                        >
                          {!! old('email_footer', $emailGlobalTemplate->email_footer ?? '') !!}
                        </textarea>
                      </div>
                    </div>
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
    var editor = CKEDITOR.replace( 'email_footer' , {
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