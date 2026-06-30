<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    // 💡 DI SINI: Daftarkan kolom yang boleh diisi otomatis oleh Controller
    protected $fillable = [
        'nomor_peserta',
        'nama',
    ];
}