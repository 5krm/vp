<td>
    <div style="display: flex; gap: 2px;">
        <a href="{{ url('admin/pages/' . $page->id . '/edit') }}" class="btn btn-sm btn-primary">Edit</a>
        <form action="{{ route('admin.pages.delete', $page->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this Page?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
        </form>
    </div>
</td>