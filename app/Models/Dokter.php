<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Dokter extends Authenticatable
{
    use HasFactory;

    protected $table = 'dokters'; // Pastikan ini ditulis eksplisit

    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'alamat_rumah',
        'no_hp',
        'pendidikan',
        'foto',
        'no_lisensi',
        'spesialis',
        'pengalaman',
        'alamat_klinik',
        'jadwal_praktek',
        'role'
    ];

    protected $hidden = ['password'];

    protected $casts = [
        'jadwal_praktek' => 'array', // agar otomatis didecode JSON jadi array
    ];
}
