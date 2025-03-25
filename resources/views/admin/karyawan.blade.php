@extends('layouts.app')

@section('title', 'Manajemen Karyawan')

@section('styles')
    <style>
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
            background: #ffffff;
            padding: 0;
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
    </style>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">Manajemen Karyawan</div>
        <div class="card-body">
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#dataModal">
                <i class="fas fa-plus-circle me-2"></i>Tambah Data
            </button>
            <table id="karyawanTable" class="display table" style="width:100%">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Posisi</th>
                        <th>Departemen</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($karyawans as $karyawan)
                        <tr>
                            <td>{{ $karyawan->user->name }}</td>
                            <td>{{ $karyawan->user->email }}</td>
                            <td>{{ $karyawan->posisi }}</td>
                            <td>{{ $karyawan->departemen }}</td>
                            <td class="action-icons">
                                <i class="edit fa-solid fa-pen" title="Edit" data-bs-toggle="modal"
                                    data-bs-target="#editKaryawanModal" data-karyawan='@json($karyawan)'></i>
                                <i class="delete fa-solid fa-trash" title="Hapus" data-id="{{ $karyawan->id }}"></i>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Add -->
    <div class="modal fade" id="dataModal" tabindex="-1" aria-labelledby="dataModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title" id="dataModalLabel">Tambah Data Karyawan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-3">
                    <form action="{{ route('insertkaryawan.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="userSelect" class="form-label text-gray-600 mb-2">Pilih User</label>
                            <select class="form-select border border-gray-200 rounded-md p-2.5 focus-ring" id="userSelect"
                                name="user_id" required>
                                <option value="">-- Pilih User --</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->user_id }}"
                                        {{ old('user_id') == $user->user_id ? 'selected' : '' }}>
                                        {{ $user->name }} - {{ $user->email }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="posisi" class="form-label text-gray-600 mb-2">Posisi</label>
                            <input type="text" class="form-control border border-gray-200 rounded-md p-2.5 focus-ring"
                                id="posisi" name="posisi" value="{{ old('posisi') }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="departemen" class="form-label text-gray-600 mb-2">Departemen</label>
                            <input type="text" class="form-control border border-gray-200 rounded-md p-2.5 focus-ring"
                                id="departemen" name="departemen" value="{{ old('departemen') }}" required>
                        </div>

                        <div class="text-end mt-4 pt-2">
                            <button type="button" class="btn btn-light me-2 px-4" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary px-4">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editKaryawanModal" tabindex="-1" aria-labelledby="editKaryawanModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title" id="editKaryawanModalLabel">Edit Data Karyawan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-3">
                    <form id="editKaryawanForm" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="edit_karyawan_id" name="id">

                        <div class="mb-4">
                            <label for="edit_userSelect" class="form-label text-gray-600 mb-2">Pilih User</label>
                            <select class="form-select border border-gray-200 rounded-md p-2.5 focus-ring"
                                id="edit_userSelect" name="user_id" required>
                                <option value="">-- Pilih User --</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->user_id }}">{{ $user->name }} - {{ $user->email }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="edit_posisi" class="form-label text-gray-600 mb-2">Posisi</label>
                            <input type="text" class="form-control border border-gray-200 rounded-md p-2.5 focus-ring"
                                id="edit_posisi" name="posisi" required>
                        </div>

                        <div class="mb-4">
                            <label for="edit_departemen" class="form-label text-gray-600 mb-2">Departemen</label>
                            <input type="text" class="form-control border border-gray-200 rounded-md p-2.5 focus-ring"
                                id="edit_departemen" name="departemen" required>
                        </div>

                        <div class="text-end mt-4 pt-2">
                            <button type="button" class="btn btn-light me-2 px-4" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary px-4">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
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

            // HANDLE MODAL EDIT
            $(document).on("click", ".edit", function() {
                let karyawan = $(this).data("karyawan");

                $("#edit_karyawan_id").val(karyawan.id);
                $("#edit_userSelect").val(karyawan.user_id);
                $("#edit_posisi").val(karyawan.posisi);
                $("#edit_departemen").val(karyawan.departemen);

                let form = $("#editKaryawanForm");
                form.attr("action", `/karyawan/update/${karyawan.id}`);

                // Pastikan backdrop lama dihapus sebelum membuka modal baru
                $(".modal-backdrop").remove();
                $("body").removeClass("modal-open");

                let modal = new bootstrap.Modal(document.getElementById("editKaryawanModal"));
                modal.show();
            });

            // Hapus backdrop saat modal ditutup
            $(document).on("hidden.bs.modal", "#editKaryawanModal", function() {
                $(".modal-backdrop").remove();
                $("body").removeClass("modal-open");
            });

            // HANDLE DELETE KARYAWAN
            $(document).on("click", ".delete", function() {
                let karyawanId = $(this).data("id");

                if (confirm("Apakah Anda yakin ingin menghapus data karyawan ini?")) {
                    $.ajax({
                        url: `/hapus-karyawan/${karyawanId}`,
                        type: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            alert(response.message);
                            location.reload();
                        },
                        error: function() {
                            alert("Terjadi kesalahan saat menghapus data.");
                        }
                    });
                }
            });
        });
    </script>
@endsection
