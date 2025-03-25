<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Auth extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users'; // Pastikan ini sesuai dengan tabel yang digunakan untuk login

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getAuthIdentifierName()
    {
        return 'name';
    }
}
