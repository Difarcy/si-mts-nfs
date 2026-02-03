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
        Schema::create('hero', function (Blueprint $table) {
            $table->id();
            $table->string('tagline')->nullable();
            $table->string('judul')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('button_text')->nullable();
            $table->string('button_url')->nullable();
            
            // Display Options (Default Checked/True)
            $table->boolean('show_logo')->default(true);
            $table->boolean('show_tagline')->default(true);
            $table->boolean('show_judul')->default(true);
            $table->boolean('show_deskripsi')->default(true);
            $table->boolean('show_button')->default(true);
            
            // No timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hero');
    }
};
