<div class="modal fade" id="modal-edit-user">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Loader -->
      <div id="edit-loader" style="display:none; position:absolute; top:0; left:0; width:100%; height:100%; background:rgba(233, 233, 233, 1); z-index:10;">
        <div style="width:100%; height:100%; display: flex; justify-content: center; align-items: center;">  
          <div class="spinner-border text-primary" role="status"></div>
        </div>
      </div>
      
      <form action="{{ route('admin.users.update') }}" method="post">
        @csrf
        <div class="modal-header">
          <h4 class="modal-title">Change Package</h4>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" class="form-control" name="user_id" value="">
          <div class="form-group"> 
            <label>Package</label>
            <select class="form-control" name="package_id">
              @foreach($pricings as $pricing)
                <option value="{{ $pricing->id }}">{{ $pricing->package_name }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button
            type="button"
            class="btn btn-default"
            data-dismiss="modal"
          >
            Close
          </button>
          <button type="submit" class="btn btn-primary customButton">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>