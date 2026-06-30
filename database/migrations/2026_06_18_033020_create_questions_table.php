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
    Schema::create('questions', function (Blueprint $table) {
        $table->id();
        // DIUBAH JADI INI: menghubungkan ke exam_sessions
        $table->foreignId('exam_session_id')->constrained('exam_sessions')->onDelete('cascade'); 
        $table->text('text');         
        $table->integer('correct');   
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
