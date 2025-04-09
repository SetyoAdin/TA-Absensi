<div class="d-flex gap-2">
    <a href="{{ route('absen.edit', $absen->absen_id) }}" class="btn btn-sm btn-warning">
        <i class="fas fa-edit"></i>
    </a>
    <form action="{{ route('absen.destroy', $absen->absen_id) }}" method="POST"
        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger">
            <i class="fas fa-trash"></i>
        </button>
    </form>
</div>
