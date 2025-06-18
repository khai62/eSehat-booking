<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('dokters', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email')->unique();
        $table->string('password');
        $table->string('gender');
        $table->string('alamat_rumah');
        $table->string('no_hp');
        $table->string('pendidikan');
        $table->string('foto')->nullable();
        $table->string('no_lisensi');
        $table->string('spesialis');
        $table->integer('pengalaman');
        $table->string('alamat_klinik');
        $table->text('jadwal_praktek')->nullable(); // disimpan dalam bentuk json
         $table->string('role')->default('dokter');
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('dokters');
    }
};
