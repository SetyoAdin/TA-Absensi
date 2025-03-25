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
        'alasan'
    ];
}
