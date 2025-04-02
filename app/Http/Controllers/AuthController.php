<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function regist()
    {
        $users = User::all();
        return view('auth.register', compact('users'));
    }
    public function karyawan()
    {
        $users = User::all();
        $karyawans = Karyawan::all();
        return view('admin.karyawan', compact('users', 'karyawans'));
    }



    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => 'required|in:admin,karyawan',
        ]);

        // Log validation data to check what's being received
        Log::info('Validated registration data:', [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
        ]);

        // Create user with validated data
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect()->to('/register')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function loginproses(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'password' => 'required',
        ]);

        $credentials = $request->only('name', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Redirect berdasarkan role
            if ($user->role == 'admin') {
                return redirect('/dashboard'); // Gunakan URL langsung
            }
            if ($user->role == 'karyawan') {
                return redirect('/absen'); // Gunakan URL langsung
            }
        }

        return back()->withErrors(['name' => 'Name atau password salah!']);
    }
    public function insertkaryawan(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,user_id|unique:karyawans,user_id',
            'posisi' => 'required|string|max:255',
            'departemen' => 'required|string|max:255',
        ], [
            'user_id.unique' => 'User ini sudah terdaftar!',
        ]);

        Karyawan::create($request->all());

        return back()->with('success', 'Data karyawan berhasil disimpan!');
    }

    public function destroykaryawan($id)
    {
        $karyawan = Karyawan::find($id);

        if (!$karyawan) {
            return response()->json(['message' => 'Data karyawan tidak ditemukan'], 404);
        }

        $karyawan->delete();
        return response()->json(['message' => 'Data karyawan berhasil dihapus']);
    }

    public function userdestroy($id)
    {
        $user = User::find($id); // Cari user berdasarkan primary key

        if (!$user) {
            return response()->json(['message' => 'User tidak ditemukan'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'User berhasil dihapus']);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'posisi' => 'required|string|max:255',
            'departemen' => 'required|string|max:255',
        ]);

        $karyawan = Karyawan::findOrFail($id);
        $karyawan->update([
            'user_id' => $request->user_id,
            'posisi' => $request->posisi,
            'departemen' => $request->departemen,
        ]);

        return redirect()->back()->with('success', 'Data karyawan berhasil diperbarui!');
    }
    public function userupdate(Request $request, $user_id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($user_id, 'user_id'),
            ],
            'password' => 'nullable|min:6',
            'role' => 'required|in:karyawan,admin',
        ]);

        $user = User::where('user_id', $user_id)->firstOrFail();
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->role = $request->role;
        $user->save();

        return redirect()->back()->with('success', 'Data karyawan berhasil diperbarui.');
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
    public function logout(Request $request)
    {
        Auth::logout(); // Logout user
        Session::flush(); // Hapus semua session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda telah logout.');
    }
}
