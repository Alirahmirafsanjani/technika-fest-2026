<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Berhasil - Dies Natalis HIMSI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            /* 1. Sembunyikan elemen yang tidak perlu ikut tercetak (tombol & alert) */
            .no-print { display: none !important; }
            
            /* 2. Paksa browser mencetak semua warna background dan border */
            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            
            /* 3. Rapikan margin kertas */
            @page { margin: 1cm; }
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center justify-center p-6">
    <div class="w-full max-w-md text-center">
        
        <div class="no-print bg-green-100 text-green-800 p-4 rounded-xl mb-6 font-semibold">
            🎉 Pendaftaran Berhasil! Selamat bergabung.
        </div>

        <div id="identity-card" class="bg-white border-2 border-dashed border-blue-500 p-6 rounded-2xl shadow-xl mb-6 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-3 bg-blue-600"></div>
            
            <h3 class="text-xl font-bold text-gray-800 tracking-wide uppercase mt-2">Identity Card Peserta</h3>
            <p class="text-xs text-gray-500 mb-6">Seminar Nasional Dies Natalis HIMSI</p>

            <div class="flex justify-center mb-6 p-2 bg-gray-50 rounded-xl inline-block shadow-inner">
                {!! $qrCodeImage !!}
            </div>

            <div class="text-left space-y-2 border-t pt-4 text-sm">
                <div>
                    <span class="text-gray-400 block text-xs">NAMA LENGKAP</span>
                    <span class="font-bold text-gray-800 uppercase">{{ $peserta->nama_lengkap }}</span>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <span class="text-gray-400 block text-xs">NIM</span>
                        <span class="font-semibold text-gray-700">{{ $peserta->nim }}</span>
                    </div>
                    <div>
                        <span class="text-gray-400 block text-xs">INSTANSI</span>
                        <span class="font-semibold text-gray-700 uppercase">{{ $peserta->asal_instansi }}</span>
                    </div>
                </div>
                <div class="pt-2 text-center text-xs font-mono text-blue-600 tracking-widest font-bold">
                    ID: {{ $peserta->qr_token }}
                </div>
            </div>
        </div>

        <div class="no-print space-y-3">
            <a href="{{ route('pendaftaran.pdf', $peserta->id) }}" class="block w-full text-center bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 shadow transition duration-200">
                💾 Unduh Identity Card (Otomatis PDF)
            </a>
            
            <a href="https://chat.whatsapp.com/GrupSeminarHIMSI" target="_blank" class="block w-full bg-green-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-green-600 shadow transition duration-200">
                💬 Gabung Grup WhatsApp Peserta
            </a>
        </div>
    </div>
</body>
</html>