@extends('layouts.main')

@section('title', 'Edit Data Absen')

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

        .form-section {
            background-color: var(--dark-section);
            border-radius: 10px;
            padding: 24px;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        .section-header {
            font-weight: 600;
            font-size: 1.25rem;
            color: var(--text-primary);
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--border-color);
        }

        .form-control {
            background-color: var(--dark-input);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            border-radius: 6px;
            padding: 10px 14px;
            width: 100%;
            margin-bottom: 15px;
        }

        .form-control:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.25);
            outline: none;
        }

        .form-label {
            color: var(--text-secondary);
            margin-bottom: 8px;
            font-weight: 500;
            display: block;
        }

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

        .btn-light {
            background-color: var(--dark-input);
            border-color: var(--border-color);
            color: var(--text-secondary);
        }

        .btn-light:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: var(--text-primary);
        }

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

        .alert-danger {
            background-color: rgba(239, 68, 68, 0.2);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: var(--danger);
        }

        .form-actions {
            margin-top: 20px;
            display: flex;
            justify-content: flex-end;
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        .form-col {
            flex: 0 0 100%;
            padding-right: 15px;
            padding-left: 15px;
        }

        .form-col-md-6 {
            flex: 0 0 50%;
            max-width: 50%;
        }

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
    </style>

    <main class="h-full pb-16 overflow-y-auto">
        <div class="container px-6 mx-auto grid">
            <h2 class="page-title">
                Edit Data Absen
            </h2>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-section">
                <h2 class="section-header">Form Edit Data Absen</h2>
                <form id="editForm" action="{{ route('absen.update', $absen->absen_id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-row">
                        <div class="form-col form-col-md-6">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal"
                                value="{{ $absen->tanggal ? Carbon\Carbon::parse($absen->tanggal)->format('Y-m-d') : '' }}"
                                required>
                        </div>

                        <div class="form-col form-col-md-6">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="hadir" {{ $absen->status == 'hadir' ? 'selected' : '' }}>Hadir</option>
                                <option value="izin" {{ $absen->status == 'izin' ? 'selected' : '' }}>Izin</option>
                                <option value="sakit" {{ $absen->status == 'sakit' ? 'selected' : '' }}>Sakit</option>
                                <option value="alpha" {{ $absen->status == 'alpha' ? 'selected' : '' }}>Alpha</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-col form-col-md-6">
                            <label for="jam_masuk" class="form-label">Jam Masuk</label>
                            <input type="time" class="form-control" id="jam_masuk" name="jam_masuk"
                                value="{{ $absen->jam_masuk ? Carbon\Carbon::parse($absen->jam_masuk)->format('H:i:s') : '' }}">
                        </div>

                        <div class="form-col form-col-md-6">
                            <label for="jam_keluar" class="form-label">Jam Keluar</label>
                            <input type="time" class="form-control" id="jam_keluar" name="jam_keluar"
                                value="{{ $absen->jam_keluar ? Carbon\Carbon::parse($absen->jam_keluar)->format('H:i:s') : '' }}">
                        </div>
                    </div>

                    @if ($absen->gambar)
                        <div class="form-row">
                            <div class="form-col">
                                <label class="form-label">Gambar Absen</label>
                                <div class="image-preview">
                                    <img src="{{ asset($absen->gambar) }}" alt="Gambar Absen"
                                        style="max-width: 200px; max-height: 200px;">
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="form-actions">
                        <a href="{{ route('dataabsen') }}" class="btn btn-light">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary" id="updateButton">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
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

            // Handle form submission
            $('#editForm').on('submit', function(e) {
                e.preventDefault();
                const form = $(this);
                const formData = form.serialize();

                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        showSuccessToast('Data absen berhasil diperbarui');
                        setTimeout(() => {
                            window.location.href = '{{ route('dataabsen') }}';
                        }, 1000);
                    },
                    error: function(xhr) {
                        Swal.fire({
                            title: 'Error',
                            text: xhr.responseJSON.message ||
                                'Terjadi kesalahan saat memperbarui data',
                            icon: 'error',
                            background: '#1e1e1e',
                            color: '#f3f4f6'
                        });
                    }
                });
            });

            // Handle update button click
            $('#updateButton').on('click', function(e) {
                e.preventDefault();
                const form = $('#editForm');
                const formData = form.serialize();

                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        showSuccessToast('Data absen berhasil diperbarui');
                        setTimeout(() => {
                            window.location.href = '{{ route('dataabsen') }}';
                        }, 1000);
                    },
                    error: function(xhr) {
                        Swal.fire({
                            title: 'Error',
                            text: xhr.responseJSON.message ||
                                'Terjadi kesalahan saat memperbarui data',
                            icon: 'error',
                            background: '#1e1e1e',
                            color: '#f3f4f6'
                        });
                    }
                });
            });
        });
    </script>
@endsection
