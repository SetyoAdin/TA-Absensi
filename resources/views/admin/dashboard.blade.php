@extends('layouts.main') {{-- Gunakan template utama --}}

@section('title', 'Dashboard') {{-- Set title --}}

@section('content')
    <style>
        /* Dark Theme Base */
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

        .dashboard-card {
            background: var(--dark-section);
            border-radius: 1rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
            border: 1px solid var(--border-color);
            overflow: hidden;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.4);
            border-color: var(--accent-color);
        }

        .card-header {
            background: var(--dark-input);
            border-bottom: 1px solid var(--border-color);
            padding: 1.25rem;
        }

        .card-body {
            padding: 1.5rem;
            color: var(--text-primary);
        }

        /* Status Badges */
        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 1rem;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-block;
            text-align: center;
            min-width: 90px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-hadir {
            background: linear-gradient(135deg, var(--success) 0%, #059669 100%);
            color: white;
            box-shadow: 0 2px 10px rgba(16, 185, 129, 0.3);
        }

        .status-izin {
            background: linear-gradient(135deg, var(--accent-color) 0%, var(--accent-hover) 100%);
            color: white;
            box-shadow: 0 2px 10px rgba(99, 102, 241, 0.3);
        }

        .status-sakit {
            background: linear-gradient(135deg, var(--warning) 0%, var(--warning-hover) 100%);
            color: white;
            box-shadow: 0 2px 10px rgba(245, 158, 11, 0.3);
        }

        .status-alpha {
            background: linear-gradient(135deg, var(--danger) 0%, var(--danger-hover) 100%);
            color: white;
            box-shadow: 0 2px 10px rgba(239, 68, 68, 0.3);
        }

        .status-pending {
            background: linear-gradient(135deg, var(--warning) 0%, var(--warning-hover) 100%);
            color: white;
            box-shadow: 0 2px 10px rgba(245, 158, 11, 0.3);
        }

        .status-approved {
            background: linear-gradient(135deg, var(--success) 0%, #059669 100%);
            color: white;
            box-shadow: 0 2px 10px rgba(16, 185, 129, 0.3);
        }

        .status-rejected {
            background: linear-gradient(135deg, var(--danger) 0%, var(--danger-hover) 100%);
            color: white;
            box-shadow: 0 2px 10px rgba(239, 68, 68, 0.3);
        }

        /* Table Styling */
        .table {
            width: 100%;
            color: var(--text-primary);
            border-collapse: separate;
            border-spacing: 0;
        }

        .table th {
            background: var(--dark-input);
            color: var(--text-secondary);
            font-weight: 600;
            padding: 1rem;
            border-bottom: 2px solid var(--border-color);
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .table td {
            padding: 1rem;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
            font-size: 0.875rem;
        }

        .table tbody tr:hover {
            background: rgba(255, 255, 255, 0.02);
        }

        /* Table Container */
        .table-container {
            position: relative;
            overflow-x: auto;
            border-radius: 0.5rem;
            background: var(--dark-section);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        /* Table Header Styling */
        .table-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem;
            background: var(--dark-input);
            border-bottom: 1px solid var(--border-color);
        }

        .table-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        .table-actions {
            display: flex;
            gap: 0.5rem;
        }

        /* Table Footer */
        .table-footer {
            padding: 1rem;
            background: var(--dark-input);
            border-top: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-info {
            color: var(--text-secondary);
            font-size: 0.875rem;
        }

        /* Table Cell Styling */
        .table-cell {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 200px;
        }

        .table-cell.date {
            min-width: 120px;
        }

        .table-cell.time {
            min-width: 80px;
        }

        .table-cell.status {
            min-width: 100px;
        }

        .table-cell.name {
            min-width: 150px;
        }

        .table-cell.category {
            min-width: 120px;
        }

        /* Progress Bar */
        .progress {
            height: 0.5rem;
            border-radius: 1rem;
            background: rgba(255, 255, 255, 0.05);
            margin: 0.5rem 0;
            overflow: hidden;
        }

        .progress-bar {
            border-radius: 1rem;
            transition: width 1s ease;
        }

        .bg-success {
            background: linear-gradient(135deg, var(--success) 0%, #059669 100%);
        }

        .bg-info {
            background: linear-gradient(135deg, var(--accent-color) 0%, var(--accent-hover) 100%);
        }

        .bg-warning {
            background: linear-gradient(135deg, var(--warning) 0%, var(--warning-hover) 100%);
        }

        .bg-danger {
            background: linear-gradient(135deg, var(--danger) 0%, var(--danger-hover) 100%);
        }

        /* Stat Cards */
        .stat-card {
            background: linear-gradient(135deg, var(--dark-input) 0%, var(--dark-section) 100%);
            border-radius: 1rem;
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            border: 1px solid var(--border-color);
        }

        .stat-icon {
            width: 3.5rem;
            height: 3.5rem;
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .stat-content {
            flex: 1;
        }

        .stat-label {
            color: var(--text-secondary);
            font-size: 0.875rem;
            margin-bottom: 0.25rem;
        }

        .stat-value {
            color: var(--text-primary);
            font-size: 1.5rem;
            font-weight: 600;
        }

        /* Colors for Stat Icons */
        .text-orange-500 {
            color: var(--warning);
        }

        .text-green-500 {
            color: var(--success);
        }

        .text-blue-500 {
            color: var(--accent-color);
        }

        .text-purple-500 {
            color: #a855f7;
        }

        .bg-orange-100 {
            background: rgba(245, 158, 11, 0.1);
        }

        .bg-green-100 {
            background: rgba(16, 185, 129, 0.1);
        }

        .bg-blue-100 {
            background: rgba(99, 102, 241, 0.1);
        }

        .bg-purple-100 {
            background: rgba(168, 85, 247, 0.1);
        }

        /* Page Title */
        .page-title {
            color: var(--text-primary);
            font-size: 1.875rem;
            font-weight: 700;
            margin-bottom: 2rem;
            position: relative;
            padding-bottom: 0.5rem;
        }

        .page-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 3rem;
            height: 0.25rem;
            background: linear-gradient(90deg, var(--accent-color), #a855f7);
            border-radius: 0.25rem;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .stat-card {
                padding: 1rem;
            }

            .stat-icon {
                width: 2.5rem;
                height: 2.5rem;
                font-size: 1.25rem;
            }

            .stat-value {
                font-size: 1.25rem;
            }

            .table-responsive {
                margin: 0 -1rem;
            }
        }
    </style>
    <main class="h-full pb-16 overflow-y-auto">
        <div class="container px-6 mx-auto grid">
            <h2 class="page-title">
                Dashboard
            </h2>

            <!-- Statistik Utama -->
            <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
                <div class="dashboard-card">
                    <div class="stat-card">
                        <div class="stat-icon text-orange-500 bg-orange-100">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-label">Total Karyawan</div>
                            <div class="stat-value">{{ $totalKaryawan }}</div>
                        </div>
                    </div>
                </div>

                <div class="dashboard-card">
                    <div class="stat-card">
                        <div class="stat-icon text-green-500 bg-green-100">
                            <i class="fas fa-clipboard-check"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-label">Absensi Hari Ini</div>
                            <div class="stat-value">{{ $totalAbsen }}</div>
                        </div>
                    </div>
                </div>

                <div class="dashboard-card">
                    <div class="stat-card">
                        <div class="stat-icon text-blue-500 bg-blue-100">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-label">Presentase Kehadiran</div>
                            <div class="stat-value">{{ number_format($persentaseKehadiran, 1) }}%</div>
                        </div>
                    </div>
                </div>

                <div class="dashboard-card">
                    <div class="stat-card">
                        <div class="stat-icon text-purple-500 bg-purple-100">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-label">Total Izin</div>
                            <div class="stat-value">{{ $totalIzin }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rekap Harian dan Mingguan -->
            <div class="grid gap-6 mb-8 md:grid-cols-2">
                <div class="dashboard-card">
                    <div class="card-header">
                        <h4 class="text-lg font-semibold text-gray-200">Rekap Harian</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Status</th>
                                        <th>Jumlah</th>
                                        <th>Persentase</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><span class="status-badge status-hadir">Hadir</span></td>
                                        <td>{{ $rekapHarian['hadir'] }}</td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar bg-success" role="progressbar"
                                                    style="width: {{ $persentaseHarian['hadir'] }}%"
                                                    aria-valuenow="{{ $persentaseHarian['hadir'] }}" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="status-badge status-izin">Izin</span></td>
                                        <td>{{ $rekapHarian['izin'] }}</td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar bg-info" role="progressbar"
                                                    style="width: {{ $persentaseHarian['izin'] }}%"
                                                    aria-valuenow="{{ $persentaseHarian['izin'] }}" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="status-badge status-sakit">Sakit</span></td>
                                        <td>{{ $rekapHarian['sakit'] }}</td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar bg-warning" role="progressbar"
                                                    style="width: {{ $persentaseHarian['sakit'] }}%"
                                                    aria-valuenow="{{ $persentaseHarian['sakit'] }}" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="status-badge status-alpha">Alpha</span></td>
                                        <td>{{ $rekapHarian['alpha'] }}</td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar bg-danger" role="progressbar"
                                                    style="width: {{ $persentaseHarian['alpha'] }}%"
                                                    aria-valuenow="{{ $persentaseHarian['alpha'] }}" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="dashboard-card">
                    <div class="card-header">
                        <h4 class="text-lg font-semibold text-gray-200">Rekap Mingguan</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Status</th>
                                        <th>Jumlah</th>
                                        <th>Persentase</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><span class="status-badge status-hadir">Hadir</span></td>
                                        <td>{{ $rekapMingguan['hadir'] }}</td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar bg-success" role="progressbar"
                                                    style="width: {{ $persentaseMingguan['hadir'] }}%"
                                                    aria-valuenow="{{ $persentaseMingguan['hadir'] }}" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="status-badge status-izin">Izin</span></td>
                                        <td>{{ $rekapMingguan['izin'] }}</td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar bg-info" role="progressbar"
                                                    style="width: {{ $persentaseMingguan['izin'] }}%"
                                                    aria-valuenow="{{ $persentaseMingguan['izin'] }}" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="status-badge status-sakit">Sakit</span></td>
                                        <td>{{ $rekapMingguan['sakit'] }}</td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar bg-warning" role="progressbar"
                                                    style="width: {{ $persentaseMingguan['sakit'] }}%"
                                                    aria-valuenow="{{ $persentaseMingguan['sakit'] }}" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="status-badge status-alpha">Alpha</span></td>
                                        <td>{{ $rekapMingguan['alpha'] }}</td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar bg-danger" role="progressbar"
                                                    style="width: {{ $persentaseMingguan['alpha'] }}%"
                                                    aria-valuenow="{{ $persentaseMingguan['alpha'] }}" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Absensi Terbaru -->
            <div class="dashboard-card">
                <div class="table-container">
                    <div class="table-header">
                        <h4 class="table-title">Absensi Terbaru</h4>
                        <div class="table-actions">
                            <span class="table-info">Menampilkan {{ count($absensiTerbaru) }} data terbaru</span>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Tanggal</th>
                                    <th>Jam Masuk</th>
                                    <th>Jam Keluar</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($absensiTerbaru as $absen)
                                    <tr>
                                        <td class="table-cell name">{{ $absen->user->name }}</td>
                                        <td class="table-cell date">
                                            {{ \Carbon\Carbon::parse($absen->tanggal)->format('d M Y') }}</td>
                                        <td class="table-cell time">
                                            {{ $absen->jam_masuk ? \Carbon\Carbon::parse($absen->jam_masuk)->format('H:i') : '-' }}
                                        </td>
                                        <td class="table-cell time">
                                            {{ $absen->jam_keluar ? \Carbon\Carbon::parse($absen->jam_keluar)->format('H:i') : '-' }}
                                        </td>
                                        <td class="table-cell status">
                                            <span class="status-badge status-{{ strtolower($absen->status) }}">
                                                {{ ucfirst($absen->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Tabel Izin Terbaru -->
            <div class="dashboard-card">
                <div class="table-container">
                    <div class="table-header">
                        <h4 class="table-title">Izin Terbaru</h4>
                        <div class="table-actions">
                            <span class="table-info">Menampilkan {{ count($izinTerbaru) }} data terbaru</span>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Kategori</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($izinTerbaru as $izin)
                                    <tr>
                                        <td class="table-cell name">{{ $izin->user->name }}</td>
                                        <td class="table-cell category">{{ $izin->kategoriIzin->nama }}</td>
                                        <td class="table-cell date">
                                            {{ \Carbon\Carbon::parse($izin->tanggal_mulai)->format('d M Y') }}</td>
                                        <td class="table-cell date">
                                            {{ \Carbon\Carbon::parse($izin->tanggal_selesai)->format('d M Y') }}</td>
                                        <td class="table-cell status">
                                            <span class="status-badge status-{{ strtolower($izin->status) }}">
                                                {{ ucfirst($izin->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
