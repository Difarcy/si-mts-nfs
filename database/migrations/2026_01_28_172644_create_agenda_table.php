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
        Schema::create('agenda', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            // 'gambar' tipe JSON untuk menampung multi-image
            $table->json('gambar')->nullable();
            // 'lampiran' untuk file dokumen
            $table->string('lampiran')->nullable();
            
            $table->text('deskripsi')->nullable();
            $table->text('tags')->nullable();
            $table->enum('status', ['publish', 'draft', 'nonaktif'])->default('draft');
            $table->string('penulis')->nullable(); // Ubah dari FK ke String
            $table->string('lokasi')->nullable();
            $table->dateTime('tanggal_publikasi')->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->time('waktu_mulai')->nullable();
            $table->time('waktu_selesai')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agenda');
    }
};
