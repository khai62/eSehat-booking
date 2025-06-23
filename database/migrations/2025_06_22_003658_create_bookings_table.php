<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dokter_id')->constrained('users'); // atau 'dokters' jika tabelnya terpisah
            $table->foreignId('pasien_id')->constrained('users');
            $table->date('tanggal');
            $table->time('jam_mulai'); // ⬅️ Jam mulai
            $table->time('jam_selesai'); // ⬅️ Jam selesai
            $table->text('keluhan')->nullable();
            $table->enum('status', ['pending', 'terima', 'tolak', 'selesai', 'no-show'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};

