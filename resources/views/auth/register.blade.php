<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Inter', 'Segoe UI', sans-serif;
        }

        .container {
            max-width: 1500px;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
            background: #ffffff;
            padding: 0;
            margin-top: 32px;
            margin-bottom: 40px;
        }

        .card-header {
            background-color: #ffffff;
            color: #212529;
            font-size: 20px;
            font-weight: 600;
            text-align: left;
            padding: 25px 30px 15px;
            border-bottom: 1px solid #f0f0f0;
            border-radius: 12px 12px 0 0 !important;
        }

        .card-body {
            padding: 25px 30px;
        }

        .btn-primary {
            background-color: #4f46e5;
            border: none;
            border-radius: 6px;
            font-weight: 500;
            padding: 8px 16px;
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            background-color: #4338ca;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(79, 70, 229, 0.2);
        }

        table.dataTable {
            border-collapse: collapse !important;
            border-spacing: 0;
            width: 100%;
            border: none;
        }

        table.dataTable thead th {
            background-color: #fafafa;
            color: #6b7280;
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 14px 16px;
            border-bottom: 1px solid #f0f0f0;
        }

        table.dataTable tbody tr {
            transition: all 0.2s ease;
        }

        table.dataTable tbody tr:hover {
            background-color: #f9fafb;
        }

        table.dataTable tbody td {
            padding: 16px;
            vertical-align: middle;
            border-bottom: 1px solid #f0f0f0;
            color: #374151;
            font-size: 14px;
        }

        .action-icons {
            display: flex;
            gap: 16px;
            justify-content: flex-start;
        }

        .action-icons i {
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .action-icons .edit {
            color: #6b7280;
            font-size: 15px;
        }

        .action-icons .edit:hover {
            color: #4f46e5;
        }

        .action-icons .delete {
            color: #6b7280;
            font-size: 15px;
        }

        .action-icons .delete:hover {
            color: #ef4444;
        }

        /* DataTable custom styling */
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_processing,
        .dataTables_wrapper .dataTables_paginate {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            padding: 5px 10px;
            margin-left: 8px;
        }

        .dataTables_wrapper .dataTables_filter input:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.1);
        }

        .dataTables_wrapper .dataTables_length select {
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            padding: 5px 10px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border: 1px solid #e5e7eb !important;
            border-radius: 6px;
            padding: 5px 12px !important;
            margin: 0 3px;
            color: #6b7280 !important;
            background: #ffffff !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #f3f4f6 !important;
            border-color: #d1d5db !important;
            color: #111827 !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
            opacity: 0.5;
        }

        /* Modal styling */
        .modal-content {
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            padding: 25px 25px 15px;
        }

        .modal-title {
            font-weight: 600;
            color: #212529;
            font-size: 20px;
        }

        .modal-body {
            padding: 0 25px 25px;
        }

        .btn-close {
            background-size: 0.8em;
            opacity: 0.5;
            transition: all 0.2s;
        }

        .btn-close:hover {
            opacity: 0.8;
            transform: rotate(90deg);
        }

        /* Form controls */
        .form-label {
            font-weight: 500;
            font-size: 14px;
            color: #6b7280;
        }

        .form-control,
        .form-select {
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            padding: 10px 12px;
            font-size: 14px;
            transition: all 0.2s;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .focus-ring:focus {
            outline: none;
        }

        /* Button styling */
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

        .btn-primary {
            background-color: #4f46e5;
            border: none;
            font-weight: 500;
            border-radius: 6px;
            transition: all 0.2s;
        }

        .btn-primary:hover {
            background-color: #4338ca;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(79, 70, 229, 0.2);
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">Manajemen User</div>
            <div class="card-body">
                <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#dataModal">
                    <i class="fas fa-plus-circle me-2"></i>Tambah Data
                </button>
                <table id="karyawanTable" class="display table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Tanggal Daftar</th>
                            <th>Di Edit Pada</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ ucfirst($user->role) }}</td>
                                <td>{{ $user->created_at->format('d M Y') }}</td>
                                <td>{{ $user->updated_at->format('d M Y') }}</td>
                                <td class="action-icons">
                                    <i class="edit fa-solid fa-pen" title="Edit"
                                        data-user='@json($user)' style="cursor: pointer;"></i>

                                    <i class="delete fa-solid fa-trash" title="Hapus"
                                        data-url="{{ route('hapus-user', ['id' => $user->user_id]) }}"></i>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title" id="editUserModalLabel">Edit Data Karyawan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-3">
                    <form id="editUserForm" method="POST" action="{{ route('users.userupdate', ':id') }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="edit_user_id" name="user_id">

                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="name" id="edit_name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" id="edit_email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control">
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah password</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <select name="role" id="edit_role" class="form-control" required>
                                <option value="">Pilih Role</option>
                                <option value="karyawan">Karyawan</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>

                        <div class="text-end mt-4 pt-2">
                            <button type="button" class="btn btn-light me-2 px-4"
                                data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary px-4">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="dataModal" tabindex="-1" aria-labelledby="dataModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title" id="dataModalLabel">Tambah Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-3">
                    <form action="{{ route('register.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <select name="role" class="form-control" required>
                                <option value="">Pilih Role</option>
                                <option value="karyawan" {{ old('role') == 'karyawan' ? 'selected' : '' }}>Karyawan
                                </option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        </div>

                        <div class="text-end mt-4 pt-2">
                            <button type="button" class="btn btn-light me-2 px-4"
                                data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary px-4">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#karyawanTable').DataTable({
                "paging": true,
                "searching": true,
                "language": {
                    "search": "Cari:",
                    "lengthMenu": "Tampilkan _MENU_ entri",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                    "infoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
                    "infoFiltered": "(disaring dari _MAX_ total entri)",
                    "zeroRecords": "Tidak ada data yang cocok",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    }
                }
            });
        });

        // HANDLE DELETE USER
        $(document).on('click', '.delete', function() {
            let url = $(this).data('url'); // Ambil URL dari data-url
            let button = $(this);

            if (confirm("Apakah Anda yakin ingin menghapus pengguna ini?")) {
                button.prop("disabled", true); // Hindari double-click

                $.ajax({
                    url: url, // Gunakan URL dari Blade
                    type: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                        "X-Requested-With": "XMLHttpRequest"
                    },
                    success: function(response) {
                        alert(response.message);
                        button.closest("tr").fadeOut(300, function() {
                            $(this).remove();
                        });
                    },
                    error: function(xhr) {
                        let errorMessage = "Terjadi kesalahan saat menghapus data.";
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        alert(errorMessage);
                        button.prop("disabled", false);
                    }
                });
            }
        });

        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.edit').forEach(icon => {
                icon.addEventListener('click', function() {
                    let user = this.getAttribute('data-user');

                    try {
                        user = JSON.parse(user); // Parse JSON dari atribut data-user
                        if (user && user.id) {
                            window.location.href = `/editregister/${user.id}`;
                        } else {
                            console.error("User ID tidak ditemukan!", user);
                        }
                    } catch (error) {
                        console.error("Gagal mem-parsing data user:", error);
                    }
                });
            });
        });
    </script>
</body>

</html>
