@extends('layouts.main') {{-- Gunakan template utama --}}

@section('title', 'Kategori Izin') {{-- Set title --}}

@section('content')
    {{-- <style>
        /* Masukkan semua CSS dark mode kamu di sini */
        :root {
            --dark-bg: #121212;
            --dark-section: #1e1e1e;
            --dark-input: #2d2d2d;
            --accent-color: #6366f1;
            --accent-hover: #4f46e5;
            --text-primary: #f3f4f6;
            --text-secondary: #9ca3af;
            --danger: #ef4444;
            --danger-hover: #dc2626;
            --warning: #f59e0b;
            --warning-hover: #d97706;
            --success: #10b981;
            --border-color: #2d2d2d;
        }

        body {
            background-color: var(--dark-bg);
            color: var(--text-primary);
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
            width: 100%;
        }

        .page-title {
            font-weight: 700;
            font-size: 1.75rem;
            margin-bottom: 30px;
        }

        .form-section,
        .table-section {
            background-color: var(--dark-section);
            border-radius: 10px;
            padding: 24px;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        .section-header {
            font-weight: 600;
            font-size: 1.25rem;
            margin-bottom: 20px;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 12px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--text-secondary);
        }

        .form-control {
            width: 100%;
            padding: 10px 14px;
            background-color: var(--dark-input);
            border: 1px solid var(--border-color);
            border-radius: 6px;
            color: var(--text-primary);
            margin-bottom: 16px;
        }

        .form-control:focus {
            border-color: var(--accent-color);
            outline: none;
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.25);
        }

        /* Buttons */
        .btn {
            border-radius: 6px;
            padding: 10px 16px;
            font-weight: 500;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .btn-primary {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--accent-hover);
            border-color: var(--accent-hover);
        }

        .btn-warning {
            background-color: var(--warning);
            border-color: var(--warning);
            color: white;
        }

        .btn-warning:hover {
            background-color: var(--warning-hover);
            border-color: var(--warning-hover);
        }

        .btn-danger {
            background-color: var(--danger);
            border-color: var(--danger);
            color: white;
        }

        .btn-danger:hover {
            background-color: var(--danger-hover);
            border-color: var(--danger-hover);
        }

        .btn-sm {
            padding: 6px 10px;
            font-size: 0.875rem;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table thead {
            background-color: rgba(255, 255, 255, 0.05);
        }

        .table thead th {
            padding: 12px 16px;
            text-align: left;
            font-size: 0.75rem;
            color: var(--text-secondary);
            border-bottom: 2px solid var(--border-color);
            text-transform: uppercase;
        }

        .table tbody tr {
            transition: background-color 0.2s ease;
        }

        .table tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.03);
        }

        .table tbody td {
            padding: 14px 16px;
            border-bottom: 1px solid var(--border-color);
        }

        .alert-success {
            background-color: rgba(16, 185, 129, 0.2);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: var(--success);
            padding: 12px 16px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .d-flex {
            display: flex;
        }

        .flex-wrap {
            flex-wrap: wrap;
        }

        .d-flex.gap-2 {
            gap: 0.2rem;
            /* atau sesuai kebutuhan */
        }
    </style> --}}

    <style>
        :root {
            --dark-bg: #121212;
            --dark-section: #1e1e1e;
            --dark-input: #2d2d2d;
            --accent-color: #6366f1;
            --accent-hover: #4f46e5;
            --text-primary: #f3f4f6;
            --text-secondary: #9ca3af;
            --danger: #ef4444;
            --danger-hover: #dc2626;
            --warning: #f59e0b;
            --warning-hover: #d97706;
            --success: #10b981;
            --border-color: #2d2d2d;
        }

        body {
            background-color: var(--dark-bg);
            color: var(--text-primary);
            font-family: 'Inter', sans-serif;
        }

        /* Section headers */
        .section-header {
            font-weight: 600;
            font-size: 1.25rem;
            color: var(--text-primary);
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--border-color);
        }

        /* Form section */
        .form-section {
            background-color: var(--dark-section);
            border-radius: 10px;
            padding: 24px;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        /* Table section */
        .table-section {
            background-color: var(--dark-section);
            border-radius: 10px;
            padding: 24px;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        /* Form layout with columns */
        .form-row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -10px;
            margin-left: -10px;
        }

        .form-col {
            flex: 0 0 100%;
            padding-right: 10px;
            padding-left: 10px;
            margin-bottom: 15px;
        }

        /* Form controls */
        .form-control,
        select.form-control {
            background-color: var(--dark-input);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            border-radius: 6px;
            padding: 10px 14px;
            transition: all 0.2s ease;
            width: 100%;
            height: auto;
        }

        .form-control:focus,
        select.form-control:focus {
            background-color: var(--dark-input);
            border-color: var(--accent-color);
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.25);
            color: var(--text-primary);
        }

        .form-label {
            color: var(--text-secondary);
            margin-bottom: 8px;
            font-weight: 500;
            display: block;
        }

        option {
            background-color: var(--dark-input);
            color: var(--text-primary);
        }

        /* Buttons */
        .btn {
            border-radius: 6px;
            padding: 10px 16px;
            font-weight: 500;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .btn-primary {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--accent-hover);
            border-color: var(--accent-hover);
        }

        .btn-warning {
            background-color: var(--warning);
            border-color: var(--warning);
            color: white;
        }

        .btn-warning:hover {
            background-color: var(--warning-hover);
            border-color: var(--warning-hover);
        }

        .btn-danger {
            background-color: var(--danger);
            border-color: var(--danger);
            color: white;
        }

        .btn-danger:hover {
            background-color: var(--danger-hover);
            border-color: var(--danger-hover);
        }

        .btn-sm {
            padding: 6px 10px;
            font-size: 0.875rem;
        }

        /* Form action buttons */
        .form-actions {
            margin-top: 20px;
            display: flex;
            justify-content: flex-end;
        }

        /* Table styling */
        .table {
            color: var(--text-primary);
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-bottom: 0;
        }

        .table-bordered {
            border: none;
        }

        .table thead th {
            background-color: rgba(255, 255, 255, 0.05);
            border-bottom: 2px solid var(--border-color);
            color: var(--text-secondary);
            padding: 12px 16px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
        }

        .table tbody td {
            padding: 14px 16px;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

        .table tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.03);
        }

        /* Alert styling */
        .alert {
            border-radius: 6px;
            padding: 12px 16px;
            margin-bottom: 20px;
            animation: fadeIn 0.3s ease-in-out;
        }

        .alert-success {
            background-color: rgba(16, 185, 129, 0.2);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: var(--success);
        }

        /* Main container styling */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
            width: 100%;
        }

        .page-title {
            color: var(--text-primary);
            font-weight: 700;
            margin: 30px 0;
            font-size: 1.75rem;
        }

        /* Action buttons spacing */
        td .btn {
            margin-right: 5px;
        }

        /* Adding soft transitions */
        * {
            transition: background-color 0.2s ease, color 0.2s ease, border-color 0.2s ease;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--dark-bg);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--border-color);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--accent-color);
        }

        /* Form group margin */
        .mb-3 {
            margin-bottom: 20px;
        }

        /* Make table responsive */
        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            border-radius: 8px;
        }

        /* Animation for alerts */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .dataTables_filter {
            text-align: left;
            margin-bottom: 15px;
        }

        .dataTables_filter input {
            width: 180px;
            padding: 6px 10px;
            border-radius: 6px;
            background-color: var(--dark-input);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
        }

        .dataTables_filter input:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 4px rgba(99, 102, 241, 0.4);
        }

        /* NEW RESPONSIVE IMPROVEMENTS */

        /* Enhanced media queries for better granularity */
        @media (min-width: 576px) {
            .form-col-sm-6 {
                flex: 0 0 50%;
                max-width: 50%;
            }
        }

        @media (min-width: 768px) {
            .form-col-md-4 {
                flex: 0 0 33.333333%;
                max-width: 33.333333%;
            }

            .form-col-md-6 {
                flex: 0 0 50%;
                max-width: 50%;
            }
        }

        @media (max-width: 767px) {

            /* Adjustments for mobile view */
            .page-title {
                font-size: 1.5rem;
                margin: 20px 0;
            }

            .section-header {
                font-size: 1.1rem;
            }

            .form-section,
            .table-section {
                padding: 15px;
            }

            .form-actions {
                justify-content: center;
            }

            /* Make buttons more touch-friendly on mobile */
            .btn {
                padding: 10px 14px;
                min-height: 44px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
            }

            /* Stack action buttons on small screens */


            /* DataTables mobile improvements */
            .dataTables_filter {
                margin-bottom: 10px;
            }

            .dataTables_filter input {
                width: 100%;
                max-width: 100%;
            }

            .dataTables_length {
                text-align: left;
                margin-bottom: 10px;
            }

            .dataTables_length select {
                padding: 6px 10px;
                border-radius: 6px;
                background-color: var(--dark-input);
                border: 1px solid var(--border-color);
                color: var(--text-primary);
            }
        }

        /* Fix font size on smaller screens */
        @media (max-width: 480px) {
            html {
                font-size: 14px;
            }

            .table thead th {
                padding: 10px 8px;
                font-size: 0.7rem;
            }

            .table tbody td {
                padding: 10px 8px;
            }

            /* Fix button spacing on small screens */
            td .btn {
                margin-right: 2px;
                padding: 6px 8px;
            }

            .form-actions {
                flex-direction: column;
            }

            .form-actions .btn {
                width: 100%;
                margin-bottom: 10px;
            }
        }

        /* Helper class for wrapping button containers on mobile */
        .d-flex {
            display: flex;
        }

        .flex-wrap {
            flex-wrap: wrap;
        }

        /* DataTables Styling */
        div.dataTables_wrapper {
            margin-bottom: 20px;
            background-color: var(--dark-section);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        div.dataTables_wrapper div.dataTables_length select {
            width: auto;
            background-color: var(--dark-input);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            border-radius: 6px;
            padding: 8px 12px;
        }

        div.dataTables_wrapper div.dataTables_filter input {
            width: 250px;
            background-color: var(--dark-input);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            border-radius: 6px;
            padding: 8px 12px;
            margin-left: 10px;
        }

        div.dataTables_wrapper div.dataTables_filter input:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.25);
            outline: none;
        }

        div.dataTables_wrapper div.dataTables_length,
        div.dataTables_wrapper div.dataTables_filter,
        div.dataTables_wrapper div.dataTables_info,
        div.dataTables_wrapper div.dataTables_paginate {
            margin-bottom: 15px;
            color: var(--text-secondary);
        }

        div.dataTables_wrapper div.dataTables_paginate .paginate_button {
            padding: 6px 12px;
            border-radius: 6px;
            background-color: var(--dark-input);
            border: 1px solid var(--border-color);
            color: var(--text-primary) !important;
            margin: 0 3px;
        }

        div.dataTables_wrapper div.dataTables_paginate .paginate_button.current {
            background-color: var(--accent-color) !important;
            border-color: var(--accent-color) !important;
            color: white !important;
        }

        div.dataTables_wrapper div.dataTables_paginate .paginate_button:hover:not(.current) {
            background-color: rgba(255, 255, 255, 0.05) !important;
            border-color: var(--accent-color) !important;
            color: var(--text-primary) !important;
        }

        /* SweetAlert2 Custom Styling */
        .swal2-popup {
            background-color: var(--dark-section) !important;
            color: var(--text-primary) !important;
            border-radius: 10px !important;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2) !important;
        }

        .swal2-title {
            color: var(--text-primary) !important;
        }

        .swal2-timer-progress-bar {
            background: var(--success) !important;
        }

        .swal2-icon.swal2-success {
            border-color: var(--success) !important;
            color: var(--success) !important;
        }

        .swal2-icon.swal2-success .swal2-success-ring {
            border-color: var(--success) !important;
        }

        .swal2-icon.swal2-success [class^="swal2-success-line"] {
            background-color: var(--success) !important;
        }

        .swal2-icon.swal2-error {
            border-color: var(--danger) !important;
            color: var(--danger) !important;
        }

        .swal2-icon.swal2-error [class^="swal2-x-mark-line"] {
            background-color: var(--danger) !important;
        }
    </style>

    <main class="h-full pb-16 overflow-y-auto">
        <div class="container px-6 mx-auto grid">
            <h2 class="page-title">
                Kategori Izin
            </h2>

            {{-- @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif --}}

            <!-- Form Tambah Pengguna -->
            <div class="form-section">
                <h2 class="section-header">Tambah Kategori Izin</h2>
                <form action="/kategori-izin/store" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="nama_kategori">Nama Kategori</label>
                        <input type="text" id="nama_kategori" name="nama_kategori" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="deskripsi">Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi" class="form-control" rows="4"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>


            <!-- Tabel Pengguna -->
            <div class="table-section">
                <h2 class="section-header">Daftar Kategori Izin</h2>
                <div class="table-responsive">
                    <table id="kategoriIzinTable" class="table">
                        <thead>
                            <tr>
                                <th>Nama Kategori</th>
                                <th>Deskripsi</th>
                                <th>Dibuat Pada</th>
                                <th>Diperbarui Pada</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kategori_izins as $index => $izin)
                                <tr>
                                    <td>{{ $izin->nama_kategori }}</td>
                                    <td>{{ $izin->deskripsi }}</td>
                                    <td>{{ $izin->created_at->format('d M Y') }}</td>
                                    <td>{{ $izin->updated_at->format('d M Y') }}</td>
                                    <td>
                                        <div class="d-flex flex-wrap gap-2">
                                            <a href="{{ route('kategori-izin.edit', $izin->detail_izin_id) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <form action="{{ route('kategori-izin.destroy', $izin->detail_izin_id) }}"
                                                method="POST" class="d-inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm delete-btn" type="button">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>
@endsection


@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            // SweetAlert2 Configuration
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            // Show success message if exists
            @if (session('success'))
                Toast.fire({
                    icon: 'success',
                    title: '{{ session('success') }}'
                });
            @endif

            // Show error message if exists
            @if (session('error'))
                Toast.fire({
                    icon: 'error',
                    title: '{{ session('error') }}'
                });
            @endif

            // Delete Confirmation
            $('.delete-btn').click(function(e) {
                e.preventDefault();
                const form = $(this).closest('form');
                const namaKategori = $(this).closest('tr').find('td:first').text();

                Swal.fire({
                    title: 'Konfirmasi Hapus',
                    html: `Apakah Anda yakin ingin menghapus kategori <strong>${namaKategori}</strong>?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                    background: 'var(--dark-section)',
                    color: 'var(--text-primary)',
                    customClass: {
                        popup: 'swal2-popup',
                        title: 'swal2-title',
                        content: 'swal2-content',
                        confirmButton: 'swal2-confirm',
                        cancelButton: 'swal2-cancel'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });

            // DataTables Configuration
            $('#kategoriIzinTable').DataTable({
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data per halaman",
                    zeroRecords: "Tidak ada data yang ditemukan",
                    info: "Menampilkan halaman _PAGE_ dari _PAGES_",
                    infoEmpty: "Tidak ada data tersedia",
                    infoFiltered: "(difilter dari _MAX_ total data)",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Selanjutnya",
                        previous: "Sebelumnya"
                    }
                },
                responsive: true,
                order: [
                    [2, 'desc']
                ], // Sort by created_at
                pageLength: 10,
                lengthMenu: [10, 25, 50, 100],
                dom: '<"top"lf>rt<"bottom"ip>',
                drawCallback: function() {
                    $('.dataTables_paginate > .paginate_button').addClass('btn btn-sm');
                }
            });
        });
    </script>
@endsection
