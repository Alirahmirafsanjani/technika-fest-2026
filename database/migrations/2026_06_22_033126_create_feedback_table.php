<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            // Menghubungkan feedback dengan peserta
            $table->foreignId('peserta_id')->constrained('pesertas')->onDelete('cascade');
            $table->integer('rating_kegiatan'); // Nilai 1-5 untuk evaluasi seminar UI/UX & Poster
            $table->text('komentar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
