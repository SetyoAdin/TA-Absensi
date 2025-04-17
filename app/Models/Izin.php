<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Izin extends Model
{
    protected $primaryKey = 'izin_id';

    protected $fillable = [
        'user_id',
        'kategori_izin_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'alasan',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function kategoriIzin()
    {
        return $this->belongsTo(KategoriIzin::class, 'kategori_izin_id', 'detail_izin_id');
    }
}
