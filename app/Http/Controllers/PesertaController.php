<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peserta;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade\Pdf;

class PesertaController extends Controller
{
    // Method untuk menampilkan halaman form (akan kita buat nanti)
    public function create()
    {
        return view('pendaftaran.form');
    }

    // Method untuk memproses data saat tombol submit ditekan
    public function store(Request $request)
    {
        // 1. Validasi Data
        $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'nim' => 'required|string|max:20|unique:pesertas,nim',
            'asal_instansi' => 'required|string|max:100',
            'harapan_seminar' => 'nullable|string',
        ]);

        // 2. Generate Token QR Unik (Misal: HIMSI-8A7B6C)
        $qrToken = 'HIMSI-' . strtoupper(Str::random(6));

        // 3. Simpan ke Database
        $peserta = Peserta::create([
            'nama_lengkap' => $request->nama_lengkap,
            'nim' => $request->nim,
            'asal_instansi' => $request->asal_instansi,
            'harapan_seminar' => $request->harapan_seminar,
            'qr_token' => $qrToken,
            'status_kehadiran' => 'Belum Hadir',
        ]);

        // 4. Generate Gambar QR Code
        // Kita gunakan format SVG agar tidak pecah saat dicetak ke PDF/ID Card
        $qrCodeImage = QrCode::size(200)->generate($qrToken);

        // 5. Lempar ke halaman sukses dengan membawa data identitas & QR
        return view('pendaftaran.sukses', compact('peserta', 'qrCodeImage'));
    }
    // Method untuk meng-generate dan download PDF
    public function downloadPdf($id)
    {
        $peserta = Peserta::findOrFail($id);
        
        // Kita ubah SVG menjadi Base64 agar bisa dirender dengan sempurna oleh DomPDF
        $qrCodeImage = base64_encode((string) QrCode::size(150)->generate($peserta->qr_token));

        // Load halaman desain PDF
        $pdf = Pdf::loadView('pendaftaran.pdf', compact('peserta', 'qrCodeImage'));
        
        // Set ukuran kertas (Custom: kurang lebih ukuran ID Card standar)
        $pdf->setPaper([0, 0, 283.465, 425.197], 'portrait'); 

        return $pdf->download('Identity-Card-' . $peserta->nim . '.pdf');
    }
    // Method untuk memvalidasi dan mengupdate status kehadiran via QR Scanner
    public function scanQR(Request $request)
    {
        // 1. Pastikan ada data token yang dikirim dari kamera
        $request->validate([
            'qr_token' => 'required|string'
        ]);

        // 2. Cari peserta berdasarkan QR Token tersebut di database
        $peserta = Peserta::where('qr_token', $request->qr_token)->first();

        // Kondisi A: Jika token palsu / tidak ada di database
        if (!$peserta) {
            return response()->json([
                'success' => false,
                'message' => '🚨 Tiket tidak valid! Data peserta tidak ditemukan.'
            ]);
        }

        // Kondisi B: Jika peserta sudah pernah check-in sebelumnya (mencegah tiket ganda)
        if ($peserta->status_kehadiran === 'Hadir') {
            return response()->json([
                'success' => false,
                'message' => '⚠️ Peserta atas nama ' . $peserta->nama_lengkap . ' sudah melakukan check-in sebelumnya.'
            ]);
        }

        // Kondisi C: Jika valid dan belum check-in -> Update database
        $peserta->update([
            'status_kehadiran' => 'Hadir'
        ]);

        // Kirim respon sukses kembali ke layar HP panitia
        return response()->json([
            'success' => true,
            'message' => '✅ Check-in berhasil!',
            'data' => [
                'nama' => $peserta->nama_lengkap,
                'nim' => $peserta->nim,
                'instansi' => $peserta->asal_instansi
            ]
        ]);
    }
}