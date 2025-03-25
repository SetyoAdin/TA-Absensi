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
Route::get('/register', function () {
    $users = User::all();
    return view('auth.register', compact('users')); // Kirim variabel $users ke view
});
Route::get('/sidebar', function () {
    return view('template.sidebar');
});
Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/absen', function () {
    return view('user.absen');
});
Route::get('/karyawan', function () {
    $users = User::all();
    $karyawans = Karyawan::all();
    return view('admin.karyawan', compact('users', 'karyawans',)); // Kirim variabel $users ke view
});


//ROUTE UNTUK PROSES PADA HALAMAN
Route::post('/register', [AuthController::class, 'register'])->name('register.store');
Route::post('/login', [AuthController::class, 'loginproses'])->name('login.post');
Route::post('/insert-karyawan/store', [AuthController::class, 'insertkaryawan'])->name('insertkaryawan.store');
Route::post('/absen-datang', [AbsenController::class, 'absenDatang'])->name('absen.datang');
Route::post('/absen-pulang', [AbsenController::class, 'absenPulang'])->name('absen.pulang');

//ROUTE UNTUK DELETE
Route::delete('/hapus-user/{id}', [AuthController::class, 'userdestroy'])->name('hapus-user');

Route::delete('/hapus-karyawan/{id}', [AuthController::class, 'destroykaryawan']);

//ROUTE UNTUK EDIT
Route::put('/karyawan/update/{id}', [AuthController::class, 'update'])->name('karyawan.update');
Route::put('/users/{id}', [AuthController::class, 'userupdate'])->name('users.userupdate');
