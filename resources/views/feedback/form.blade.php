<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Sertifikat - TechNika Fest</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: #020617; 
            background-image: radial-gradient(rgba(255, 255, 255, 0.05) 1px, transparent 1px);
            background-size: 24px 24px;
        }
        .font-mono-tech { font-family: 'JetBrains Mono', monospace; }
        .glass-panel { background: rgba(15, 23, 42, 0.7); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.06); }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 relative overflow-hidden">
    
    <div class="hidden lg:block absolute left-12 top-1/4 text-slate-800 opacity-40 pointer-events-none font-mono-tech text-[10px] space-y-4">
        <svg width="120" height="120" viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="0.5">
            <rect x="15" y="15" width="70" height="70" stroke-dasharray="1 3"/>
            <path d="M50 0 V100 M0 50 H100"/>
        </svg>
        <p class="tracking-widest">// CRITERIA_CHECK: TRUE</p>
    </div>
    <div class="hidden lg:block absolute right-12 bottom-1/4 text-slate-800 opacity-40 pointer-events-none font-mono-tech text-[10px] text-right space-y-4">
        <svg width="120" height="120" viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="0.5">
            <circle cx="50" cy="50" r="40" />
            <path d="M15 15 L85 85 M85 15 L15 85" stroke-dasharray="2 2" />
        </svg>
        <p class="tracking-widest">// EXTRACTION_PORTAL</p>
    </div>

    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-indigo-600/10 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="relative w-full max-w-lg glass-panel p-6 sm:p-8 rounded-3xl shadow-2xl z-10">
        
        <div class="text-center mb-6 border-b border-slate-700/50 pb-5">
            <div class="w-12 h-12 bg-indigo-500/10 text-indigo-400 rounded-2xl flex items-center justify-center mx-auto mb-3 border border-indigo-500/20">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
            </div>
            <h2 class="text-xl sm:text-2xl font-bold text-white tracking-tight">Klaim E-Sertifikat</h2>
            <p class="text-slate-400 text-xs sm:text-sm mt-1.5">Bantu kami mengevaluasi TechNika Fest 2026</p>
        </div>

        @if ($errors->any())
            <div class="bg-rose-500/10 border-l-4 border-rose-500 p-4 mb-6 rounded-r-xl">
                <p class="text-rose-400 text-sm font-semibold mb-1">Akses Ditolak</p>
                <ul class="text-rose-400/80 text-xs list-disc list-inside">
                    @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('feedback.store') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-slate-300 text-xs font-semibold mb-2 uppercase tracking-wide">NIM/NISN/No Hp</label>
                <input type="text" name="nim" class="w-full bg-slate-900/60 border border-slate-700 text-white px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/40 focus:border-indigo-500 transition-all placeholder-slate-600 text-sm" placeholder="Masukkan ID terdaftar..." required>
            </div>
            <div>
                <label class="block text-slate-300 text-xs font-semibold mb-3 uppercase tracking-wide">Rating Materi UI/UX & Poster</label>
                <div class="flex justify-between items-center bg-slate-900/60 p-3 rounded-xl border border-slate-700">
                    @for ($i = 1; $i <= 5; $i++)
                        <label class="flex flex-col items-center cursor-pointer group">
                            <input type="radio" name="rating_kegiatan" value="{{ $i }}" class="w-5 h-5 text-indigo-500 bg-slate-800 border-slate-600 focus:ring-indigo-500 focus:ring-offset-slate-900 mb-2 transition-all" {{ $i==5 ? 'required' : '' }}>
                            <span class="text-xs text-slate-500 group-hover:text-indigo-400 transition-colors">{{ $i }}</span>
                        </label>
                    @endfor
                </div>
            </div>
            <div class="pb-2">
                <label class="block text-slate-300 text-xs font-semibold mb-2 uppercase tracking-wide">Kritik & Saran</label>
                <textarea name="komentar" rows="3" class="w-full bg-slate-900/60 border border-slate-700 text-white px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/40 focus:border-indigo-500 transition-all placeholder-slate-600 text-sm" placeholder="Tuliskan masukanmu..."></textarea>
            </div>
            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-3.5 px-4 rounded-xl shadow-[0_0_20px_rgba(79,70,229,0.25)] transition-all transform hover:-translate-y-0.5 text-sm font-mono-tech">
                >> EXTRACT_E_CERTIFICATE
            </button>
        </form>
        <div class="mt-6 sm:mt-8 text-center border-t border-slate-800/60 pt-5">
            <p class="text-xs text-slate-500">Organized by <span class="text-slate-400 font-semibold">@himsi_uaa</span></p>
        </div>
    </div>
</body>
</html>