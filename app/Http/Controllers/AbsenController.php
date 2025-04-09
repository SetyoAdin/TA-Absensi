<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absen;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Karyawan;
use App\Models\KategoriIzin;
use Illuminate\Support\Facades\Storage;

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
                    'tanggal' => $absen->tanggal->format('d/m/Y'),
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

    public function kategori()
    {
        $user = Auth::user();
        $karyawan = Karyawan::where('user_id', $user->user_id)->first();
        $kategori_izins = KategoriIzin::all();

        return view('admin.kategori', compact('karyawan', 'kategori_izins'));
    }

    public function absenDatang(Request $request)
    {
        $request->validate([
            'gambar' => 'required',
        ]);

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
                'tanggal' => now()->toDateString(),
                'jam_masuk' => now()->toTimeString(),
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
        $absen = Absen::where('user_id', Auth::id())
            ->where('tanggal', now()->toDateString())
            ->first();

        if ($absen) {
            $absen->update([
                'jam_keluar' => now()->toTimeString()
            ]);
            return redirect()->back()->with('success', 'Absen Pulang Berhasil!');
        }

        return redirect()->back()->with('error', 'Data absen datang tidak ditemukan.');
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        KategoriIzin::create([
            'nama_kategori' => $request->nama_kategori,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->back()->with('success', 'Kategori izin berhasil ditambahkan!');
    }
    public function kategoriDestroy($id)
    {
        $kategori = KategoriIzin::findOrFail($id);
        $kategori->delete();

        return redirect()->back()->with('success', 'Kategori izin berhasil dihapus.');
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

        $absen = Absen::findOrFail($id);

        // Get all request data except gambar
        $data = $request->except('gambar');

        // Update the record
        $absen->update($data);

        return redirect()->route('dataabsen')->with('success', 'Data absen berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $absen = Absen::findOrFail($id);

        // Delete the image file if it exists
        if ($absen->gambar && file_exists(public_path($absen->gambar))) {
            unlink(public_path($absen->gambar));
        }

        $absen->delete();

        return redirect()->route('dataabsen')->with('success', 'Data absen berhasil dihapus.');
    }
}
