<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Karyawan;

class KaryawanController extends Controller
{
    public function karyawan()
    {
        $users = User::all();
        $karyawans = Karyawan::all();
        return view('admin.karyawan', compact('users', 'karyawans'));
    }
    public function edit($id)
    {
        $karyawan = Karyawan::where('user_id', $id)->with('user')->firstOrFail();
        $users = User::all();

        return view('admin.editkaryawan', compact('karyawan', 'users'));
    }
    public function updatekaryawan(Request $request, $user_id)
    {
        // Validasi input
        $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'posisi' => 'required|string|max:255',
            'departemen' => 'required|string|max:255',
        ]);

        // Cek apakah karyawan dengan user_id ada
        $karyawan = Karyawan::where('user_id', $user_id)->firstOrFail();

        // Update data karyawan
        $karyawan->update([
            'user_id' => $request->user_id,
            'posisi' => $request->posisi,
            'departemen' => $request->departemen,
        ]);

        // Redirect kembali ke halaman karyawan
        return redirect('/karyawan')->with('success', 'Data karyawan berhasil diperbarui!');
    }
}
