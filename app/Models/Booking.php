<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

   protected $fillable = [
        'dokter_id',
        'pasien_id',
        'tanggal',
        'jam',
        'jam_mulai',
        'jam_selesai',
        'keluhan',
        'status',
    ];

        // ⬅️ Tambahkan relasi ini
    public function dokter()
    {
        return $this->belongsTo(User::class, 'dokter_id');
    }

    // (opsional) relasi ke pasien
    public function pasien()
    {
        return $this->belongsTo(User::class, 'pasien_id');
    }


}
