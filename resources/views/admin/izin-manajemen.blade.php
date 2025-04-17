@extends('layouts.main')

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

        .btn-secondary {
            background-color: var(--dark-input);
            border-color: var(--border-color);
            color: var(--text-primary);
        }

        .btn-secondary:hover {
            background-color: #3a3a3a;
            border-color: #3a3a3a;
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
            justify-content: flex-start;
            gap: 10px;
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

        /* Status badges */
        .status-badge {
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 0.85rem;
            font-weight: 500;
            display: inline-block;
        }

        .status-pending {
            background-color: rgba(245, 158, 11, 0.15);
            color: var(--warning);
        }

        .status-disetujui {
            background-color: rgba(16, 185, 129, 0.15);
            color: var(--success);
        }

        .status-ditolak {
            background-color: rgba(239, 68, 68, 0.15);
            color: var(--danger);
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

        /* Filter Form Styling */
        .filter-form {
            background-color: var(--dark-section);
            border-radius: 10px;
            padding: 24px;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        .flex {
            display: flex;
        }

        .flex-1 {
            flex: 1;
        }

        .gap-4 {
            gap: 1rem;
        }

        .gap-2 {
            gap: 0.5rem;
        }

        .form-group {
            margin-bottom: 20px;
        }

        /* Responsive improvements */
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
            .page-title {
                font-size: 1.5rem;
                margin: 20px 0;
            }

            .section-header {
                font-size: 1.1rem;
            }

            .form-section,
            .table-section,
            .filter-form {
                padding: 15px;
            }

            .flex {
                flex-direction: column;
            }

            .gap-4 {
                gap: 0.75rem;
            }

            .btn {
                padding: 10px 14px;
                min-height: 44px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
            }

            div.dataTables_wrapper div.dataTables_filter input {
                width: 100%;
                margin-left: 0;
            }

            div.dataTables_wrapper div.dataTables_length,
            div.dataTables_wrapper div.dataTables_filter {
                text-align: left;
                display: flex;
                flex-direction: column;
            }

            div.dataTables_wrapper div.dataTables_length label,
            div.dataTables_wrapper div.dataTables_filter label {
                display: flex;
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }

            .form-actions {
                flex-direction: column;
                width: 100%;
            }

            .form-actions .btn {
                width: 100%;
            }
        }

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

            td .btn {
                margin-right: 2px;
                padding: 6px 8px;
            }
        }
    </style>

    <main class="h-full pb-16 overflow-y-auto">
        <div class="container px-6 mx-auto grid">
            <h2 class="page-title">
                Daftar Pengajuan Izin
            </h2>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- Filter Form -->
            <div class="filter-form">
                <h3 class="section-header">Filter Data</h3>
                <form id="filterForm" action="{{ route('izin.filter') }}" method="GET">
                    <div class="flex gap-4">
                        <div class="flex-1">
                            <div class="form-group">
                                <label class="form-label">Dari Tanggal</label>
                                <input type="date" id="start_date" name="start_date" class="form-control"
                                    value="{{ request('start_date') }}">
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="form-group">
                                <label class="form-label">Sampai Tanggal</label>
                                <input type="date" id="end_date" name="end_date" class="form-control"
                                    value="{{ request('end_date') }}">
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <select id="status" name="status" class="form-control">
                                    <option value="">Semua Status</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>
                                        Disetujui</option>
                                    <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                        <button type="button" id="clearFilter" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Clear Filter
                        </button>
                    </div>
                </form>
            </div>

            <!-- DataTable Section -->
            <div class="table-section">
                <h3 class="section-header">Data Pengajuan Izin</h3>
                <div class="table-responsive">
                    <table id="izinTable" class="table">
                        <thead>
                            <tr>
                                <th>Nama Karyawan</th>
                                <th>Kategori Izin</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Alasan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($izins as $izin)
                                <tr>
                                    <td>{{ $izin->user->name }}</td>
                                    <td>{{ $izin->kategoriIzin->nama_kategori }}</td>
                                    <td>{{ \Carbon\Carbon::parse($izin->tanggal_mulai)->format('d/m/Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($izin->tanggal_selesai)->format('d/m/Y') }}</td>
                                    <td>{{ $izin->alasan }}</td>
                                    <td>
                                        <span class="status-badge status-{{ $izin->status }}">
                                            {{ ucfirst($izin->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <form action="{{ route('izin.update', $izin->izin_id) }}" method="POST"
                                                class="d-flex align-items-center gap-2">
                                                @csrf
                                                @method('PUT')
                                                <select name="status" class="form-control form-control-sm"
                                                    style="width: 120px;">
                                                    <option value="pending"
                                                        {{ $izin->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="disetujui"
                                                        {{ $izin->status == 'disetujui' ? 'selected' : '' }}>Disetujui
                                                    </option>
                                                    <option value="ditolak"
                                                        {{ $izin->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                                </select>
                                                <div class="d-flex gap-3" style="white-space: nowrap; margin-left: 8px;">
                                                    <button type="submit" class="btn btn-primary btn-sm"
                                                        title="Update Status"
                                                        style="width: 32px; height: 32px; display: inline-flex; align-items: center; justify-content: center; padding: 0;">
                                                        <i class="fas fa-save"></i>
                                                    </button>
                                                    <a href="{{ route('izin.destroy', $izin->izin_id) }}"
                                                        class="btn btn-danger btn-sm delete-izin" title="Hapus Data"
                                                        style="width: 32px; height: 32px; display: inline-flex; align-items: center; justify-content: center; padding: 0;">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </div>
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

    <!-- DataTables JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#izinTable').DataTable({
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
                ], // Sort by tanggal_mulai
                pageLength: 10,
                lengthMenu: [10, 25, 50, 100],
                dom: '<"top"lf>rt<"bottom"ip>',
                drawCallback: function() {
                    $('.dataTables_paginate > .paginate_button').addClass('btn btn-sm');
                }
            });

            // Clear filter button functionality
            $('#clearFilter').on('click', function() {
                // Clear all form fields
                $('#start_date').val('');
                $('#end_date').val('');
                $('#status').val('');

                // Submit the form to refresh with cleared filters
                $('#filterForm').submit();
            });

            // Function to show success toast
            function showSuccessToast(message) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 1000,
                    timerProgressBar: true,
                    background: '#1e1e1e',
                    color: '#f3f4f6',
                    iconColor: '#10b981',
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });

                Toast.fire({
                    icon: 'success',
                    title: message
                });
            }

            // Handle delete button click
            $('.delete-izin').on('click', function(e) {
                e.preventDefault();
                const deleteUrl = $(this).attr('href');

                Swal.fire({
                    title: 'Konfirmasi Hapus',
                    text: 'Apakah Anda yakin ingin menghapus data izin ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batal',
                    background: '#1e1e1e',
                    color: '#f3f4f6',
                    customClass: {
                        popup: 'dark-swal',
                        title: 'text-white',
                        content: 'text-gray-300',
                        confirmButton: 'bg-red-500 hover:bg-red-600',
                        cancelButton: 'bg-gray-500 hover:bg-gray-600'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: deleteUrl,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.success) {
                                    showSuccessToast('Data izin berhasil dihapus');
                                    setTimeout(() => {
                                        location.reload();
                                    }, 1000);
                                } else {
                                    Swal.fire({
                                        title: 'Error',
                                        text: response.message,
                                        icon: 'error',
                                        background: '#1e1e1e',
                                        color: '#f3f4f6'
                                    });
                                }
                            },
                            error: function(xhr) {
                                let errorMessage =
                                    'Terjadi kesalahan saat menghapus data';
                                if (xhr.responseJSON && xhr.responseJSON.message) {
                                    errorMessage = xhr.responseJSON.message;
                                }
                                Swal.fire({
                                    title: 'Error',
                                    text: errorMessage,
                                    icon: 'error',
                                    background: '#1e1e1e',
                                    color: '#f3f4f6'
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
