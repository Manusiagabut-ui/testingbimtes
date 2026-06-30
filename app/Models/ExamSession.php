<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamSession extends Model
{
    protected $table = 'exam_sessions'; // Menegaskan nama tabelnya
    protected $fillable = ['name', 'duration'];

    public function questions()
    {
        return $this->hasMany(Question::class, 'exam_session_id');
    }
}