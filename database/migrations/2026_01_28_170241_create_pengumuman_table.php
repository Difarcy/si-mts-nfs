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
        Schema::create('pengumuman', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            // 'gambar' tipe JSON untuk menampung multi-image (array path)
            $table->json('gambar')->nullable();
            // 'lampiran' untuk file PDF/Docx
            $table->string('lampiran')->nullable();
            
            $table->text('deskripsi')->nullable();
            $table->text('tags')->nullable();
            $table->enum('status', ['publish', 'draft', 'nonaktif'])->default('draft');
            $table->string('penulis')->nullable(); // Ubah dari FK ke String
            $table->dateTime('tanggal_publikasi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengumuman');
    }
};
