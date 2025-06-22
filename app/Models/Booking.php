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

}
