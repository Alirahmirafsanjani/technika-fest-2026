<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    // Menyesuaikan nama tabel yang ada di database
    protected $table = 'feedback'; 

    // Mengizinkan kolom ini diisi dari form
    protected $fillable = [
        'peserta_id',
        'rating_kegiatan',
        'komentar',
    ];

    // Relasi balik ke tabel peserta (1 feedback milik 1 peserta)
    public function peserta()
    {
        return $this->belongsTo(Peserta::class);
    }
}