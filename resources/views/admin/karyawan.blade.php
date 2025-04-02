@extends('layouts.main') {{-- Gunakan template utama --}}

@section('title', 'Kelola Karyawan') {{-- Set title --}}

@section('content')
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
            td .btn {
                margin-bottom: 5px;
                margin-right: 3px;
            }

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
    </style>
    <main class="h-full pb-16 overflow-y-auto">
        <div class="container px-6 mx-auto grid">
            <h2 class="page-title">
                Manajemen Karyawan
            </h2>

            <!-- Form Tambah Karyawan -->
            <div class="form-section">
                <h3 class="section-header">Tambah Karyawan</h3>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ route('karyawan.insertkaryawan') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <!-- Added form-col-sm-6 for better small screen support -->
                        <div class="form-col form-col-sm-6 form-col-md-4 mb-3">
                            <label for="user_id" class="form-label">Nama Karyawan</label>
                            <select name="user_id" id="user_id" class="form-control" required>
                                <option value="">-- Pilih Karyawan --</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->user_id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-col form-col-sm-6 form-col-md-4 mb-3">
                            <label for="posisi" class="form-label">Posisi</label>
                            <input type="text" name="posisi" id="posisi" class="form-control" required>
                        </div>

                        <div class="form-col form-col-sm-6 form-col-md-4 mb-3">
                            <label for="departemen" class="form-label">Departemen</label>
                            <input type="text" name="departemen" id="departemen" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>

            <!-- Daftar Karyawan -->
            <div class="table-section">
                <h3 class="section-header">Daftar Karyawan</h3>

                <div class="table-responsive">
                    <table id="karyawanTable" class="table table-bordered display">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
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
                                    <td>{{ $karyawan->user->role }}</td>
                                    <td>{{ $karyawan->posisi }}</td>
                                    <td>{{ $karyawan->departemen }}</td>
                                    <td>
                                        <div class="d-flex flex-wrap">
                                            <a href="{{ url('/editkaryawan/' . $karyawan->user_id) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <button class="btn btn-danger btn-sm delete-karyawan"
                                                data-id="{{ $karyawan->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
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
        $(document).on('click', '.delete-karyawan', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            if (confirm('Apakah Anda yakin ingin menghapus karyawan ini?')) {
                $.ajax({
                    url: `/hapus-karyawan/${id}`,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        alert(response.message);
                        location.reload();
                    },
                    error: function(xhr) {
                        alert(xhr.responseJSON.message);
                    }
                });
            }
        });
        //HANDEL DATA TABEL
        $(document).ready(function() {
            $('#karyawanTable').DataTable({
                "language": {
                    "search": "",
                    "lengthMenu": "Tampilkan _MENU_ data",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "paginate": {
                        "first": "Awal",
                        "last": "Akhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    },
                    "zeroRecords": "Tidak ada data yang sesuai",
                    "infoEmpty": "Menampilkan 0 data",
                    "infoFiltered": "(disaring dari _MAX_ total data)"
                },
                "lengthMenu": [5, 15, 25, 50, 100],
                "responsive": true,
                "autoWidth": false
            });
        });
    </script>
@endsection
