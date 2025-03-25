<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Absensi Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Inter', 'Segoe UI', sans-serif;
        }

        .container {
            max-width: 1200px;
            margin-top: 50px;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
            background: #ffffff;
            padding: 0;
            margin-top: 32px;
            margin-bottom: 40px;
            overflow: hidden;
        }

        .card-header {
            background-color: #4f46e5;
            color: #ffffff;
            font-size: 22px;
            font-weight: 600;
            text-align: center;
            padding: 25px 30px;
            border-bottom: 1px solid #f0f0f0;
            border-radius: 12px 12px 0 0 !important;
        }

        .card-body {
            padding: 25px 30px;
            text-align: center;
        }

        .btn {
            margin: 10px;
            border-radius: 6px;
            font-weight: 500;
            padding: 10px 20px;
            transition: all 0.2s ease;
        }

        .btn-success {
            background-color: #10b981;
            border: none;
        }

        .btn-success:hover {
            background-color: #059669;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(16, 185, 129, 0.2);
        }

        .btn-primary {
            background-color: #4f46e5;
            border: none;
        }

        .btn-primary:hover {
            background-color: #4338ca;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(79, 70, 229, 0.2);
        }

        .btn-secondary {
            background-color: #6b7280;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #4b5563;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(107, 114, 128, 0.2);
        }

        .img-preview {
            display: block;
            margin: 15px auto;
            width: 200px;
            height: 200px;
            object-fit: cover;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
        }

        .nav-tabs {
            border-bottom: 1px solid #e5e7eb;
            margin-bottom: 20px;
            justify-content: center;
        }

        .nav-tabs .nav-link {
            font-weight: 600;
            color: #6b7280;
            border: none;
            border-radius: 0;
            padding: 16px 24px;
            margin: 0 5px;
            position: relative;
            transition: all 0.3s ease;
        }

        .nav-tabs .nav-link.active {
            color: #4f46e5;
            background-color: transparent;
            border-color: transparent;
        }

        .nav-tabs .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: #4f46e5;
            border-radius: 3px 3px 0 0;
        }

        .nav-tabs .nav-link:hover:not(.active) {
            color: #4b5563;
            border-color: transparent;
        }

        .nav-tabs .nav-link i {
            margin-right: 8px;
        }

        .time-display {
            background-color: #f9fafb;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
        }

        .time-display h4 {
            margin: 5px 0;
            color: #4b5563;
            font-size: 16px;
            font-weight: 500;
        }

        .time-display span {
            font-weight: 600;
            color: #111827;
        }

        video {
            width: 100%;
            max-width: 400px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            margin: 20px auto;
        }

        .tab-pane {
            padding: 20px 0;
        }

        .alert {
            border-radius: 8px;
            font-weight: 500;
        }

        .attendance-icon {
            font-size: 40px;
            margin-bottom: 15px;
            color: #4f46e5;
        }

        .tab-instructions {
            color: #6b7280;
            margin-bottom: 20px;
            font-size: 15px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="alert alert-success" style="display: none;" id="success-alert">
                    <i class="fas fa-check-circle me-2"></i><span id="success-message"></span>
                </div>
                <div class="alert alert-danger" style="display: none;" id="error-alert">
                    <i class="fas fa-exclamation-circle me-2"></i><span id="error-message"></span>
                </div>

                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-user-clock me-2"></i>Absensi Karyawan
                    </div>

                    <div class="card-body">
                        <div class="time-display">
                            <h4><i class="far fa-calendar-alt me-2"></i>Tanggal: <span id="tanggal">Loading...</span>
                            </h4>
                            <h4><i class="far fa-clock me-2"></i>Jam: <span id="jam">Loading...</span></h4>
                        </div>

                        <ul class="nav nav-tabs" id="absensiTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <form id="absenForm" action="{{ route('absen.datang') }}" method="POST">
                                    @csrf
                                    <button class="nav-link active" id="absen-datang-tab" data-bs-toggle="tab"
                                        data-bs-target="#absen-datang" type="button" role="tab"
                                        aria-controls="absen-datang" aria-selected="true">
                                        <i class="fas fa-sign-in-alt"></i> Absen Datang
                                    </button>
                                </form>
                            </li>
                            <li class="nav-item" role="presentation">
                                <form action="{{ route('absen.pulang') }}" method="POST">
                                    @csrf
                                    <button class="nav-link" id="absen-pulang-tab" data-bs-toggle="tab"
                                        data-bs-target="#absen-pulang" type="button" role="tab"
                                        aria-controls="absen-pulang" aria-selected="false">
                                        <i class="fas fa-sign-out-alt"></i> Absen Pulang
                                    </button>
                                </form>
                            </li>
                        </ul>

                        <div class="tab-content" id="absensiTabContent">
                            <!-- Tab Absen Datang -->
                            <div class="tab-pane fade show active" id="absen-datang" role="tabpanel"
                                aria-labelledby="absen-datang-tab">
                                <div class="attendance-icon">
                                    <i class="fas fa-camera"></i>
                                </div>
                                <p class="tab-instructions">Silakan buka kamera dan ambil foto untuk melakukan absensi
                                    datang.</p>

                                <form id="absenForm" action="javascript:void(0);" method="POST">
                                    <div class="mb-3 text-center">
                                        <video id="video" autoplay playsinline style="display: none;"></video>
                                        <canvas id="canvas" style="display: none;"></canvas>
                                        <input type="hidden" name="gambar" id="gambarInput">
                                    </div>

                                    <button type="button" class="btn btn-success" id="openCameraBtn">
                                        <i class="fas fa-camera me-2"></i>Buka Kamera
                                    </button>
                                    <button type="button" class="btn btn-primary" id="captureBtn"
                                        style="display: none;">
                                        <i class="fas fa-check me-2"></i>Absen Datang
                                    </button>
                                </form>
                            </div>

                            <!-- Tab Absen Pulang -->
                            <div class="tab-pane fade" id="absen-pulang" role="tabpanel"
                                aria-labelledby="absen-pulang-tab">
                                <div class="attendance-icon">
                                    <i class="fas fa-door-open"></i>
                                </div>
                                <p class="tab-instructions">Klik tombol di bawah untuk melakukan absensi pulang.</p>

                                <form action="javascript:void(0);" method="POST">
                                    <button type="submit" class="btn btn-secondary" id="absenPulangBtn">
                                        <i class="fas fa-sign-out-alt me-2"></i>Absen Pulang
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Immediately update the clock when page loads
        document.addEventListener("DOMContentLoaded", function() {
            updateClock();
            // Set interval after initial update
            setInterval(updateClock, 1000);
        });

        function updateClock() {
            let now = new Date();

            // Format the date in Indonesian style
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };

            // Update the tanggal and jam elements
            document.getElementById('tanggal').textContent = now.toLocaleDateString('id-ID', options);
            document.getElementById('jam').textContent = now.toLocaleTimeString('id-ID');
        }

        // KAMERA FUNCTIONALITY
        document.addEventListener("DOMContentLoaded", function() {
            let video = document.getElementById("video");
            let canvas = document.getElementById("canvas");
            let captureBtn = document.getElementById("captureBtn");
            let openCameraBtn = document.getElementById("openCameraBtn");
            let gambarInput = document.getElementById("gambarInput");
            let absenForm = document.getElementById("absenForm");
            let absenPulangBtn = document.getElementById("absenPulangBtn");
            let stream = null;

            // Show success message function
            function showSuccess(message) {
                const successAlert = document.getElementById('success-alert');
                const successMessage = document.getElementById('success-message');
                successMessage.textContent = message;
                successAlert.style.display = 'block';
                setTimeout(() => {
                    successAlert.style.display = 'none';
                }, 3000);
            }

            // Show error message function
            function showError(message) {
                const errorAlert = document.getElementById('error-alert');
                const errorMessage = document.getElementById('error-message');
                errorMessage.textContent = message;
                errorAlert.style.display = 'block';
                setTimeout(() => {
                    errorAlert.style.display = 'none';
                }, 3000);
            }

            // Absen Pulang button click handler
            absenPulangBtn.addEventListener("click", function() {
                showSuccess("Absensi pulang berhasil dicatat!");
            });

            // Fungsi Buka Kamera
            openCameraBtn.addEventListener("click", function() {
                // First try user facing camera for attendance
                navigator.mediaDevices.getUserMedia({
                        video: {
                            facingMode: "user"
                        }
                    })
                    .then(function(mediaStream) {
                        stream = mediaStream;
                        video.srcObject = mediaStream;
                        video.style.display = "block";
                        captureBtn.style.display = "inline-block";
                        openCameraBtn.style.display = "none";

                        // Make sure video is actually playing
                        video.play().catch(function(error) {
                            showError("Error playing video: " + error.message);
                        });
                    })
                    .catch(function(error) {
                        console.error("Gagal mengakses kamera depan, mencoba kamera belakang: ", error);

                        // If front camera fails, try environment camera
                        navigator.mediaDevices.getUserMedia({
                                video: {
                                    facingMode: "environment"
                                }
                            })
                            .then(function(mediaStream) {
                                stream = mediaStream;
                                video.srcObject = mediaStream;
                                video.style.display = "block";
                                captureBtn.style.display = "inline-block";
                                openCameraBtn.style.display = "none";

                                // Make sure video is actually playing
                                video.play().catch(function(error) {
                                    showError("Error playing video: " + error.message);
                                });
                            })
                            .catch(function(finalError) {
                                console.error("Gagal mengakses semua kamera: ", finalError);
                                showError(
                                    "Gagal mengakses kamera. Pastikan Anda mengizinkan akses kamera dan browser Anda mendukung fitur ini."
                                );
                            });
                    });
            });

            // Fungsi Tangkap Gambar
            captureBtn.addEventListener("click", function() {
                try {
                    let context = canvas.getContext("2d");
                    canvas.width = video.videoWidth;
                    canvas.height = video.videoHeight;
                    context.drawImage(video, 0, 0, canvas.width, canvas.height);

                    // Ubah gambar ke Base64
                    let imageData = canvas.toDataURL("image/png");
                    gambarInput.value = imageData;

                    // Matikan Kamera Setelah Absen
                    stopCamera();

                    // Simulasi keberhasilan absen
                    showSuccess("Absensi datang berhasil dicatat!");
                } catch (error) {
                    console.error("Error capturing image:", error);
                    showError("Gagal mengambil gambar. Coba buka kamera lagi.");
                }
            });

            // Fungsi Matikan Kamera
            function stopCamera() {
                if (stream) {
                    stream.getTracks().forEach(track => track.stop());
                }
                video.style.display = "none";
                captureBtn.style.display = "none";
                openCameraBtn.style.display = "inline-block";
            }

            // Pastikan Kamera Mati Setelah Submit Form
            absenForm.addEventListener("submit", function(e) {
                e.preventDefault();
                stopCamera();
            });

            // Tambahan untuk menangani pemadam kamera saat tab berganti
            const absensiTabs = document.querySelectorAll('button[data-bs-toggle="tab"]');
            absensiTabs.forEach(tab => {
                tab.addEventListener('shown.bs.tab', function() {
                    stopCamera();
                });
            });
        });
    </script>
</body>

</html>
