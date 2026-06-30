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
    Schema::create('nilais', function (Blueprint $table) {
        $table->id();
        $table->foreignId('peserta_id')->constrained('pesertas')->onDelete('cascade');
        $table->foreignId('exam_session_id')->constrained('exam_sessions')->onDelete('cascade');
        $table->integer('total_soal');
        $table->integer('jawaban_benar');
        $table->integer('jawaban_salah');
        $table->decimal('skor', 5, 2); // Nilai akhir (misal: 85.50)
        $table->timestamp('waktu_mulai')->nullable();
        $table->timestamp('waktu_selesai')->nullable();
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilais');
    }
};
