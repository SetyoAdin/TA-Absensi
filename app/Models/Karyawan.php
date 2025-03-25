<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $table = 'karyawans'; // Nama tabel di database

    protected $fillable = [
        'user_id',  // Tambahkan kolom ini
        'posisi',
        'departemen',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
