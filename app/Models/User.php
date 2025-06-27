<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Kolom yang boleh di-mass-assign.
     */
    protected $fillable = [
        // data umum
        'name',
        'email',
        'password',
        'gender',
        'birthdate',
        'city',
        'role',
        'foto',

        // data dokter
        'no_hp',
        'spesialis',
        'no_lisensi',
        'pengalaman',
        'alamat_klinik',
        'pendidikan',
        'deskripsi',
        'jadwal_praktek',
    ];


    /**
     * Kolom yang disembunyikan ketika diserialisasi.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting atribut.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }
}
