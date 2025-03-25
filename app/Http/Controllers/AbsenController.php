<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absen;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AbsenController extends Controller
{
    // Fungsi untuk absen datang
    public function absenDatang(Request $request)
    {
        $user_id = Auth::id(); // Jika tanpa login, bisa NULL
        $tanggal = now('Asia/Jakarta')->format('Y-m-d');
        $jam_masuk = now('Asia/Jakarta')->format('H:i:s');

        // Cek apakah sudah absen datang hari ini
        $absen = Absen::where('user_id', $user_id)->where('tanggal', $tanggal)->first();
        if ($absen) {
            return back()->with('error', 'Anda sudah melakukan absen datang hari ini.');
        }

        // **Pastikan Gambar Ditangkap dengan Benar**
        $gambarPath = null;

        if ($request->gambar) { // **Pastikan request berisi gambar**
            $imageData = $request->gambar;
            list($type, $imageData) = explode(';', $imageData);
            list(, $imageData) = explode(',', $imageData);
            $imageData = base64_decode($imageData);

            // **Buat Nama File Unik**
            $fileName = 'absen_' . time() . '.png';

            // **Simpan ke Folder [public/image/](cci:7://file:///d:/SEKOLAH/laragon/www/YukAbsen/public/image:0:0-0:0)**
            $gambarPath = public_path('image/' . $fileName);
            file_put_contents($gambarPath, $imageData);

            // **Simpan Path ke Database**
            $gambarLink = asset('image/' . $fileName);
        }

        // Simpan data absen ke database
        Absen::create([
            'user_id'   => $user_id,
            'tanggal'   => $tanggal,
            'jam_masuk' => $jam_masuk,
            'status'    => 'hadir',
            'gambar'    => $gambarLink,
        ]);


        // **Hentikan Kamera Setelah Absen**
        return response()->json(['success' => true, 'message' => 'Berhasil absen dengan gambar.']);
    }

    // Fungsi untuk absen pulang
    public function absenPulang()
    {
        $user_id = Auth::id();
        $tanggal = Carbon::now()->toDateString();
        $jam_keluar = Carbon::now()->toTimeString();

        // Cek apakah sudah absen datang
        $absen = Absen::where('user_id', $user_id)->where('tanggal', $tanggal)->first();
        if (!$absen) {
            return back()->with('error', 'Anda belum melakukan absen datang.');
        }

        // Cek apakah sudah absen pulang
        if ($absen->jam_keluar) {
            return back()->with('error', 'Anda sudah melakukan absen pulang hari ini.');
        }

        // Update data absen
        $absen->update(['jam_keluar' => $jam_keluar]);

        return response()->json(['success' => true, 'message' => 'Absen pulang berhasil!']);
    }
}
