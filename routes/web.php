<?php

use App\Http\Controllers\AbsenController;
use App\Http\Controllers\AuthController;
use App\Models\Auth;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
//ROUTE UNTUK TAMPILAN HALAMAN
route::get('/dashboard', function () {
    return view('admin.dashboard');
});
// Route::get('/register', function () {
//     $users = User::all();
//     return view('auth.register', compact('users')); // Kirim variabel $users ke view
// });
Route::get('/sidebar', function () {
    return view('template.sidebar');
});
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::get('/absen', function () {
    return view('user.absen');
});
// Route::get('/karyawan', function () {
//     $users = User::all();
//     $karyawans = Karyawan::all();
//     return view('admin.karyawan', compact('users', 'karyawans',)); // Kirim variabel $users ke view
// });
Route::get('/editregister/{id}', function ($id) {
    $user = User::findOrFail($id); // Ambil data user berdasarkan ID
    return view('auth.editregister', compact('user'));
});
Route::get('/editkaryawan/{id}', function ($id) {
    $karyawan = Karyawan::where('user_id', $id)->with('user')->firstOrFail();
    $users = User::all();
    return view('admin.editkaryawan', compact('karyawan', 'users')); // Kirim variabel $users ke view
});
Route::get('/main', function () {
    return view('layouts.main');
});
Route::get('/tes', function () {
    return view('tes');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/register', [AuthController::class, 'regist'])->name('register');
    Route::get('/karyawan', [AuthController::class, 'karyawan'])->name('karyawan');
});


//ROUTE UNTUK PROSES PADA HALAMAN
Route::post('/register', [AuthController::class, 'register'])->name('register.store');
Route::post('/login', [AuthController::class, 'loginproses'])->name('login.post');
Route::post('/karyawan', [AuthController::class, 'insertkaryawan'])->name('karyawan.insertkaryawan');
Route::post('/absen-datang', [AbsenController::class, 'absenDatang'])->name('absen.datang');
Route::post('/absen-pulang', [AbsenController::class, 'absenPulang'])->name('absen.pulang');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


//ROUTE UNTUK DELETE
Route::delete('/hapus-user/{id}', [AuthController::class, 'userdestroy'])->name('hapus-user');

Route::delete('/hapus-karyawan/{id}', [AuthController::class, 'destroykaryawan']);

//ROUTE UNTUK EDIT
Route::put('/updatekaryawan/{user_id}', [AuthController::class, 'updatekaryawan'])->name('karyawan.updatekaryawan');

Route::put('/users/{id}', [AuthController::class, 'userupdate'])->name('users.userupdate');
