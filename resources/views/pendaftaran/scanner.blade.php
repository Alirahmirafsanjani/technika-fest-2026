<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check-in - TechNika Fest</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: #020617; 
            background-image: radial-gradient(rgba(255, 255, 255, 0.04) 1px, transparent 1px);
            background-size: 24px 24px;
        }
        .font-mono-tech { font-family: 'JetBrains Mono', monospace; }
        #reader { border: none !important; border-radius: 1rem; overflow: hidden; }
        #reader__dashboard_section_csr span, #reader__dashboard_section_swaplink { color: #cbd5e1 !important; text-decoration: none; font-size: 14px;}
        #reader button {
            background: #f59e0b !important; color: #fff !important;
            padding: 10px 20px; border-radius: 8px; font-weight: 600; border: none; margin-top: 15px; cursor: pointer; transition: all 0.2s;
        }
        #reader button:hover { background: #d97706 !important; }
        
        /* Animasi Garis Inframerah */
        .infrared-line {
            position: absolute; top: 0; left: 0; width: 100%; height: 3px;
            background-color: #ef4444; box-shadow: 0 0 15px #ef4444;
            animation: scan 1.2s infinite alternate ease-in-out;
            z-index: 50; display: none;
        }
        @keyframes scan { 0% { top: 8%; } 100% { top: 92%; } }
    </style>
</head>
<body class="min-h-screen flex flex-col items-center justify-center p-4 relative overflow-hidden">
    
    <div class="hidden lg:block absolute left-8 w-64 text-slate-600 font-mono-tech text-[11px] space-y-6 select-none opacity-40">
        <div class="border-l-2 border-emerald-500 pl-3">
            <p class="text-emerald-400 font-bold">// SCANNING_MODULE</p>
            <p class="mt-1">READY FOR SCANNING...</p>
            <p>INFRARED_EMULATOR: ACTIVE</p>
        </div>
        <div class="p-3 bg-slate-900/40 border border-slate-800 rounded-xl space-y-1 text-slate-500">
            <p class="text-white font-bold">DEVICE TELEMETRY:</p>
            <p>FPS: 10 // QR_BOX: 250px</p>
            <p>DECODE_ENGINE: HTML5_QR</p>
        </div>
    </div>

    <div class="hidden lg:block absolute right-8 w-64 text-slate-600 font-mono-tech text-[11px] space-y-6 select-none opacity-40 text-right">
        <div class="border-r-2 border-amber-500 pr-3">
            <p class="text-amber-500 font-bold">// MATRIX_ANALYSIS</p>
            <p class="mt-1">AWAITING QR STREAM</p>
        </div>
        <div class="p-3 bg-slate-900/40 border border-slate-800 rounded-xl space-y-1 text-slate-500 text-left">
            <p class="text-white font-bold text-right">SECURITY LOGS:</p>
            <p>> ANTI_DUPLICATE: TRUE</p>
            <p>> DB_CONNECTION: OPEN</p>
        </div>
    </div>

    <div class="w-full max-w-md bg-slate-900/90 backdrop-blur-xl border border-slate-800 rounded-3xl shadow-2xl p-5 sm:p-6 relative z-10">
        
        <div class="text-center mb-5">
            <h2 class="text-xl font-bold text-white tracking-wide">Scanner Kehadiran Seminar</h2>
            <p class="text-slate-400 text-sm mt-1">TechNika Fest 2026</p>
        </div>

        <div class="bg-slate-950 rounded-2xl p-2 border border-slate-800 mb-4 shadow-inner relative">
            <div class="absolute top-4 left-4 w-5 h-5 border-t-2 border-l-2 border-amber-500/60 z-20"></div>
            <div class="absolute top-4 right-4 w-5 h-5 border-t-2 border-r-2 border-amber-500/60 z-20"></div>
            <div class="absolute bottom-4 left-4 w-5 h-5 border-b-2 border-l-2 border-amber-500/60 z-20"></div>
            <div class="absolute bottom-4 right-4 w-5 h-5 border-b-2 border-r-2 border-amber-500/60 z-20"></div>
            
            <div id="infrared" class="infrared-line"></div>
            <div id="reader" class="w-full bg-slate-900"></div>
        </div>

        <div id="result-box" class="p-4 rounded-xl hidden transition-all text-sm font-medium border text-center shadow-lg font-mono-tech"></div>
        
        <div class="mt-6 text-center border-t border-slate-800/60 pt-4">
            <p class="text-xs text-slate-600 font-semibold">@himsi_uaa Check-in System</p>
        </div>
    </div>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const resultBox = document.getElementById('result-box');
        const infraredLine = document.getElementById('infrared');
        let isScanning = true;

        function onScanSuccess(decodedText) {
            if (!isScanning) return; isScanning = false; 
            
            // Tahap 1: Mulai Scan & Highlight Barcode
            resultBox.className = "p-4 rounded-xl transition-all text-xs font-mono-tech border text-center shadow-lg mt-4 block bg-slate-950 border-amber-500/30 text-amber-400";
            resultBox.innerHTML = `<div class="flex items-center justify-center space-x-2"><span class="animate-spin block h-4 w-4 border-2 border-amber-500 border-t-transparent rounded-full"></span> <span>>> AMBIL DATA BARCODE [OK]</span></div>`;
            resultBox.style.display = 'block';
            infraredLine.style.display = 'block'; 

            // Kirim request ke server (proses berjalan di latar belakang)
            const fetchPromise = fetch('/scan-qr', { method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken }, body: JSON.stringify({ qr_token: decodedText }) })
            .then(res => res.json());

            // Tahap 2: Analisa Inframerah (Berjalan setelah 900ms)
            setTimeout(() => {
                resultBox.className = "p-4 rounded-xl transition-all text-xs font-mono-tech border text-center shadow-lg mt-4 block bg-slate-950 border-rose-500/30 text-rose-400";
                resultBox.innerHTML = `<div class="flex items-center justify-center space-x-2"><span class="animate-pulse block h-2 w-2 bg-rose-500 rounded-full"></span> <span>>> ANALISA RADIASI INFRAMERAH...</span></div>`;
            }, 900);

            // Tahap 3: Tampilkan Hasil Akhir dari Server (Berjalan setelah 2 detik)
            setTimeout(() => {
                fetchPromise.then(data => {
                    infraredLine.style.display = 'none'; // Matikan inframerah
                    
                    if (data.success) {
                        resultBox.className = "p-4 rounded-xl transition-all text-sm border text-center shadow-lg mt-4 block bg-emerald-500/10 border-emerald-500/30 text-emerald-400";
                        resultBox.innerHTML = `<div class="text-base font-bold mb-1">✅ ACCESS_GRANTED</div><div class="text-white font-bold text-base uppercase mt-1 tracking-wide">${data.data.nama}</div><div class="text-emerald-500/70 text-xs font-mono-tech mt-1">${data.data.nim}</div>`;
                    } else {
                        if (data.message.includes('sudah melakukan check-in')) {
                            resultBox.className = "p-4 rounded-xl transition-all text-sm border text-center shadow-lg mt-4 block bg-amber-500/10 border-amber-500/30 text-amber-400";
                            resultBox.innerHTML = `<div class="font-bold text-amber-500 text-base">⚠️ DUPLICATE_ENTRY</div><span class="text-slate-300 text-xs mt-1 block">${data.message}</span>`;
                        } else {
                            resultBox.className = "p-4 rounded-xl transition-all text-sm border text-center shadow-lg mt-4 block bg-rose-500/10 border-rose-500/30 text-rose-400";
                            resultBox.innerHTML = `<div class="font-bold text-rose-500 text-base">❌ ACCESS_DENIED</div><span class="text-slate-300 text-xs mt-1 block">${data.message}</span>`;
                        }
                    }
                    
                    // Jeda 3.5 detik sebelum siap scan peserta berikutnya
                    setTimeout(() => { resultBox.style.display = 'none'; isScanning = true; }, 3500);
                }).catch(err => { 
                    console.error(err); isScanning = true; infraredLine.style.display = 'none';
                    resultBox.style.display = 'none';
                });
            }, 2000);
        }
        
        new Html5QrcodeScanner("reader", { fps: 10, qrbox: {width: 250, height: 250} }, false).render(onScanSuccess);
    </script>
</body>
</html>