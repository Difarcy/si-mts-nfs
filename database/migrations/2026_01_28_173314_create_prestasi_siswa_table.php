<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prestasi_siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lomba');
            $table->string('nama_siswa');
            $table->string('foto_siswa')->nullable();
            $table->string('sertifikat')->nullable();
            $table->text('deskripsi')->nullable();
            $table->text('tags')->nullable();
            $table->enum('status', ['publish', 'draft', 'nonaktif'])->default('draft');
            $table->string('penulis')->nullable(); // Ubah dari FK ke String
            $table->string('kelas')->nullable();
            $table->string('tingkat')->nullable(); // Contoh: Nasional, Provinsi
            $table->enum('jenis', ['Akademik', 'Non-Akademik'])->default('Non-Akademik');
            $table->string('penyelenggara')->nullable();
            $table->string('peringkat')->nullable(); // Contoh: Juara 1, Harapan 2
            $table->date('tanggal')->nullable();
            $table->dateTime('tanggal_publikasi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestasi_siswa');
    }
};
