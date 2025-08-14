<td >
  <div style="display: flex; gap: 2px;">
    <button
      type="button"
      class="btn btn-sm btn-primary edit-country-btn"
      data-id="{{ $country->id }}"
      data-toggle="modal"
      data-target="#modal-edit-country"
    >
      Edit
    </button>
    <button 
      type="button" 
      class="btn btn-sm btn-danger delete-country-btn" 
      data-id="{{ $country->id }}"
    >
      Delete
    </button>
  </div>
</td>
