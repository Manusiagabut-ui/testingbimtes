<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $fillable = [
        'peserta_id', 'exam_session_id', 'total_soal', 
        'jawaban_benar', 'jawaban_salah', 'skor', 'waktu_mulai', 'waktu_selesai'
    ];

    // Relasi balik ke data Peserta
    public function peserta() {
        return $this->belongsTo(Peserta::class);
    }

    // Relasi balik ke Sesi Ujian
    public function examSession() {
        return $this->belongsTo(ExamSession::class);
    }
}