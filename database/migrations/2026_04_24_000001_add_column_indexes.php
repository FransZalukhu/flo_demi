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
        // Tabel Users
        Schema::table('users', function (Blueprint $table) {
            $table->index('username');
            $table->index('role');
        });

        // Tabel Kursus
        Schema::table('kursus', function (Blueprint $table) {
            $table->index('status');
            $table->index('created_at');
        });

        // Tabel Pendaftaran
        Schema::table('pendaftaran', function (Blueprint $table) {
            // Indeks komposit untuk filter status per user/kursus
            $table->index(['user_id', 'status']);
            $table->index(['kursus_id', 'status']);
        });

        // Tabel Modul
        Schema::table('modul', function (Blueprint $table) {
            $table->index('urutan');
        });

        // Tabel User Modul Progress
        Schema::table('user_modul_progress', function (Blueprint $table) {
            $table->index('status_modul');
            $table->index('status_kursus');
            $table->index('kursus_id'); 
        });

        // Tabel Notifikasi
        Schema::table('notifikasi', function (Blueprint $table) {
            $table->index(['user_id', 'sudah_dibaca']);
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notifikasi', function (Blueprint $table) {
            $table->dropIndex(['user_id', 'sudah_dibaca']);
            $table->dropIndex(['created_at']);
        });

        Schema::table('user_modul_progress', function (Blueprint $table) {
            $table->dropIndex(['status_modul']);
            $table->dropIndex(['status_kursus']);
            $table->dropIndex(['kursus_id']);
        });

        Schema::table('modul', function (Blueprint $table) {
            $table->dropIndex(['urutan']);
        });

        Schema::table('pendaftaran', function (Blueprint $table) {
            $table->dropIndex(['user_id', 'status']);
            $table->dropIndex(['kursus_id', 'status']);
        });

        Schema::table('kursus', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['created_at']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['username']);
            $table->dropIndex(['role']);
        });
    }
};
