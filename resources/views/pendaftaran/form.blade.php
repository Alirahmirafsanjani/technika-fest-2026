<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - TechNika Fest 2026</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: #030712;
            background-image: radial-gradient(rgba(245, 158, 11, 0.04) 1px, transparent 1px),
                              radial-gradient(rgba(6, 182, 212, 0.04) 1px, transparent 1px);
            background-size: 24px 24px;
            background-position: 0 0, 12px 12px;
        }
        .font-mono-tech { font-family: 'JetBrains Mono', monospace; }
        .glass-panel {
            background: rgba(17, 24, 39, 0.7);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 relative overflow-x-hidden">
    
    <div class="hidden lg:block absolute left-8 top-12 w-64 text-slate-600 font-mono-tech text-[11px] space-y-6 select-none opacity-40">
        <div class="border-l-2 border-amber-500 pl-3 space-y-1">
            <p class="text-amber-500 font-bold">// SYSTEM_ACTIVE</p>
            <p>NODE: ALMA_ATA_MAIN_NET</p>
            <p>CORE_LOAD: 24.2% [OK]</p>
            <p>LATENCY: 14ms</p>
        </div>
        <div>
            <svg width="180" height="60" viewBox="0 0 180 60" fill="none" stroke="currentColor" stroke-width="0.7">
                <path d="M0 30 Q30 0 60 30 T120 30 T180 30" stroke-dasharray="2 2"/>
                <line x1="0" y1="10" x2="180" y2="10" opacity="0.3"/>
                <line x1="0" y1="50" x2="180" y2="50" opacity="0.3"/>
            </svg>
            <p class="mt-1 text-[10px] tracking-widest text-slate-500">SIGNAL_WAVEFORM_MONITOR</p>
        </div>
        <div class="space-y-1 text-slate-500">
            <p>> STACK: LARAVEL_11.x</p>
            <p>> SEC_MODULE: ENABLED</p>
            <p>> AUTH_GATE: LOGIKASIBER</p>
        </div>
    </div>

    <div class="hidden lg:block absolute right-8 bottom-12 w-72 text-slate-600 font-mono-tech text-[11px] space-y-6 select-none opacity-40">
        <div class="text-right space-y-1 border-r-2 border-cyan-500 pr-3">
            <p class="text-cyan-400 font-bold">// SECURITY_ENFORCED</p>
            <p class="text-slate-500">PACKET_INJECTION: BLOCKED</p>
            <p>ISO_27001_COMPLIANT</p>
        </div>
        <div class="flex justify-end">
            <svg width="140" height="140" viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="0.5">
                <rect x="5" y="5" width="90" height="90" stroke-dasharray="4 4" />
                <circle cx="50" cy="50" r="35" />
                <circle cx="50" cy="50" r="5" fill="currentColor" class="animate-ping" style="animation-duration: 3s;" />
                <path d="M10 50 H90 M50 10 V90" opacity="0.5"/>
            </svg>
        </div>
        <p class="text-right font-mono-tech text-[10px] tracking-wider text-slate-500">RADAR_TARGET_GRID_v4.2</p>
    </div>

    <div class="absolute top-[-20%] left-[-10%] w-[600px] h-[600px] bg-orange-600/10 rounded-full blur-[140px] pointer-events-none"></div>
    <div class="absolute bottom-[-20%] right-[-10%] w-[600px] h-[600px] bg-cyan-600/10 rounded-full blur-[140px] pointer-events-none"></div>

    <div class="relative w-full max-w-md glass-panel p-6 sm:p-8 rounded-3xl shadow-2xl z-10 transition-all border border-slate-800">
        
        <div class="text-center mb-6 sm:mb-8">
            <h1 class="text-2xl sm:text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-orange-500 tracking-tight">
                TechNika Fest 2026
            </h1>
            <p class="text-slate-400 text-xs sm:text-sm mt-1.5 font-medium tracking-wide">Form pendaftaran seminar CyberSecurity</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-500/10 border border-red-500/20 text-red-400 p-4 rounded-xl mb-6 text-sm flex items-start">
                <svg class="w-5 h-5 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <ul class="list-none space-y-1">
                    @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pendaftaran.store') }}" method="POST" class="space-y-4 sm:space-y-5">
            @csrf
            
            <div>
                <label class="block text-slate-300 text-xs font-semibold mb-2 uppercase tracking-wider">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="w-full bg-slate-900/60 border border-slate-700 text-white px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500/40 focus:border-amber-500 transition-all placeholder-slate-600 text-sm" placeholder="John Doe" required>
            </div>

            <div>
                <label class="block text-slate-300 text-xs font-semibold mb-2 uppercase tracking-wider">NIM/NISN/No Hp</label>
                <input type="text" name="nim" class="w-full bg-slate-900/60 border border-slate-700 text-white px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500/40 focus:border-amber-500 transition-all placeholder-slate-600 text-sm" placeholder="Masukkan ID identitas..." required>
            </div>

            <div>
                <label class="block text-slate-300 text-xs font-semibold mb-2 uppercase tracking-wider">Afiliasi</label>
                <input type="text" name="asal_instansi" class="w-full bg-slate-900/60 border border-slate-700 text-white px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500/40 focus:border-amber-500 transition-all placeholder-slate-600 text-sm" placeholder="Universitas / Sekolah / Umum" required>
            </div>

            <div class="pb-2">
                <label class="block text-slate-300 text-xs font-semibold mb-2 uppercase tracking-wider">Harapan Seminar</label>
                <textarea name="harapan_seminar" rows="2" class="w-full bg-slate-900/60 border border-slate-700 text-white px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500/40 focus:border-amber-500 transition-all placeholder-slate-600 text-sm" placeholder="Apa yang ingin kamu pelajari?"></textarea>
            </div>

            <button type="submit" class="w-full bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-400 hover:to-orange-500 text-white font-bold py-3.5 px-4 rounded-xl shadow-[0_0_20px_rgba(245,158,11,0.25)] transition-all transform hover:-translate-y-0.5 font-mono-tech tracking-wide text-sm">
                >> INITIALIZE_SECURE_TICKET
            </button>
        </form>

        <div class="mt-6 sm:mt-8 text-center border-t border-slate-800/60 pt-5">
            <p class="text-[11px] text-slate-500 font-mono-tech tracking-wider">Organized by Program Studi SI &bull; <span class="text-slate-400 font-bold">@himsi_uaa</span></p>
        </div>
    </div>
</body>
</html>