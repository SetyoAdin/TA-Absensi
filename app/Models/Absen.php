<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Absen extends Model
{
    use HasFactory;

    protected $table = 'absens';
    protected $primaryKey = 'absen_id';
    protected $fillable = [
        'user_id',
        'kategori_izin_id',
        'tanggal',
        'jam_masuk',
        'jam_keluar',
        'status',
        'alasan',
        'gambar'
    ];

    // Define date casting to ensure proper date handling
    protected $casts = [
        'tanggal' => 'date:Y-m-d',
        'jam_masuk' => 'datetime:H:i:s',
        'jam_keluar' => 'datetime:H:i:s',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Define relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function kategoriIzin()
    {
        return $this->belongsTo(KategoriIzin::class, 'kategori_izin_id', 'detail_izin_id');
    }
}
