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
use App\Models\Absen;
use App\Models\Izin;

class AuthController extends Controller
{

    public function regist()
    {
        $users = User::all();
        return view('auth.register', compact('users'));
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

        return response()->json([
            'success' => true,
            'message' => 'Registrasi berhasil!'
        ]);
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

        return back()->with('success', 'Data berhasil disimpan!');
    }

    public function destroykaryawan($id)
    {
        $karyawan = Karyawan::find($id);

        if (!$karyawan) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $karyawan->delete();
        return response()->json(['message' => 'Data berhasil dihapus']);
    }

    public function userdestroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User tidak ditemukan'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'Data berhasil dihapus']);
    }



    public function edit($id)
    {
        $user = User::where('user_id', $id)->firstOrFail(); // Cari berdasarkan 'id', bukan 'user_id'

        return view('auth.editregister', compact('user')); // Kirim data ke view
    }


    public function updatepengguna(Request $request, $user_id)
    {
        // Validasi inputan
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

        // Ambil data user berdasarkan user_id
        $user = User::where('user_id', $user_id)->firstOrFail();

        // Update data user
        $user->name = $request->name;
        $user->email = $request->email;

        // Update password hanya jika diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->role = $request->role;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Data pengguna berhasil diperbarui'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Logout user
        Session::flush(); // Hapus semua session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda telah logout.');
    }

    public function dashboard()
    {
        // Total Users
        $totalUsers = User::count();

        // Total Karyawan
        $totalKaryawan = Karyawan::count();

        // Total Absen Hari Ini
        $totalAbsen = Absen::whereDate('tanggal', now()->toDateString())->count();

        // Total Izin
        $totalIzin = Izin::count();

        // Rekap Harian
        $rekapHarian = [
            'hadir' => Absen::whereDate('tanggal', now()->toDateString())
                ->where('status', 'hadir')
                ->count(),
            'izin' => Absen::whereDate('tanggal', now()->toDateString())
                ->where('status', 'izin')
                ->count(),
            'sakit' => Absen::whereDate('tanggal', now()->toDateString())
                ->where('status', 'sakit')
                ->count(),
            'alpha' => Absen::whereDate('tanggal', now()->toDateString())
                ->where('status', 'alpha')
                ->count()
        ];

        // Rekap Mingguan
        $startOfWeek = now()->startOfWeek();
        $endOfWeek = now()->endOfWeek();

        $rekapMingguan = [
            'hadir' => Absen::whereBetween('tanggal', [$startOfWeek, $endOfWeek])
                ->where('status', 'hadir')
                ->count(),
            'izin' => Absen::whereBetween('tanggal', [$startOfWeek, $endOfWeek])
                ->where('status', 'izin')
                ->count(),
            'sakit' => Absen::whereBetween('tanggal', [$startOfWeek, $endOfWeek])
                ->where('status', 'sakit')
                ->count(),
            'alpha' => Absen::whereBetween('tanggal', [$startOfWeek, $endOfWeek])
                ->where('status', 'alpha')
                ->count()
        ];

        // Calculate percentages safely
        $totalHarian = array_sum($rekapHarian);
        $totalMingguan = array_sum($rekapMingguan);

        // Calculate daily percentages
        $persentaseHarian = [
            'hadir' => $totalHarian > 0 ? ($rekapHarian['hadir'] / $totalHarian) * 100 : 0,
            'izin' => $totalHarian > 0 ? ($rekapHarian['izin'] / $totalHarian) * 100 : 0,
            'sakit' => $totalHarian > 0 ? ($rekapHarian['sakit'] / $totalHarian) * 100 : 0,
            'alpha' => $totalHarian > 0 ? ($rekapHarian['alpha'] / $totalHarian) * 100 : 0
        ];

        // Calculate weekly percentages
        $persentaseMingguan = [
            'hadir' => $totalMingguan > 0 ? ($rekapMingguan['hadir'] / $totalMingguan) * 100 : 0,
            'izin' => $totalMingguan > 0 ? ($rekapMingguan['izin'] / $totalMingguan) * 100 : 0,
            'sakit' => $totalMingguan > 0 ? ($rekapMingguan['sakit'] / $totalMingguan) * 100 : 0,
            'alpha' => $totalMingguan > 0 ? ($rekapMingguan['alpha'] / $totalMingguan) * 100 : 0
        ];

        // Calculate attendance percentage
        $persentaseKehadiran = $totalKaryawan > 0 ? ($rekapHarian['hadir'] / $totalKaryawan) * 100 : 0;

        // Absensi Terbaru
        $absensiTerbaru = Absen::with('user')
            ->orderBy('tanggal', 'desc')
            ->orderBy('jam_masuk', 'desc')
            ->take(5)
            ->get();

        // Izin Terbaru
        $izinTerbaru = Izin::with(['user', 'kategoriIzin'])
            ->orderBy('tanggal_mulai', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalKaryawan',
            'totalAbsen',
            'totalIzin',
            'rekapHarian',
            'rekapMingguan',
            'persentaseHarian',
            'persentaseMingguan',
            'persentaseKehadiran',
            'absensiTerbaru',
            'izinTerbaru'
        ));
    }
}
