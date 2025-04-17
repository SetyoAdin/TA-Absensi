<div class="d-flex gap-2">
    <a href="{{ route('absen.edit', $absen->absen_id) }}" class="btn btn-sm btn-warning">
        <i class="fas fa-pencil-alt"></i>
    </a>
    <a href="{{ route('absen.destroy', $absen->absen_id) }}" class="btn btn-sm btn-danger delete-absen">
        <i class="fas fa-trash"></i>
    </a>
</div>
