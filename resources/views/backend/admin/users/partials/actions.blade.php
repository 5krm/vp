<td>
  <div style="display: flex; gap: 2px;">
    <button
      type="button"
      class="btn btn-sm btn-primary edit-user-btn"
      data-id="{{ $user->id }}"
      data-toggle="modal"
      data-target="#modal-edit-user"
      {{ is_null($user->userPackageDetails) ? 'disabled' : '' }}
    >
      Edit
    </button>
    
    <button 
      type="button" 
      class="btn btn-sm btn-danger delete-user-btn" 
      data-id="{{ $user->id }}"
    >
      Delete
    </button>
  </div>
</td>

