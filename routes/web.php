<?php

use App\Http\Controllers\FeedbackController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\PesertaController;

// Rute untuk menampilkan form pendaftaran
Route::get('/pendaftaran', [PesertaController::class, 'create'])->name('pendaftaran.form');

// Rute untuk memproses data pendaftaran saat tombol submit ditekan
Route::post('/pendaftaran', [PesertaController::class, 'store'])->name('pendaftaran.store');

// Rute untuk mengunduh PDF ID Card
Route::get('/pendaftaran/pdf/{id}', [PesertaController::class, 'downloadPdf'])->name('pendaftaran.pdf');

// Rute untuk memproses data dari web scanner kamera panitia
Route::post('/scan-qr', [PesertaController::class, 'scanQR'])->name('pendaftaran.scan');

// Rute untuk menampilkan halaman web scanner (akan kita buat nanti)
Route::get('/scanner', function () {
    return view('pendaftaran.scanner');
})->name('pendaftaran.scanner');

// Rute untuk Sistem Feedback & Sertifikat
Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback.form');
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');