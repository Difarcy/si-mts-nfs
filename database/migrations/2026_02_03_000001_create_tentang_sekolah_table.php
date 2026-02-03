<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tentang_sekolah', function (Blueprint $table) {
            $table->id();
            $table->string('foto')->nullable();
            $table->longText('deskripsi')->nullable();
            $table->longText('sejarah')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tentang_sekolah');
    }
};

