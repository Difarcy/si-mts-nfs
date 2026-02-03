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
        Schema::create('pesan_masuk', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 35);
            $table->string('email', 30);
            $table->string('telepon', 15);
            $table->string('subject');
            $table->text('pesan');
            $table->enum('status', ['read', 'unread'])->default('unread');
            $table->dateTime('tanggal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesan_masuk');
    }
};
