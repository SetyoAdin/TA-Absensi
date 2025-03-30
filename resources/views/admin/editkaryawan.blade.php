<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Karyawan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">Edit Karyawan</div>
            <div class="card-body">
                <form action="{{ route('karyawan.updatekaryawan', $karyawan->user_id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Nama</label>
                        <select name="user_id" id="user_id" class="form-control" required>
                            <option value="" disabled>Pilih Nama</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->user_id }}"
                                    {{ $user->user_id == $karyawan->user_id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="posisi" class="form-label">Posisi</label>
                        <input type="text" name="posisi" id="posisi" class="form-control"
                            value="{{ $karyawan->posisi }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="departemen" class="form-label">Departemen</label>
                        <input type="text" name="departemen" id="departemen" class="form-control"
                            value="{{ $karyawan->departemen }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="/karyawan/create" class="btn btn-secondary">Kembali</a>
                </form>

            </div>
        </div>
    </div>
</body>

</html>
