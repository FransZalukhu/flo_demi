<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pendaftaran', function (Blueprint $table) {
            $table->foreignId('pembayaran_id')->nullable()->after('kursus_id')->constrained('pembayaran')->onDelete('set null');
            $table->enum('status', ['menunggu_pembayaran', 'menunggu_verifikasi', 'aktif', 'selesai', 'ditolak', 'dicabut'])->change();
        });
    }

    public function down(): void
    {
        Schema::table('pendaftaran', function (Blueprint $table) {
            $table->dropForeign(['pembayaran_id']);
            $table->dropColumn('pembayaran_id');
        });
    }
};
