<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    use HasFactory;

    // Mengizinkan kolom-kolom ini diisi data dari form
    protected $fillable = [
        'nama_lengkap',
        'nim',
        'asal_instansi',
        'harapan_seminar',
        'qr_token',
        'status_kehadiran',
    ];
}