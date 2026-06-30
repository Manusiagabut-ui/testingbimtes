<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('ujian_progress', function (Blueprint $table) {
        $table->id();
        $table->string('nomor_peserta');
        $table->integer('current_session_index')->default(0);
        $table->integer('current_question_index')->default(0);
        $table->json('answers_pilihan')->nullable(); // Nyimpen array jawaban siswa
        $table->json('nilai_per_sesi')->nullable();  // Nyimpen skor per mapel contoh: {"Akhlaq":80}
        $table->decimal('skor_akhir', 5, 2)->nullable();
        $table->enum('status', ['belum_mulai', 'sedang_ujian', 'selesai'])->default('belum_mulai');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ujian_progress');
    }
};
