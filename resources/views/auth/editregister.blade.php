<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Inter', 'Segoe UI', sans-serif;
        }

        .container {
            max-width: 600px;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
            background: #ffffff;
            padding: 25px;
            margin-top: 50px;
        }

        .card-title {
            font-size: 20px;
            font-weight: 600;
            color: #212529;
        }

        .btn-primary {
            background-color: #4f46e5;
            border: none;
            border-radius: 6px;
            font-weight: 500;
            padding: 10px 16px;
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            background-color: #4338ca;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(79, 70, 229, 0.2);
        }

        .btn-light {
            background-color: #f3f4f6;
            border: none;
            color: #4b5563;
            font-weight: 500;
            border-radius: 6px;
            transition: all 0.2s;
        }

        .btn-light:hover {
            background-color: #e5e7eb;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <h5 class="card-title text-center mb-4">Edit Data Karyawan</h5>
            <form id="editUserForm" method="POST" action="/update-user/{{ $user->id ?? '' }}">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_user_id" name="user_id" value="{{ $user->id ?? '' }}">

                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="name" id="edit_name" class="form-control" required
                        value="{{ $user->name ?? '' }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" id="edit_email" class="form-control" required
                        value="{{ $user->email ?? '' }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control">
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah password</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select name="role" id="edit_role" class="form-control" required>
                        <option value="" disabled>Pilih Role</option>
                        <option value="karyawan" {{ ($user->role ?? '') == 'karyawan' ? 'selected' : '' }}>Karyawan
                        </option>
                        <option value="admin" {{ ($user->role ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>

                <div class="text-end mt-4">
                    <a href="/users" class="btn btn-light me-2 px-4">Batal</a>
                    <button type="submit" class="btn btn-primary px-4">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
