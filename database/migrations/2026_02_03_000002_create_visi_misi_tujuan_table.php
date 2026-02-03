<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visi_misi_tujuan', function (Blueprint $table) {
            $table->id();
            $table->longText('visi')->nullable();
            $table->longText('misi')->nullable();
            $table->longText('tujuan')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visi_misi_tujuan');
    }
};

