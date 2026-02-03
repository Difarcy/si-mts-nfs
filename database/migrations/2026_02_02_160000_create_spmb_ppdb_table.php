<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('spmb_ppdb', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['open', 'pending', 'closed'])->default('pending');
            $table->string('tahun')->nullable();
            $table->unsignedInteger('kuota')->nullable();
            $table->unsignedBigInteger('biaya')->nullable();

            for ($wave = 1; $wave <= 2; $wave++) {
                for ($stage = 1; $stage <= 5; $stage++) {
                    $prefix = "g{$wave}t{$stage}";

                    $table->string("{$prefix}nm")->nullable();
                    $table->date("{$prefix}st")->nullable();
                    $table->date("{$prefix}en")->nullable();
                }
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spmb_ppdb');
    }
};
