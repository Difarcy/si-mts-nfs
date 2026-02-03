<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('komentar_like_publik')) {
            return;
        }

        Schema::create('komentar_like_publik', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('komentar_id');
            $table->string('device_id', 64)->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();

            $table->foreign('komentar_id')
                ->references('id')
                ->on('komentar')
                ->onDelete('cascade');

            $table->unique(['komentar_id', 'device_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('komentar_like_publik');
    }
};
