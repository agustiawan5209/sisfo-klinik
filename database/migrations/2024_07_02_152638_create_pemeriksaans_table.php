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
        Schema::create('pemeriksaans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_layanan')->constrained('layanans');
            $table->string('nama_layanan');
            $table->foreignId('id_pasien')->constrained('pasiens');
            $table->foreignId('id_pendaftaran')->constrained('pasiens');
            $table->string('nama_pasien');
            $table->string('nama_petugas');
            $table->text('hasil_pemeriksaan');
            $table->date('tgl_pemeriksaan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaans');
    }
};
