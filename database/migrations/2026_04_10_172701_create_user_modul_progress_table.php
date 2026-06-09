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
        Schema::create('user_modul_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('kursus_id')->constrained('kursus')->onDelete('cascade');
            $table->foreignId('modul_id')->constrained('modul')->onDelete('cascade');
            $table->enum('status_modul', ['belum', 'selesai'])->default('belum');
            $table->enum('status_kursus', ['belum', 'selesai'])->default('belum');
            $table->timestamp('selesai_at')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'modul_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_modul_progress');
    }
};