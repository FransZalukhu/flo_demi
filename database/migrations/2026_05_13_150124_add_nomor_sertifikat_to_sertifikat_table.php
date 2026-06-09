<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sertifikat', function (Blueprint $blueprint) {
            $blueprint->string('nomor_sertifikat')->nullable()->unique()->after('kursus_id');
        });
    }

    public function down(): void
    {
        Schema::table('sertifikat', function (Blueprint $blueprint) {
            $blueprint->dropColumn('nomor_sertifikat');
        });
    }
};
