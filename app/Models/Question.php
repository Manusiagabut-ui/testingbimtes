<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['exam_session_id', 'text', 'correct', 'gambar'];
    protected $casts = [
        'correct' => 'integer',
    ];

public function examSession()
{
    return $this->belongsTo(ExamSession::class, 'exam_session_id');
}

    // Relasi: Satu pertanyaan punya banyak pilihan jawaban
    public function options()
{
    return $this->hasMany(Option::class)->orderBy('id');
}
}