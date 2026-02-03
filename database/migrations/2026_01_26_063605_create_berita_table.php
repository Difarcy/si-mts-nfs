<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('berita', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('thumbnail')->nullable(); // Foto Kecil
            $table->text('gambar')->nullable(); // Foto Besar - Changed to text for array storage
            $table->longText('deskripsi'); // Isi Berita
            $table->enum('status', ['publish', 'draft', 'nonaktif'])->default('draft');
            $table->string('penulis')->nullable();
            $table->dateTime('tanggal_publikasi')->nullable();
            $table->boolean('is_highlight')->default(false); // Berita Unggulan
            $table->text('tags')->nullable(); // Label/Kategori


        });

        // Add fulltext index for searching (MySQL only)
        if (DB::connection()->getDriverName() === 'mysql') {
            DB::statement('ALTER TABLE berita ADD FULLTEXT fulltext_berita(judul, deskripsi)');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita');
    }
};