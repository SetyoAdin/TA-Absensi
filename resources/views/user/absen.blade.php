<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Absensi - YukAbsen</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4f46e5;
            --primary-hover: #4338ca;
            --success-color: #10b981;
            --success-hover: #059669;
            --warning-color: #f59e0b;
            --warning-hover: #d97706;
            --text-color: #1f2937;
            --text-light: #6b7280;
            --bg-color: #f9fafb;
            --card-bg: #ffffff;
            --border-color: #e5e7eb;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --radius: 0.5rem;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            line-height: 1.5;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 1rem;
        }

        .page-header {
            margin-bottom: 2rem;
            text-align: center;
        }

        .page-title {
            font-size: 1.875rem;
            font-weight: 700;
            color: var(--text-color);
            margin-bottom: 0.5rem;
        }

        .time-display {
            display: inline-block;
            background-color: var(--card-bg);
            padding: 0.75rem 1.5rem;
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 2rem;
        }

        /* User Profile Section */
        .user-profile {
            background-color: var(--card-bg);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 1.5rem;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-color: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: 600;
            flex-shrink: 0;
        }

        .user-info {
            flex-grow: 1;
        }

        .user-name {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .user-details {
            color: var(--text-light);
            font-size: 0.875rem;
        }

        .user-details span {
            display: inline-block;
            margin-right: 1rem;
        }

        .user-details i {
            margin-right: 0.25rem;
        }

        /* Tabs Navigation */
        .tabs {
            display: flex;
            margin-bottom: 2rem;
            border-bottom: 1px solid var(--border-color);
        }

        .tab {
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            color: var(--text-light);
            cursor: pointer;
            border-bottom: 2px solid transparent;
            transition: all 0.2s ease;
        }

        .tab.active {
            color: var(--primary-color);
            border-bottom-color: var(--primary-color);
        }

        .tab:hover {
            color: var(--primary-color);
        }

        /* Tab Content */
        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .absen-container {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .absen-card {
            background-color: var(--card-bg);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 1.5rem;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .absen-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .card-header {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border-color);
        }

        .card-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            margin-right: 1rem;
            color: white;
        }

        .card-icon.arrival {
            background-color: var(--success-color);
        }

        .card-icon.departure {
            background-color: var(--warning-color);
        }

        .card-icon.leave {
            background-color: var(--primary-color);
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-color);
        }

        .camera-container {
            margin-bottom: 1.5rem;
        }

        .camera-controls {
            display: flex;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
            font-size: 0.875rem;
        }

        .btn i {
            margin-right: 0.5rem;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
        }

        .btn-success {
            background-color: var(--success-color);
            color: white;
        }

        .btn-success:hover {
            background-color: var(--success-hover);
        }

        .btn-warning {
            background-color: var(--warning-color);
            color: white;
        }

        .btn-warning:hover {
            background-color: var(--warning-hover);
        }

        .camera-view {
            position: relative;
            width: 100%;
            border-radius: var(--radius);
            overflow: hidden;
            background-color: #f3f4f6;
            margin-bottom: 1rem;
        }

        video,
        canvas,
        img {
            width: 100%;
            border-radius: var(--radius);
            display: block;
        }

        .camera-placeholder {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 240px;
            color: var(--text-light);
        }

        .camera-placeholder i {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--text-color);
        }

        .alert {
            padding: 0.75rem 1rem;
            border-radius: var(--radius);
            margin-bottom: 1rem;
            font-size: 0.875rem;
        }

        .alert-warning {
            background-color: rgba(245, 158, 11, 0.1);
            color: var(--warning-color);
            border: 1px solid rgba(245, 158, 11, 0.2);
        }

        .alert-success {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--success-color);
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .alert-danger {
            background-color: rgba(239, 68, 68, 0.1);
            color: #ef4444;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .alert i {
            margin-right: 0.5rem;
        }

        .form-control {
            width: 100%;
            padding: 0.5rem 0.75rem;
            border: 1px solid var(--border-color);
            border-radius: var(--radius);
            font-size: 0.875rem;
            color: var(--text-color);
            background-color: var(--card-bg);
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .form-control::placeholder {
            color: var(--text-light);
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 1rem;
            padding-right: 2.5rem;
        }

        @media (max-width: 768px) {
            .absen-container {
                grid-template-columns: 1fr;
            }

            .time-display {
                width: 100%;
                text-align: center;
            }

            .user-profile {
                flex-direction: column;
                text-align: center;
            }

            .user-details span {
                display: block;
                margin-bottom: 0.5rem;
            }

            .tabs {
                flex-direction: column;
                border-bottom: none;
            }

            .tab {
                border-bottom: 1px solid var(--border-color);
                text-align: center;
            }

            .tab.active {
                border-bottom: 1px solid var(--primary-color);
            }
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            border-bottom: 1px solid var(--border-color);
            text-align: left;
        }

        .table th {
            background-color: var(--bg-color);
            font-weight: 600;
            color: var(--text-color);
        }

        .table tr:hover {
            background-color: var(--bg-color);
        }

        .flex {
            display: flex;
        }

        .gap-4 {
            gap: 1rem;
        }

        .flex-1 {
            flex: 1;
        }

        .mb-4 {
            margin-bottom: 1rem;
        }

        .sub-section-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid var(--border-color);
        }

        .mb-6 {
            margin-bottom: 2.5rem;
        }

        .status-badge {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .status-badge.status-hadir {
            background-color: rgba(16, 185, 129, 0.1);
            color: #10b981;
        }

        .status-badge.status-izin {
            background-color: rgba(99, 102, 241, 0.1);
            color: #6366f1;
        }

        .status-badge.status-sakit {
            background-color: rgba(245, 158, 11, 0.1);
            color: #f59e0b;
        }

        .status-badge.status-alpha {
            background-color: rgba(239, 68, 68, 0.1);
            color: #ef4444;
        }

        .status-badge.status-pending {
            background-color: rgba(245, 158, 11, 0.1);
            color: #f59e0b;
        }

        .status-badge.status-disetujui {
            background-color: rgba(16, 185, 129, 0.1);
            color: #10b981;
        }

        .status-badge.status-ditolak {
            background-color: rgba(239, 68, 68, 0.1);
            color: #ef4444;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">Absensi</h1>
            <div class="time-display">
                <span id="tanggal"></span> - <span id="jam"></span>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
        @endif

        <!-- User Profile Section -->
        <div class="user-profile">
            <div class="avatar">
                @if ($karyawan && $karyawan->user)
                    {{ substr($karyawan->user->name, 0, 1) }}
                @else
                    {{ Auth::user() ? substr(Auth::user()->name, 0, 1) : '?' }}
                @endif
            </div>
            <div class="user-info">
                <h2 class="user-name">
                    @if ($karyawan && $karyawan->user)
                        {{ $karyawan->user->name }}
                    @else
                        {{ Auth::user() ? Auth::user()->name : 'User' }}
                    @endif
                </h2>
                <div class="user-details">
                    <span><i class="fas fa-briefcase"></i>
                        {{ $karyawan ? $karyawan->posisi : 'Posisi tidak tersedia' }}</span>
                    <span><i class="fas fa-building"></i>
                        {{ $karyawan ? $karyawan->departemen : 'Departemen tidak tersedia' }}</span>
                </div>
            </div>
        </div>

        <!-- Tabs Navigation -->
        <div class="tabs">
            <div class="tab active" data-tab="datang">Absen Datang</div>
            <div class="tab" data-tab="pulang">Absen Pulang</div>
            <div class="tab" data-tab="izin">Izin</div>
            <div class="tab" data-tab="histori">Histori</div>
        </div>

        <!-- Tab Content -->
        <div class="tab-content active" id="datang">
            <div class="absen-container">
                <div class="absen-card">
                    <div class="card-header">
                        <div class="card-icon arrival">
                            <i class="fas fa-sign-in-alt"></i>
                        </div>
                        <h2 class="card-title">Absen Datang</h2>
                    </div>

                    <form action="{{ route('absen.datang') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="status" value="hadir">
                        <input type="hidden" name="tanggal" id="tanggalInput">
                        <input type="hidden" name="jam_masuk" id="jamMasukInput">
                        <input type="hidden" name="gambar" id="gambarInput">

                        <div class="camera-container">
                            <div class="camera-controls">
                                <button type="button" id="aktifkanKamera" class="btn btn-primary">
                                    <i class="fas fa-camera"></i> Aktifkan Kamera
                                </button>
                                <button type="button" id="snap" class="btn btn-success" style="display: none;">
                                    <i class="fas fa-camera-retro"></i> Ambil Gambar
                                </button>
                            </div>

                            <div class="camera-view">
                                <video id="video" autoplay style="display: none;"></video>
                                <canvas id="canvas" style="display: none;"></canvas>
                                <div id="cameraPlaceholder" class="camera-placeholder">
                                    <i class="fas fa-camera"></i>
                                    <p>Kamera belum diaktifkan</p>
                                </div>
                                <img id="previewGambar" style="display: none;" alt="Preview">
                            </div>

                            <div id="gambarAlert" class="alert alert-warning" style="display: none;">
                                <i class="fas fa-exclamation-triangle"></i> Silakan ambil gambar terlebih dahulu
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success" style="width: 100%;"
                            onclick="return cekGambar()">
                            <i class="fas fa-check"></i> Absen Datang
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="tab-content" id="pulang">
            <div class="absen-container">
                <div class="absen-card">
                    <div class="card-header">
                        <div class="card-icon departure">
                            <i class="fas fa-sign-out-alt"></i>
                        </div>
                        <h2 class="card-title">Absen Pulang</h2>
                    </div>

                    <form action="{{ route('absen.pulang') }}" method="POST">
                        @csrf
                        <input type="hidden" name="tanggal" id="tanggalInputPulang">
                        <input type="hidden" name="jam_keluar" id="jamKeluarInput">

                        <div class="form-group">
                            <p>Klik tombol di bawah untuk melakukan absen pulang.</p>
                        </div>

                        <button type="submit" class="btn btn-warning" style="width: 100%;">
                            <i class="fas fa-check"></i> Absen Pulang
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="tab-content" id="izin">
            <div class="absen-container">
                <div class="absen-card">
                    <div class="card-header">
                        <div class="card-icon leave">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <h2 class="card-title">Form Izin</h2>
                    </div>

                    <form action="{{ route('absen.izin') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Kategori Izin</label>
                            <select name="kategori_izin_id" class="form-control" required>
                                <option value="">Pilih Kategori Izin</option>
                                @foreach ($kategori_izins as $kategori)
                                    <option value="{{ $kategori->detail_izin_id }}">{{ $kategori->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Alasan</label>
                            <textarea name="alasan" class="form-control" rows="3" required placeholder="Masukkan alasan izin"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary" style="width: 100%;">
                            <i class="fas fa-paper-plane"></i> Ajukan Izin
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="tab-content" id="histori">
            <div class="absen-container">
                <div class="absen-card">
                    <div class="card-header">
                        <div class="card-icon">
                            <i class="fas fa-history"></i>
                        </div>
                        <h2 class="card-title">Histori</h2>
                    </div>

                    <!-- Histori Absensi -->
                    <div class="mb-6">
                        <h3 class="sub-section-title">Histori Absensi</h3>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Jam Masuk</th>
                                        <th>Jam Keluar</th>
                                        <th>Status</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody id="historiTableBody">
                                    @foreach ($absens as $absen)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($absen->tanggal)->format('d M Y') }}</td>
                                            <td>{{ $absen->jam_masuk ? \Carbon\Carbon::parse($absen->jam_masuk)->format('H:i') : '-' }}
                                            </td>
                                            <td>{{ $absen->jam_keluar ? \Carbon\Carbon::parse($absen->jam_keluar)->format('H:i') : '-' }}
                                            </td>
                                            <td>
                                                <span class="status-badge status-{{ strtolower($absen->status) }}">
                                                    {{ ucfirst($absen->status) }}
                                                </span>
                                            </td>
                                            <td>{{ $absen->alasan ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Histori Izin -->
                    <div>
                        <h3 class="sub-section-title">Histori Izin</h3>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Kategori</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Selesai</th>
                                        <th>Alasan</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody id="historiIzinTableBody">
                                    @foreach ($izins as $izin)
                                        <tr>
                                            <td>{{ $izin->kategoriIzin->nama_kategori }}</td>
                                            <td>{{ \Carbon\Carbon::parse($izin->tanggal_mulai)->format('d M Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($izin->tanggal_selesai)->format('d M Y') }}
                                            </td>
                                            <td>{{ $izin->alasan }}</td>
                                            <td>
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
        </div>
    </div>

    <script>
        const tanggalElem = document.getElementById("tanggal");
        const jamElem = document.getElementById("jam");
        const tanggalInput = document.getElementById("tanggalInput");
        const jamMasukInput = document.getElementById("jamMasukInput");
        const tanggalInputPulang = document.getElementById("tanggalInputPulang");
        const jamKeluarInput = document.getElementById("jamKeluarInput");
        const cameraPlaceholder = document.getElementById("cameraPlaceholder");
        const gambarAlert = document.getElementById("gambarAlert");

        function updateTime() {
            const now = new Date();
            const tgl = now.toISOString().split("T")[0];
            const jam = now.toTimeString().split(" ")[0];

            tanggalElem.textContent = tgl;
            jamElem.textContent = jam;

            tanggalInput.value = tgl;
            jamMasukInput.value = jam;
            tanggalInputPulang.value = tgl;
            jamKeluarInput.value = jam;
        }

        setInterval(updateTime, 1000);
        updateTime();

        // Kamera
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const snap = document.getElementById('snap');
        const gambarInput = document.getElementById('gambarInput');
        const previewImg = document.getElementById("previewGambar");

        // Tambahkan variabel global
        let cameraStream = null;

        // Tombol aktifkan kamera
        const startCameraBtn = document.getElementById('aktifkanKamera');
        startCameraBtn.addEventListener('click', function() {
            navigator.mediaDevices.getUserMedia({
                    video: true
                })
                .then(function(stream) {
                    cameraStream = stream;
                    video.srcObject = stream;
                    video.style.display = 'block';
                    cameraPlaceholder.style.display = 'none';
                    snap.style.display = 'inline-flex';
                    video.play();
                })
                .catch(function(err) {
                    console.log("Error: " + err);
                    alert("Tidak dapat mengakses kamera. Pastikan kamera terhubung dan izin diberikan.");
                });
        });

        // Tombol ambil gambar
        snap.addEventListener("click", function() {
            // Gambar dari video ke canvas
            canvas.getContext("2d").drawImage(video, 0, 0, canvas.width, canvas.height);

            // Ubah canvas menjadi data URL
            const dataURL = canvas.toDataURL("image/png");

            // Masukkan data URL ke input tersembunyi
            gambarInput.value = dataURL;

            // Tampilkan preview ke elemen <img>
            previewImg.src = dataURL;
            previewImg.style.display = 'block';
            video.style.display = 'none';
            cameraPlaceholder.style.display = 'none';

            // Nonaktifkan kamera
            if (cameraStream) {
                const tracks = cameraStream.getTracks();
                tracks.forEach(track => track.stop());
                snap.style.display = 'none';
                startCameraBtn.style.display = 'inline-flex';
            }
        });

        function cekGambar() {
            const gambar = document.getElementById('gambarInput').value;
            if (!gambar) {
                gambarAlert.style.display = 'block';
                return false;
            }
            return true;
        }

        // Tab functionality
        const tabs = document.querySelectorAll('.tab');
        const tabContents = document.querySelectorAll('.tab-content');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                // Remove active class from all tabs and contents
                tabs.forEach(t => t.classList.remove('active'));
                tabContents.forEach(c => c.classList.remove('active'));

                // Add active class to clicked tab and corresponding content
                tab.classList.add('active');
                const tabId = tab.getAttribute('data-tab');
                document.getElementById(tabId).classList.add('active');
            });
        });

        // Fungsi untuk memuat data histori absensi
        function loadHistori() {
            fetch('/absen/histori')
                .then(response => response.json())
                .then(data => {
                    const tbody = document.getElementById('historiTableBody');
                    tbody.innerHTML = '';

                    data.forEach(absen => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${absen.tanggal}</td>
                            <td>${absen.jam_masuk || '-'}</td>
                            <td>${absen.jam_keluar || '-'}</td>
                            <td>${absen.status}</td>
                            <td>${absen.alasan || '-'}</td>
                        `;
                        tbody.appendChild(row);
                    });
                })
                .catch(error => console.error('Error:', error));
        }

        // Fungsi untuk memuat data histori izin
        function loadHistoriIzin() {
            fetch('/izin/histori')
                .then(response => response.json())
                .then(data => {
                    const tbody = document.getElementById('historiIzinTableBody');
                    tbody.innerHTML = '';

                    data.forEach(izin => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${izin.kategori_izin}</td>
                            <td>${izin.tanggal_mulai}</td>
                            <td>${izin.tanggal_selesai}</td>
                            <td>${izin.alasan}</td>
                            <td>
                                <span class="status-badge status-${izin.status.toLowerCase()}">
                                    ${izin.status}
                                </span>
                            </td>
                        `;
                        tbody.appendChild(row);
                    });
                })
                .catch(error => console.error('Error:', error));
        }

        // Load data awal
        loadHistori();
        loadHistoriIzin();
    </script>
</body>

</html>
