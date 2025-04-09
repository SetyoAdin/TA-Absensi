<?php

use App\Http\Controllers\AbsenController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KaryawanController;
use App\Models\Absen;
use Illuminate\Support\Facades\Auth;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome');
});
//ROUTE UNTUK TAMPILAN HALAMAN
route::get('/dashboard', function () {
    return view('admin.dashboard');
});
// Route::get('/register', function () {

Route::get('/sidebar', function () {
    return view('template.sidebar');
});
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::middleware(['auth'])->get('/absen', function () {
    $user = Auth::user();
    $karyawan = Karyawan::where('user_id', $user->user_id)->first();

    return view('user.absen', compact('karyawan'));
});

// Route::get('/editregister/{id}', function ($id) {
//     $user = User::findOrFail($id); // Ambil data user berdasarkan ID
//     return view('auth.editregister', compact('user'));
// });


Route::get('/main', function () {
    return view('layouts.main');
});
Route::get('/tes', function () {
    $user = Auth::user();
    $karyawan = Karyawan::where('user_id', $user->user_id)->first();
    return view('tes', compact('karyawan'));
});

Route::middleware(['auth'])->group(function () {
    Route::get('/register', [AuthController::class, 'regist'])->name('register');
    Route::get('/karyawan', [KaryawanController::class, 'karyawan'])->name('karyawan');
    Route::post('/karyawan', [AuthController::class, 'insertkaryawan'])->name('karyawan.insertkaryawan');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
    Route::post('/kategori-izin/store', [AbsenController::class, 'store'])->name('kategori-izin.store');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/editkaryawan/{id}', [KaryawanController::class, 'edit'])->name('edit.karyawan');
    Route::get('/editregister/{id}', [AuthController::class, 'edit'])->name('user.edit');
    Route::get('/kategori', [AbsenController::class, 'kategori'])->name('kategori');
    Route::get('/dataabsen', [AbsenController::class, 'dataabsen'])->name('dataabsen');
    Route::get('/absen/filter', [AbsenController::class, 'filter'])->name('absen.filter');
    Route::get('/absen/{id}/edit', [AbsenController::class, 'edit'])->name('absen.edit');
    Route::put('/absen/{id}', [AbsenController::class, 'update'])->name('absen.update');
    Route::delete('/absen/{id}', [AbsenController::class, 'destroy'])->name('absen.destroy');

    //ROUTE UNTUK DELETE
    Route::delete('/hapus-user/{id}', [AuthController::class, 'userdestroy'])->name('hapus-user');

    Route::delete('/hapus-karyawan/{id}', [AuthController::class, 'destroykaryawan']);
    Route::delete('/kategori-izin/{id}', [AbsenController::class, 'kategoriDestroy'])->name('kategori-izin.destroy');


    //ROUTE UNTUK EDIT
    Route::put('/updatekaryawan/{user_id}', [KaryawanController::class, 'updatekaryawan'])->name('karyawan.updatekaryawan');
    Route::put('/updatepengguna/{user_id}', [AuthController::class, 'updatepengguna'])->name('user.updatepengguna');
});


//ROUTE UNTUK PROSES PADA HALAMAN

Route::post('/login', [AuthController::class, 'loginproses'])->name('login.post');

Route::post('/absen-datang', [AbsenController::class, 'absenDatang'])->name('absen.datang');
Route::post('/absen-pulang', [AbsenController::class, 'absenPulang'])->name('absen.pulang');

Route::get('/diagnostic', function () {
    try {
        // Check if the absens table exists
        $tableExists = Schema::hasTable('absens');

        // Get all records from absens table
        $allAbsens = DB::select("SELECT * FROM absens");

        // Get specific date records
        $dateAbsens = DB::select("SELECT * FROM absens WHERE tanggal = ?", ['2025-04-08']);

        // Get table structure
        $columns = Schema::getColumnListing('absens');

        // Get a sample record to check date format
        $sampleRecord = DB::select("SELECT * FROM absens LIMIT 1");

        return view('diagnostic', compact('tableExists', 'allAbsens', 'dateAbsens', 'columns', 'sampleRecord'));
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage();
    }
});

Route::get('/test-absen', function () {
    try {
        // First, let's check if we can insert a record
        $testDate = '2025-04-08';
        $userId = Auth::id() ?? 1; // Use current user ID or default to 1

        // Insert a test record
        $inserted = DB::insert(
            "INSERT INTO absens (user_id, tanggal, jam_masuk, status, created_at, updated_at) 
                               VALUES (?, ?, ?, ?, NOW(), NOW())",
            [$userId, $testDate, '08:00:00', 'hadir']
        );

        // Now try to retrieve it
        $results = DB::select("SELECT * FROM absens WHERE tanggal = ?", [$testDate]);

        // Also try with different date formats
        $formattedDate = date('Y-m-d', strtotime($testDate));
        $formattedResults = DB::select("SELECT * FROM absens WHERE tanggal = ?", [$formattedDate]);

        // Get all records to see what's in the database
        $allRecords = DB::select("SELECT * FROM absens");

        return view('test-absen', compact('inserted', 'results', 'formattedResults', 'allRecords', 'testDate'));
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage() . "<br>Stack trace: " . $e->getTraceAsString();
    }
});
