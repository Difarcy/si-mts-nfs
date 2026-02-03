<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('video', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('link');
            $table->longText('deskripsi')->nullable();
            $table->enum('status', ['publish', 'draft', 'nonaktif'])->default('draft');
            $table->dateTime('tanggal_publikasi')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('video');
    }
};
