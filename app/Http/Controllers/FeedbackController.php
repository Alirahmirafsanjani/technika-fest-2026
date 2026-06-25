<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peserta;
use App\Models\Feedback;
use Barryvdh\DomPDF\Facade\Pdf;

class FeedbackController extends Controller
{
    // Menampilkan halaman form feedback
    public function index()
    {
        return view('feedback.form');
    }

    // Memproses data feedback dan langsung mengunduh Sertifikat PDF
    public function store(Request $request)
    {
        // 1. Validasi input form
        $request->validate([
            'nim' => 'required|string',
            'rating_kegiatan' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string'
        ]);

        // 2. Cari data peserta berdasarkan NIM
        $peserta = Peserta::where('nim', $request->nim)->first();

        // Cek A: Apakah NIM terdaftar di Universitas Alma Ata / database kita?
        if (!$peserta) {
            return back()->withErrors(['nim' => 'NIM tidak ditemukan dalam data pendaftar.']);
        }

        // Cek B: Apakah peserta benar-benar datang ke acara?
        if ($peserta->status_kehadiran !== 'Hadir') {
            return back()->withErrors(['nim' => 'Maaf, e-Sertifikat hanya diberikan kepada peserta yang terverifikasi hadir pada saat acara.']);
        }

        // Cek C: Apakah peserta sudah pernah mengisi feedback? (Mencegah spam data)
        $feedbackExist = Feedback::where('peserta_id', $peserta->id)->first();
        
        if (!$feedbackExist) {
            // Jika belum, simpan evaluasi materi UI/UX dan Poster ke database
            Feedback::create([
                'peserta_id' => $peserta->id,
                'rating_kegiatan' => $request->rating_kegiatan,
                'komentar' => $request->komentar
            ]);
        }

        // 3. Generate E-Sertifikat (Otomatis Landscape)
        // Kita akan membuat view 'feedback.sertifikat' di langkah selanjutnya
        $pdf = Pdf::loadView('feedback.sertifikat', compact('peserta'));
        $pdf->setPaper('A4', 'landscape'); 

        // 4. Otomatis download file PDF
        return $pdf->download('Sertifikat-Dies-Natalis-HIMSI-' . $peserta->nim . '.pdf');
    }
}