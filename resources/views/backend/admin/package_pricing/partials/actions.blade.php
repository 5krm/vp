<td>
    <div style="display: flex; gap: 2px;">
        <a href="{{ url('admin/pricings/' . $pricing->id . '/edit') }}" class="btn btn-sm btn-primary">Edit</a>
        <form action="{{ route('admin.pricings.delete', $pricing->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this Pricing?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
        </form>
    </div>
</td>