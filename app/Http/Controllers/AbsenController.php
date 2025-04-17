<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absen;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Karyawan;
use App\Models\KategoriIzin;
use Illuminate\Support\Facades\Storage;
use App\Models\Izin;

class AbsenController extends Controller
{
    public function dataabsen()
    {
        return view('admin.dataabsen');
    }

    public function filter(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Set timezone to Asia/Jakarta (WIB+7)
        date_default_timezone_set('Asia/Jakarta');

        $startDate = Carbon::parse($request->start_date)->startOfDay();
        $endDate = Carbon::parse($request->end_date)->endOfDay();

        $absens = Absen::with(['user', 'kategoriIzin'])
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->orderBy('tanggal', 'desc')
            ->get()
            ->map(function ($absen) {
                return [
                    'user_name' => $absen->user ? $absen->user->name : 'N/A',
                    'kategori_izin' => $absen->kategoriIzin ? $absen->kategoriIzin->nama_kategori : 'Hadir',
                    'tanggal' => $absen->tanggal ? Carbon::parse($absen->tanggal)->format('d/m/Y') : '-',
                    'jam_masuk' => $absen->jam_masuk ? Carbon::parse($absen->jam_masuk)->format('H:i:s') : '-',
                    'jam_keluar' => $absen->jam_keluar ? Carbon::parse($absen->jam_keluar)->format('H:i:s') : '-',
                    'status' => ucfirst($absen->status),
                    'alasan' => $absen->alasan ?? '-',
                    'gambar' => $absen->gambar ? asset($absen->gambar) : null,
                    'actions' => view('admin.absen-actions', ['absen' => $absen])->render()
                ];
            });

        return response()->json($absens);
    }



    public function absenDatang(Request $request)
    {
        $request->validate([
            'gambar' => 'required',
        ]);

        // Set timezone to Asia/Jakarta (WIB+7)
        date_default_timezone_set('Asia/Jakarta');

        // Get current date in WIB+7
        $now = Carbon::now('Asia/Jakarta');

        // Check if user has already checked in today
        $existingAbsen = Absen::where('user_id', Auth::id())
            ->where('tanggal', $now->toDateString())
            ->first();

        if ($existingAbsen) {
            return redirect()->back()->with('error', 'Anda sudah melakukan absen datang hari ini. Tidak dapat melakukan absen datang lagi.');
        }

        // Ambil data base64 dari request
        $imageData = $request->input('gambar');

        if ($imageData) {
            // Hilangkan prefix base64
            $imageData = str_replace('data:image/png;base64,', '', $imageData);
            $imageData = str_replace(' ', '+', $imageData);

            // Nama file
            $fileName = 'absen_' . time() . '.png';
            $folderPath = public_path('image');

            // Pastikan folder image ada
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0755, true);
            }

            $path = $folderPath . '/' . $fileName;

            // Simpan file fisik
            file_put_contents($path, base64_decode($imageData));

            // Simpan path file ke database
            $gambarPath = 'image/' . $fileName;

            Absen::create([
                'user_id' => Auth::id(),
                'tanggal' => $now->toDateString(),
                'jam_masuk' => $now->toTimeString(),
                'status' => 'hadir',
                'gambar' => $gambarPath, // Ini link yang disimpan
            ]);

            return redirect()->back()->with('success', 'Absen Datang Berhasil!');
        }

        // Jika tidak ada gambar
        return redirect()->back()->with('error', 'Gagal menyimpan gambar.');
    }


    public function absenPulang(Request $request)
    {
        // Set timezone to Asia/Jakarta (WIB+7)
        date_default_timezone_set('Asia/Jakarta');

        // Get current date in WIB+7
        $now = Carbon::now('Asia/Jakarta');

        // Check if user has already checked in today
        $absen = Absen::where('user_id', Auth::id())
            ->where('tanggal', $now->toDateString())
            ->first();

        if (!$absen) {
            return redirect()->back()->with('error', 'Anda belum melakukan absen datang hari ini. Silakan lakukan absen datang terlebih dahulu.');
        }

        // Check if user has already checked out today
        if ($absen->jam_keluar) {
            return redirect()->back()->with('error', 'Anda sudah melakukan absen pulang hari ini. Tidak dapat melakukan absen pulang lagi.');
        }

        $absen->update([
            'jam_keluar' => $now->toTimeString()
        ]);
        return redirect()->back()->with('success', 'Absen Pulang Berhasil!');
    }





    public function edit($id)
    {
        $absen = Absen::findOrFail($id);
        $kategoriIzins = KategoriIzin::all();
        return view('admin.edit-absen', compact('absen', 'kategoriIzins'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jam_masuk' => 'nullable|date_format:H:i:s',
            'jam_keluar' => 'nullable|date_format:H:i:s',
            'status' => 'required|in:hadir,izin,sakit,alpha',
            'kategori_izin_id' => 'nullable|exists:kategori_izins,detail_izin_id',
            'alasan' => 'nullable|string',
        ]);

        // Set timezone to Asia/Jakarta (WIB+7)
        date_default_timezone_set('Asia/Jakarta');

        $absen = Absen::findOrFail($id);

        // Get all request data except gambar
        $data = $request->except('gambar');

        // Update the record
        $absen->update($data);

        return redirect()->route('dataabsen')->with('success', 'Data absen berhasil diperbarui.');
    }

    public function destroy($id)
    {
        try {
            $absen = Absen::findOrFail($id);

            // Delete the image file if it exists
            if ($absen->gambar && file_exists(public_path($absen->gambar))) {
                unlink(public_path($absen->gambar));
            }

            $absen->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data absen berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function ajukanIzin(Request $request)
    {
        $request->validate([
            'kategori_izin_id' => 'required|exists:kategori_izins,detail_izin_id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan' => 'required|string|max:255'
        ]);

        $izin = new Izin();
        $izin->user_id = Auth::user()->user_id;
        $izin->kategori_izin_id = $request->kategori_izin_id;
        $izin->tanggal_mulai = $request->tanggal_mulai;
        $izin->tanggal_selesai = $request->tanggal_selesai;
        $izin->alasan = $request->alasan;
        $izin->status = 'pending';
        $izin->save();

        return redirect()->back()->with('success', 'Pengajuan izin berhasil dikirim');
    }

    public function index()
    {
        $user = Auth::user();
        $karyawan = Karyawan::where('user_id', $user->user_id)->first();
        $kategori_izins = KategoriIzin::all();

        // Get attendance history
        $absens = Absen::where('user_id', $user->user_id)
            ->orderBy('tanggal', 'desc')
            ->get();

        // Get permission history
        $izins = Izin::where('user_id', $user->user_id)
            ->with('kategoriIzin')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.absen', compact('karyawan', 'kategori_izins', 'absens', 'izins'));
    }

    public function histori(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = Carbon::parse($request->start_date)->startOfDay();
        $endDate = Carbon::parse($request->end_date)->endOfDay();

        $absens = Absen::where('user_id', Auth::user()->user_id)
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->orderBy('tanggal', 'desc')
            ->get()
            ->map(function ($absen) {
                return [
                    'tanggal' => Carbon::parse($absen->tanggal)->format('d/m/Y'),
                    'jam_masuk' => $absen->jam_masuk ? Carbon::parse($absen->jam_masuk)->format('H:i:s') : null,
                    'jam_keluar' => $absen->jam_keluar ? Carbon::parse($absen->jam_keluar)->format('H:i:s') : null,
                    'status' => ucfirst($absen->status),
                    'alasan' => $absen->alasan,
                ];
            });

        return response()->json($absens);
    }

    public function izinManajemen()
    {
        $izins = Izin::with(['user', 'kategoriIzin'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.izin-manajemen', compact('izins'));
    }

    public function izinFilter(Request $request)
    {
        $query = Izin::with(['user', 'kategoriIzin']);

        if ($request->start_date && $request->end_date) {
            $query->whereBetween('tanggal_mulai', [
                Carbon::parse($request->start_date)->startOfDay(),
                Carbon::parse($request->end_date)->endOfDay()
            ]);
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $izins = $query->orderBy('created_at', 'desc')->get();

        return view('admin.izin-manajemen', compact('izins'));
    }

    public function izinUpdate(Request $request, $izin_id)
    {
        $request->validate([
            'status' => 'required|in:pending,disetujui,ditolak'
        ]);

        $izin = Izin::where('izin_id', $izin_id)->first();

        if (!$izin) {
            return redirect()->back()->with('error', 'Data izin tidak ditemukan');
        }

        $izin->status = $request->status;
        $izin->save();

        return redirect()->back()->with('success', 'Status izin berhasil diperbarui');
    }

    public function izinDestroy($izin_id)
    {
        try {
            $izin = Izin::findOrFail($izin_id);
            $izin->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data izin berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data: ' . $e->getMessage()
            ], 500);
        }
    }
}
