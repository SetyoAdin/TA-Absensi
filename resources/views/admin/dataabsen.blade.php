@extends('layouts.main') {{-- Gunakan template utama --}}

@section('title', 'Data Absen') {{-- Set title --}}

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

        /* DataTables Search Styling */
        .dataTables_filter {
            margin-bottom: 15px;
        }

        .dataTables_filter input {
            width: 180px;
            padding: 8px 12px;
            border-radius: 6px;
            background-color: var(--dark-input);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            transition: all 0.2s ease;
        }

        .dataTables_filter input:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.25);
            outline: none;
        }

        .dataTables_length select {
            padding: 6px 10px;
            border-radius: 6px;
            background-color: var(--dark-input);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
        }

        .dataTables_length select:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.25);
            outline: none;
        }

        /* Highlight search results */
        .highlight {
            background-color: rgba(99, 102, 241, 0.2);
            padding: 0 2px;
            border-radius: 2px;
        }

        /* Loading indicator */
        .loading {
            position: relative;
            opacity: 0.6;
        }

        .loading:after {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            width: 40px;
            height: 40px;
            margin: -20px 0 0 -20px;
            border: 4px solid rgba(255, 255, 255, 0.1);
            border-top-color: var(--accent-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Responsive adjustments */
        @media (max-width: 767px) {
            .dataTables_filter input {
                width: 100%;
                max-width: 100%;
            }

            .dataTables_length,
            .dataTables_filter {
                text-align: left;
                margin-bottom: 10px;
            }
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

        /* Toast notification styling */
        .swal2-toast {
            background-color: var(--dark-section) !important;
            border: 1px solid var(--border-color) !important;
            color: var(--text-primary) !important;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2) !important;
        }

        .swal2-toast .swal2-title {
            color: var(--text-primary) !important;
        }

        .swal2-toast .swal2-icon {
            border-color: var(--success) !important;
            color: var(--success) !important;
        }
    </style>

    <main class="h-full pb-16 overflow-y-auto">
        <div class="container px-6 mx-auto grid">
            <h2 class="page-title">
                Daftar Absen
            </h2>

            <!-- Filter Form -->
            <div class="form-section">
                <h2 class="section-header">Filter Data Absen</h2>
                <form id="filterForm" class="form-row">
                    <div class="form-col form-col-md-4">
                        <label for="start_date" class="form-label">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="start_date" name="start_date">
                    </div>
                    <div class="form-col form-col-md-4">
                        <label for="end_date" class="form-label">Tanggal Akhir</label>
                        <input type="date" class="form-control" id="end_date" name="end_date">
                    </div>
                    <div class="form-col form-col-md-4">
                        <!-- Empty column for layout balance -->
                    </div>
                    <div class="form-col form-col-md-12">
                        <div class="d-flex gap-2">
                            <button type="button" id="filterButton" class="btn btn-primary">Tampilkan Data</button>
                            <button type="button" id="exportExcel" class="btn btn-secondary ms-3">
                                <i class="fas fa-file-excel"></i> Export Excel
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Tabel Pengguna -->
            <div class="table-section">
                <h2 class="section-header">Daftar Absen</h2>
                <div class="table-responsive">
                    <table id="absenTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Karyawan</th>
                                <th>Tanggal</th>
                                <th>Jam Masuk</th>
                                <th>Jam Keluar</th>
                                <th>Status</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will be loaded via AJAX -->
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize DataTable with empty data
            var table = $('#absenTable').DataTable({
                "data": [],
                "columns": [{
                        "data": "user_name"
                    },
                    {
                        "data": "tanggal"
                    },
                    {
                        "data": "jam_masuk"
                    },
                    {
                        "data": "jam_keluar"
                    },
                    {
                        "data": "status"
                    },
                    {
                        "data": "gambar",
                        "render": function(data, type, row) {
                            if (data) {
                                return '<a href="' + data + '" target="_blank"><img src="' + data +
                                    '" alt="Absen Image" style="max-width: 50px; max-height: 50px; cursor: pointer;"></a>';
                            } else {
                                return '-';
                            }
                        }
                    },
                    {
                        "data": "actions",
                        "render": function(data, type, row) {
                            return data;
                        }
                    }
                ],
                "language": {
                    "search": "Cari:",
                    "lengthMenu": "Tampilkan _MENU_ data per halaman",
                    "zeroRecords": "Tidak ada data yang ditemukan",
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                    "infoEmpty": "Tidak ada data tersedia",
                    "infoFiltered": "(difilter dari _MAX_ total data)",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    }
                },
                "lengthMenu": [10, 25, 50, 100],
                "responsive": true,
                "order": [
                    [2, 'desc']
                ],
                "dom": '<"top"lf>rt<"bottom"ip>',
                "drawCallback": function() {
                    $('.dataTables_paginate > .paginate_button').addClass('btn btn-sm');
                    // Re-attach delete button handlers after table redraw
                    attachDeleteHandlers();
                }
            });

            // Function to attach delete handlers
            function attachDeleteHandlers() {
                $('.delete-absen').off('click').on('click', function(e) {
                    e.preventDefault();
                    const deleteUrl = $(this).attr('href');

                    Swal.fire({
                        title: 'Konfirmasi Hapus',
                        text: 'Apakah Anda yakin ingin menghapus data absen ini?',
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
                                        // Show success toast
                                        const Toast = Swal.mixin({
                                            toast: true,
                                            position: 'top-end',
                                            showConfirmButton: false,
                                            timer: 1000,
                                            timerProgressBar: true,
                                            didOpen: (toast) => {
                                                toast.addEventListener(
                                                    'mouseenter', Swal
                                                    .stopTimer)
                                                toast.addEventListener(
                                                    'mouseleave', Swal
                                                    .resumeTimer)
                                            }
                                        });

                                        Toast.fire({
                                            icon: 'success',
                                            title: response.message
                                        }).then(() => {
                                            // Reload the page after toast disappears
                                            location.reload();
                                        });
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
            }

            // Initial attachment of delete handlers
            attachDeleteHandlers();

            // Handle filter button click
            $('#filterButton').on('click', function() {
                var startDate = $('#start_date').val();
                var endDate = $('#end_date').val();

                if (!startDate || !endDate) {
                    alert('Silakan pilih tanggal mulai dan tanggal akhir');
                    return;
                }

                // Show loading indicator
                $('#absenTable').addClass('loading');

                // Fetch filtered data from server
                $.ajax({
                    url: '{{ route('absen.filter') }}',
                    type: 'GET',
                    data: {
                        start_date: startDate,
                        end_date: endDate
                    },
                    success: function(response) {
                        // Clear and reload table with new data
                        table.clear().rows.add(response).draw();
                        $('#absenTable').removeClass('loading');
                    },
                    error: function() {
                        alert('Terjadi kesalahan saat mengambil data');
                        $('#absenTable').removeClass('loading');
                    }
                });
            });

            // Function to export table data to Excel
            function exportToExcel() {
                const startDate = $('#start_date').val();
                const endDate = $('#end_date').val();

                if (!startDate || !endDate) {
                    alert('Silakan pilih tanggal mulai dan tanggal akhir terlebih dahulu!');
                    return;
                }

                // Show loading indicator
                $('#absenTable').addClass('loading');

                // Fetch data for export
                $.ajax({
                    url: '{{ route('absen.filter') }}',
                    type: 'GET',
                    data: {
                        start_date: startDate,
                        end_date: endDate
                    },
                    success: function(response) {
                        // Prepare data for Excel
                        const excelData = response.map(row => ({
                            'Nama': row.user_name || '',
                            'Tanggal': row.tanggal || '',
                            'Jam Masuk': row.jam_masuk || '',
                            'Jam Keluar': row.jam_keluar || '',
                            'Status': row.status || ''
                        }));

                        if (excelData.length === 0) {
                            alert('Tidak ada data untuk diekspor pada rentang tanggal tersebut');
                            $('#absenTable').removeClass('loading');
                            return;
                        }

                        // Create worksheet
                        const ws = XLSX.utils.json_to_sheet(excelData);

                        // Set column widths
                        const colWidths = [{
                                wch: 20
                            }, // Nama
                            {
                                wch: 15
                            }, // Tanggal
                            {
                                wch: 15
                            }, // Jam Masuk
                            {
                                wch: 15
                            }, // Jam Keluar
                            {
                                wch: 15
                            } // Status
                        ];
                        ws['!cols'] = colWidths;

                        // Create workbook
                        const wb = XLSX.utils.book_new();
                        XLSX.utils.book_append_sheet(wb, ws, 'Data Absensi');

                        // Generate Excel file name with date range
                        const fileName = `Data_Absensi_${startDate}_sampai_${endDate}.xlsx`;

                        // Save file
                        XLSX.writeFile(wb, fileName);
                        $('#absenTable').removeClass('loading');
                    },
                    error: function() {
                        alert('Terjadi kesalahan saat mengekspor data');
                        $('#absenTable').removeClass('loading');
                    }
                });
            }

            // Bind export button click event
            $('#exportExcel').on('click', exportToExcel);
        });
    </script>
@endsection
