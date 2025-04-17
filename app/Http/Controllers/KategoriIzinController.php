<?php

namespace App\Http\Controllers;

use App\Models\KategoriIzin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Karyawan;

class KategoriIzinController extends Controller
{
    public function kategori()
    {
        $user = Auth::user();
        $karyawan = Karyawan::where('user_id', $user->user_id)->first();
        $kategori_izins = KategoriIzin::all();

        return view('admin.kategori', compact('karyawan', 'kategori_izins'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama_kategori' => 'required|string|max:255|unique:kategori_izins,nama_kategori',
                'deskripsi' => 'nullable|string',
            ]);

            KategoriIzin::create([
                'nama_kategori' => $request->nama_kategori,
                'deskripsi' => $request->deskripsi,
            ]);

            return redirect()->back()->with('success', 'Data berhasil ditambah');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return redirect()->back()->with('error', $errors[0]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }

    public function edit($id)
    {
        $kategori = KategoriIzin::findOrFail($id);
        return view('admin.edit-kategori', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $kategori = KategoriIzin::findOrFail($id);
        $kategori->update($request->all());

        return redirect()->route('kategori-izin.index')
            ->with('success', 'Data berhasil diperbarui');
    }

    public function kategoriDestroy($id)
    {
        try {
            $kategori = KategoriIzin::findOrFail($id);
            $kategori->delete();

            return redirect()->back()->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data');
        }
    }
}
