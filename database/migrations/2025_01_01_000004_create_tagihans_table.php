<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tagihans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswas')->cascadeOnDelete();
            $table->foreignId('tahun_ajaran_id')->constrained('tahun_ajarans')->cascadeOnDelete();
            $table->tinyInteger('bulan'); // 1-12
            $table->integer('nominal');
            $table->enum('status', ['belum_bayar', 'sudah_bayar','pending'])->default('belum_bayar');
            $table->timestamps();

            $table->unique(['siswa_id', 'tahun_ajaran_id', 'bulan']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tagihans');
    }
};
