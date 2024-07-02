<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('daftar_layanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pasien')->constrained('pasiens');
            $table->string('nama_pasien', 50);
            $table->foreignId('id_layanan')->constrained('layanans');
            $table->string('nama_layanan', 50);
            $table->string('nomor_antrian', 50);
            $table->date('tgl');
            $table->enum('status', ['0','1','2'])->comment('0 = nonaktif, 1 = aktif, 2 = selesai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_layanans');
    }
};
