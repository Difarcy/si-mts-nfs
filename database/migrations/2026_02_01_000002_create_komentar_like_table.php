<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('komentar_like')) {
            return;
        }

        Schema::create('komentar_like', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('komentar_id');
            $table->unsignedBigInteger('user_id');

            $table->unique(['komentar_id', 'user_id']);
            $table->index('komentar_id');
            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('komentar_like');
    }
};

