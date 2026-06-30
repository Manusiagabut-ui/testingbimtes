<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['exam_session_id', 'text', 'correct']; // ubah session_id jadi exam_session_id

public function examSession()
{
    return $this->belongsTo(ExamSession::class, 'exam_session_id');
}

    // Relasi: Satu pertanyaan punya banyak pilihan jawaban
    public function options()
    {
        return $this->hasMany(Option::class);
    }
}