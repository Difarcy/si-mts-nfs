<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('komentar', function (Blueprint $table) {
            $table->id();
            $table->string('konten_tipe', 20);
            $table->unsignedBigInteger('konten_id');
            $table->unsignedBigInteger('thread_id')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('nama', 100);
            $table->string('email', 120);
            $table->string('author_type')->default('visitor');
            $table->text('isi');
            $table->enum('status', ['pending', 'approved'])->default('pending');
            $table->boolean('is_read')->default(false);
            $table->dateTime('tanggal');

            $table->index(['konten_tipe', 'konten_id']);
            $table->index('thread_id');
            $table->index('status');
            $table->index('is_read');
            $table->index('tanggal');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('komentar');
    }
};
