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
    Schema::create('options', function (Blueprint $table) {
        $table->id();
        // Menghubungkan ke tabel questions, kalau soal dihapus, pilihan gandanya ikut terhapus
        $table->foreignId('question_id')->constrained()->onDelete('cascade');
        $table->text('text');         // Teks pilihan ganda (A, B, C, D, E)
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('options');
    }
};
