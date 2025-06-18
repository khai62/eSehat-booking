<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('alamat_rumah')->nullable();
        $table->string('no_hp')->nullable();
        $table->string('pendidikan')->nullable();
        $table->string('foto')->nullable();
        $table->string('no_lisensi')->nullable();
        $table->string('spesialis')->nullable();
        $table->integer('pengalaman')->nullable();
        $table->string('alamat_klinik')->nullable();
        $table->json('jadwal_praktek')->nullable();
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn([
            'alamat_rumah', 'no_hp', 'pendidikan', 'foto', 'no_lisensi',
            'spesialis', 'pengalaman', 'alamat_klinik', 'jadwal_praktek'
        ]);
    });
}

};
