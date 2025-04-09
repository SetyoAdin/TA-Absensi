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

        .absen-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
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

        @media (max-width: 768px) {
            .absen-container {
                grid-template-columns: 1fr;
            }

            .time-display {
                width: 100%;
                text-align: center;
            }
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

        <div class="absen-container">
            {{-- Absen Datang --}}
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

                    <button type="submit" class="btn btn-success" style="width: 100%;" onclick="return cekGambar()">
                        <i class="fas fa-check"></i> Absen Datang
                    </button>
                </form>
            </div>

            {{-- Absen Pulang --}}
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
    </script>
</body>

</html>
