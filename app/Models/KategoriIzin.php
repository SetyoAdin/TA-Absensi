<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriIzin extends Model
{
    use HasFactory;

    protected $primaryKey = 'detail_izin_id';

    protected $fillable = [
        'nama_kategori',
        'deskripsi',
    ];
}
