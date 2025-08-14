<!-- Edit Modal -->
<div class="modal fade" id="modal-edit-country">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('admin.countries.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-header">
          <h4 class="modal-title">Edit Country</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" class="form-control" name="country_id" value="">
          <div class="form-group">
            <label>Icon</label>
            <input type="file"  class="form-control" name="icon">
          </div>
          <!-- Icon Preview -->
          <div class="form-group text-center">
            <img id="icon-preview" src="" alt="Icon Preview" style="width: 80px; height: 50px;">
          </div>
          <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Name">
          </div>
          <div class="form-group">
            <label>Status</label>
            <select class="form-control" name="status">
              <option value="0">Active</option>
              <option value="1">Inactive</option>
            </select>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default customButtonDefault" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary customButton">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>