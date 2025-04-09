@extends('layouts.main')

@section('title', 'Edit Data Absen')

@section('content')
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
                <form action="{{ route('absen.update', $absen->absen_id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-row">
                        <div class="form-col form-col-md-6">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal"
                                value="{{ $absen->tanggal->format('Y-m-d') }}" required>
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

                    <div class="form-row">
                        <div class="form-col form-col-md-6">
                            <label for="kategori_izin_id" class="form-label">Kategori Izin</label>
                            <select class="form-control" id="kategori_izin_id" name="kategori_izin_id">
                                <option value="">Pilih Kategori Izin</option>
                                @foreach ($kategoriIzins as $kategori)
                                    <option value="{{ $kategori->detail_izin_id }}"
                                        {{ $absen->kategori_izin_id == $kategori->detail_izin_id ? 'selected' : '' }}>
                                        {{ $kategori->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-col">
                            <label for="alasan" class="form-label">Alasan</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="3">{{ $absen->alasan }}</textarea>
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
                        <a href="{{ route('dataabsen') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
