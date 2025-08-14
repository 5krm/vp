<!-- Add Modal -->
<div class="modal fade" id="modal-add-country">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('admin.countries.add') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-header">
          <h4 class="modal-title">Add Country</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Icon</label>
            <input type="file"  class="form-control" name="icon">
          </div>
          <div class="form-group">
            <label>Name</label>
            <input type="text"  class="form-control" name="name" value="{{ old('name') }}" placeholder="Name">
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default customButtonDefault" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary customButton">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
