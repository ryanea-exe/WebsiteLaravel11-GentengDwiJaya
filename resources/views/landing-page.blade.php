<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $appSetting->app_name }} - Produsen genteng berkualitas tinggi, tahan lama, dan harga terjangkau di Indonesia.">
    <title>{{ $appSetting->app_name }} | Kualitas Terbaik untuk Rumah Anda</title>
    {{-- Favicon --}}
    @if($appSetting->app_logo)
    <link rel="icon" type="image/png" href="{{ asset($appSetting->app_logo) }}">
    @else
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23e11d48'><path d='M12 2L2 8v2h20V8L12 2zm-9 9v9h6v-5h6v5h6V11H3z'/></svg>">
    @endif
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] }
                }
            }
        }
    </script>
    <style>
        html { scroll-behavior: smooth; }
        body { font-family: 'Inter', sans-serif; }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #0f0f0f; }
        ::-webkit-scrollbar-thumb { background: #e11d48; border-radius: 3px; }
        #navbar { transition: background 0.4s, box-shadow 0.4s; }
        #navbar.scrolled { background: rgba(15,15,15,0.92); backdrop-filter: blur(18px); -webkit-backdrop-filter: blur(18px); box-shadow: 0 4px 30px rgba(225,29,72,0.15); }
        .text-gradient { background: linear-gradient(135deg, #e11d48 0%, #f97316 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .blob { background: linear-gradient(135deg, #e11d48 0%, #9f1239 60%, #f97316 100%); border-radius: 60% 40% 70% 30% / 50% 60% 40% 70%; animation: blobMove 8s ease-in-out infinite; }
        @keyframes blobMove { 0%,100% { border-radius: 60% 40% 70% 30% / 50% 60% 40% 70%; } 33% { border-radius: 40% 60% 30% 70% / 60% 40% 70% 50%; } 66% { border-radius: 70% 30% 60% 40% / 40% 70% 50% 60%; } }
        .card-hover { transition: transform 0.35s ease, box-shadow 0.35s ease; }
        .card-hover:hover { transform: translateY(-10px); box-shadow: 0 24px 60px rgba(225,29,72,0.18); }
        .particle { position: absolute; border-radius: 50%; animation: particleFloat linear infinite; opacity: 0.4; }
        @keyframes particleFloat { 0% { transform: translateY(0); opacity: 0; } 10% { opacity: 0.4; } 90% { opacity: 0.4; } 100% { transform: translateY(-600px) translateX(40px); opacity: 0; } }
        .reveal { opacity: 0; transform: translateY(40px); transition: opacity 0.8s ease, transform 0.8s ease; }
        .reveal.visible { opacity: 1; transform: translateY(0); }
        .btn-glow { background: linear-gradient(135deg, #e11d48, #9f1239); box-shadow: 0 0 20px rgba(225,29,72,0.4); transition: box-shadow 0.3s, transform 0.3s; }
        .btn-glow:hover { box-shadow: 0 0 35px rgba(225,29,72,0.7); transform: scale(1.05); }
        .glass { background: rgba(255,255,255,0.06); backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px); border: 1px solid rgba(255,255,255,0.10); }
        .hero-bg { background: radial-gradient(ellipse at 70% 50%, rgba(225,29,72,0.12) 0%, transparent 60%), radial-gradient(ellipse at 20% 80%, rgba(249,115,22,0.08) 0%, transparent 50%), #0a0a0a; }
        .product-img-wrap { overflow: hidden; }
        .product-img-wrap img { transition: transform 0.5s ease; }
        .product-img-wrap:hover img { transform: scale(1.08); }
        @keyframes floatBadge { 0%,100% { transform: translateY(0) rotate(-3deg); } 50% { transform: translateY(-10px) rotate(3deg); } }
        .floating-badge { animation: floatBadge 4s ease-in-out infinite; }
        @keyframes floatImg { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-18px); } }
        .float-img { animation: floatImg 6s ease-in-out infinite; }
        #mobile-menu { transition: max-height 0.3s ease; max-height: 0; overflow: hidden; }
        #mobile-menu.open { max-height: 300px; }
        @keyframes pingSlow { 0% { transform: scale(1); opacity: 0.4; } 100% { transform: scale(1.6); opacity: 0; } }
        .ping-slow { animation: pingSlow 3s ease-out infinite; }
    </style>
</head>
<body class="bg-[#0a0a0a] text-white overflow-x-hidden">

@if(session('success'))
<div id="toast-success" class="fixed top-24 right-6 z-[100] flex items-start gap-3 bg-green-950/80 backdrop-blur-lg border border-green-800/50 rounded-2xl px-5 py-3 shadow-xl transition-all duration-500 transform translate-x-0 opacity-100" role="alert">
    <svg class="w-5 h-5 text-green-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
    <p class="text-green-300 text-sm font-medium">{{ session('success') }}</p>
</div>
<script>
    setTimeout(() => {
        const toast = document.getElementById('toast-success');
        if(toast) {
            toast.classList.remove('translate-x-0', 'opacity-100');
            toast.classList.add('translate-x-full', 'opacity-0');
            setTimeout(() => toast.remove(), 500);
        }
    }, 5000);
</script>
@endif

<!-- NAVBAR -->
<nav id="navbar" class="fixed top-0 w-full z-50 py-4">
    <div class="container mx-auto px-6 flex items-center justify-between">
        <a href="#hero" class="flex items-center gap-3 group">
            <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-red-600 to-red-900 flex items-center justify-center shadow-lg overflow-hidden">
                @if($appSetting->app_logo)
                    <img src="{{ asset($appSetting->app_logo) }}" alt="Logo" class="w-full h-full object-cover">
                @else
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 8v2h20V8L12 2zm-9 9v9h6v-5h6v5h6V11H3z"/></svg>
                @endif
            </div>
            @php $lpParts = explode(' ', $appSetting->app_name, 2); @endphp
            <span class="text-lg font-bold tracking-tight">{{ $lpParts[0] }} @if(isset($lpParts[1]))<span class="text-gradient">{{ $lpParts[1] }}</span>@endif</span>
        </a>
        <div class="hidden md:flex items-center gap-8 text-sm text-gray-400">
            <a href="#hero"       class="hover:text-red-400 transition relative group">Home<span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-red-500 group-hover:w-full transition-all duration-300"></span></a>
            <a href="#keunggulan" class="hover:text-red-400 transition relative group">Keunggulan<span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-red-500 group-hover:w-full transition-all duration-300"></span></a>
            <a href="#produk"     class="hover:text-red-400 transition relative group">Produk<span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-red-500 group-hover:w-full transition-all duration-300"></span></a>
            <a href="#stats"      class="hover:text-red-400 transition relative group">Statistik<span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-red-500 group-hover:w-full transition-all duration-300"></span></a>
            <a href="#lokasi"     class="hover:text-red-400 transition relative group">Lokasi<span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-red-500 group-hover:w-full transition-all duration-300"></span></a>
        </div>
        <!-- <div class="flex items-center gap-4"> -->
            <!-- <a href="/login" class="btn-glow hidden md:inline-flex items-center gap-2 text-white text-sm font-semibold px-5 py-2.5 rounded-xl">Login</a> -->
            <button id="hamburger-btn" class="md:hidden flex flex-col gap-1.5 p-2" aria-label="Menu">
                <span class="w-6 h-0.5 bg-white block"></span>
                <span class="w-4 h-0.5 bg-red-500 block"></span>
                <span class="w-6 h-0.5 bg-white block"></span>
            </button>
        <!-- </div> -->
    </div>
    <div id="mobile-menu" class="md:hidden bg-black/90 backdrop-blur-lg border-t border-white/5">
        <div class="container mx-auto px-6 py-4 flex flex-col gap-4 text-sm">
            <a href="#hero"       class="text-gray-300 hover:text-red-400 transition">Home</a>
            <a href="#keunggulan" class="text-gray-300 hover:text-red-400 transition">Keunggulan</a>
            <a href="#produk"     class="text-gray-300 hover:text-red-400 transition">Produk</a>
            <a href="#stats"      class="text-gray-300 hover:text-red-400 transition">Statistik</a>
            <a href="#lokasi"     class="text-gray-300 hover:text-red-400 transition">Lokasi</a>
            <!-- <a href="/login" class="btn-glow text-center text-white font-semibold py-2.5 rounded-xl">Login</a> -->
        </div>
    </div>
</nav>

<!-- HERO -->
<section id="hero" class="hero-bg min-h-screen flex items-center relative overflow-hidden pt-24 pb-16">
    <div class="absolute inset-0 pointer-events-none" id="particles-container"></div>
    <div class="absolute inset-0 pointer-events-none opacity-5" style="background-image: linear-gradient(rgba(225,29,72,0.5) 1px, transparent 1px), linear-gradient(90deg, rgba(225,29,72,0.5) 1px, transparent 1px); background-size: 80px 80px;"></div>
    <div class="container mx-auto px-6 grid lg:grid-cols-2 items-center gap-16 relative z-10">
        <div>
            <div class="inline-flex items-center gap-2 bg-red-950/60 border border-red-800/40 rounded-full px-4 py-1.5 mb-8 text-xs font-medium text-red-400 reveal">
                <span class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>
                Genteng Unggulan Sejak Tahun 1998
            </div>
            <h1 class="text-4xl lg:text-6xl font-black leading-tight mb-6 reveal" style="transition-delay:0.1s">
                {!! $appSetting->mainheadline ?? 'Genteng Kuat,<br>Rumah <span class="text-gradient">Aman</span> &amp;<br><span class="text-gradient">Indah</span>' !!}
            </h1>
            <p class="text-gray-400 text-md leading-relaxed max-w-lg mb-10 reveal" style="transition-delay:0.2s">
                {{ $appSetting->subheadline ?? 'Genteng pilihan kualitas premium — tahan cuaca ekstrem, desain modern, harga bersaing, dan pastinya bergaransi. Dipercaya ribuan keluarga di seluruh Jawa & Bali.' }}
            </p>
            <div class="flex flex-wrap gap-4 mb-12 reveal" style="transition-delay:0.3s">
                <a href="#produk" class="btn-glow inline-flex items-center gap-2 text-white font-semibold px-7 py-3.5 rounded-2xl text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H7m6-7l7 7-7 7"/></svg>
                    Lihat Produk
                </a>
                <a href="#keunggulan" class="inline-flex items-center gap-2 border border-white/20 text-white font-semibold px-7 py-3.5 rounded-2xl text-sm hover:border-red-500 hover:bg-red-950/30 transition">
                    Keunggulan Kami
                </a>
            </div>
            <div class="flex gap-8 reveal" style="transition-delay:0.4s">
                <div><p class="text-2xl font-black text-gradient">25+</p><p class="text-xs text-gray-500 mt-1">Tahun Pengalaman</p></div>
                <div class="w-px bg-white/10"></div>
                <div><p class="text-2xl font-black text-gradient">1000+</p><p class="text-xs text-gray-500 mt-1">Pelanggan Puas</p></div>
                <div class="w-px bg-white/10"></div>
                <div><p class="text-2xl font-black text-gradient">20+</p><p class="text-xs text-gray-500 mt-1">Jenis Produk</p></div>
            </div>
        </div>
        <div class="relative flex justify-center items-center min-h-[480px]">
            <div class="blob absolute w-[350px] h-[350px] opacity-80"></div>
            <div class="absolute w-[400px] h-[400px] rounded-full border border-red-500/20 ping-slow"></div>
            <div class="absolute w-[460px] h-[460px] rounded-full border border-red-500/10"></div>
            <!-- <div class="floating-badge absolute -top-4 -left-4 glass rounded-2xl px-4 py-3 z-20 shadow-xl">
                <div class="flex items-center gap-2">
                    <span class="text-2xl">🏆</span>
                    <div><p class="font-bold text-white text-xs">Award Winner</p><p class="text-gray-400 text-xs">Best Quality 2024</p></div>
                </div>
            </div> -->
            <div class="absolute bottom-8 -right-4 glass rounded-2xl px-4 py-3 z-20 shadow-xl" style="animation: floatBadge 4s ease-in-out 2s infinite;">
                <div class="flex items-center gap-2">
                    <span class="text-2xl">⭐</span>
                    <div><p class="font-bold text-white text-xs">Rating 4.9/5</p><p class="text-gray-400 text-xs">Dari 200+ ulasan</p></div>
                </div>
            </div>
            <img src="https://cdn-icons-png.flaticon.com/512/619/619153.png" alt="Ilustrasi Rumah" class="relative z-10 w-[280px] lg:w-[340px] float-img" style="filter: drop-shadow(0 0 30px rgba(225,29,72,0.5));">
        </div>
    </div>
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-gray-600 text-xs">
        <span>Scroll</span>
        <div class="w-0.5 h-10 bg-gradient-to-b from-red-600 to-transparent animate-pulse"></div>
    </div>
</section>

<!-- KEUNGGULAN -->
<section id="keunggulan" class="py-28 bg-[#0f0f0f] relative overflow-hidden">
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-96 h-1 bg-gradient-to-r from-transparent via-red-600 to-transparent"></div>
    <div class="container mx-auto px-6">
        <div class="text-center mb-16 reveal">
            <span class="text-red-500 text-xs font-semibold uppercase tracking-widest">Mengapa Memilih Kami</span>
            <h2 class="text-4xl lg:text-5xl font-black mt-3 mb-4">Keunggulan <span class="text-gradient">Kami</span></h2>
            <p class="text-gray-500 max-w-xl mx-auto">Kami berkomitmen menghadirkan genteng terbaik dengan standar kualitas internasional dan layanan yang memuaskan.</p>
        </div>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="glass rounded-3xl p-8 card-hover reveal group" style="transition-delay:0.1s">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-red-600 to-red-900 flex items-center justify-center mb-6 group-hover:scale-110 transition shadow-lg">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="text-xl font-bold mb-3">Kualitas Terjamin</h3>
                <p class="text-gray-500 leading-relaxed text-sm">Setiap genteng melewati uji kualitas ketat dengan standar SNI dan pengujian ketahanan cuaca ekstra.</p>
                <div class="mt-6 flex items-center gap-2 text-red-500 text-sm font-semibold group-hover:gap-4 transition-all">
                    <span>Pelajari lebih lanjut</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </div>
            </div>
            <div class="rounded-3xl p-8 card-hover reveal relative overflow-hidden group" style="transition-delay:0.2s; background: linear-gradient(135deg, #9f1239, #e11d48, #f97316);">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2"></div>
                <div class="w-14 h-14 rounded-2xl bg-white/20 flex items-center justify-center mb-6 group-hover:scale-110 transition shadow-lg">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
                <h3 class="text-xl font-bold mb-3 text-white">Tahan Cuaca Ekstrem</h3>
                <p class="text-white/80 leading-relaxed text-sm">Dirancang khusus untuk iklim tropis Indonesia — tahan panas terik, hujan lebat, dan angin kencang.</p>
                <div class="mt-6 flex items-center gap-2 text-white text-sm font-semibold group-hover:gap-4 transition-all">
                    <span>Pelajari lebih lanjut</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </div>
            </div>
            <div class="glass rounded-3xl p-8 card-hover reveal group" style="transition-delay:0.3s">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-red-600 to-red-900 flex items-center justify-center mb-6 group-hover:scale-110 transition shadow-lg">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="text-xl font-bold mb-3">Harga Kompetitif</h3>
                <p class="text-gray-500 leading-relaxed text-sm">Kualitas premium tidak harus mahal. Kami menawarkan harga terbaik langsung dari produsen tanpa perantara.</p>
                <div class="mt-6 flex items-center gap-2 text-red-500 text-sm font-semibold group-hover:gap-4 transition-all">
                    <span>Pelajari lebih lanjut</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-8">
            <div class="glass rounded-2xl px-5 py-4 flex items-center gap-3 reveal card-hover"><span class="text-2xl">🔧</span><span class="text-sm font-medium text-gray-300">Pemasangan Profesional</span></div>
            <div class="glass rounded-2xl px-5 py-4 flex items-center gap-3 reveal card-hover" style="transition-delay:0.1s"><span class="text-2xl">🚚</span><span class="text-sm font-medium text-gray-300">Pengiriman Cepat</span></div>
            <div class="glass rounded-2xl px-5 py-4 flex items-center gap-3 reveal card-hover" style="transition-delay:0.2s"><span class="text-2xl">📞</span><span class="text-sm font-medium text-gray-300">Garansi 10 Tahun</span></div>
            <div class="glass rounded-2xl px-5 py-4 flex items-center gap-3 reveal card-hover" style="transition-delay:0.3s"><span class="text-2xl">🌿</span><span class="text-sm font-medium text-gray-300">Ramah Lingkungan</span></div>
        </div>
    </div>
</section>

<!-- PRODUK -->
<section id="produk" class="py-28 bg-[#0a0a0a] relative overflow-hidden">
    <div class="absolute right-0 top-20 w-64 h-64 bg-red-950/30 rounded-full blur-3xl pointer-events-none"></div>
    <div class="container mx-auto px-6">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between mb-16 reveal gap-4">
            <div>
                <span class="text-red-500 text-xs font-semibold uppercase tracking-widest">Koleksi Kami</span>
                <h2 class="text-4xl lg:text-5xl font-black mt-3">Produk <span class="text-gradient">Unggulan</span></h2>
            </div>
            <p class="text-gray-500 max-w-xs text-sm md:text-right">Berikut adalah 4 produk genteng unggulan dan favorit pilihan pelanggan kami.</p>
        </div>
        <div class="grid md:grid-cols-4 gap-8">
            @forelse($genteng as $index => $item)
            <div class="glass rounded-3xl overflow-hidden card-hover reveal" style="transition-delay:{{ 0.1 * ($index + 1) }}s">
                <div class="product-img-wrap h-52">
                    @php
                        $words = explode(' ', trim($item->nama));
                        $inisial = count($words) >= 2
                            ? substr($words[0], 0, 1) . substr($words[1], 0, 1)
                            : substr($words[0], 0, 2);
                    @endphp
                    @if($item->foto)
                        <img src="{{ asset('uploads/genteng/' . $item->foto) }}" alt="{{ $item->nama }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-5xl font-bold text-white tracking-widest"
                             style="background: linear-gradient(135deg,rgba(225,29,72,0.6),rgba(159,18,57,0.9));">
                            {{ strtoupper($inisial) }}
                        </div>
                    @endif
                </div>
                <div class="p-6">
                    <div class="flex items-start justify-between mb-3">
                        <div>
                            <h3 class="font-bold text-lg text-white">{{ $item->nama }}</h3>
                            <p class="text-gray-500 text-sm mt-1 truncate max-w-[150px]">{{ $item->jenis ?? 'Umum' }}</p>
                        </div>
                        <span class="bg-red-950/60 text-red-400 text-xs font-semibold px-3 py-1 rounded-full border border-red-800/30 whitespace-nowrap">
                            Rp {{ number_format($item->harga, 0, ',', '.') }}
                        </span>
                    </div>
                    <div class="mb-4">
                        <p class="text-gray-400 text-xs line-clamp-2 min-h-[32px]">{{ $item->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                    </div>
                    <a href="#" class="flex items-center justify-between text-red-400 text-sm font-semibold group mt-4">
                        <span>Detail Produk</span>
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-10">
                <p class="text-gray-500">Belum ada data produk genteng unggulan/favorit.</p>
            </div>
            @endforelse
        </div>
        
        <div class="mt-12 text-center reveal">
            <a href="{{ route('daftar-genteng') }}" class="btn-glow inline-flex items-center gap-2 text-white font-semibold px-8 py-3.5 rounded-2xl text-sm">
                Lihat Daftar Genteng Lengkap
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- STATS -->
<section id="stats" class="py-24 relative overflow-hidden" style="background: linear-gradient(135deg, #9f1239 0%, #e11d48 50%, #f97316 100%);">
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 30px 30px;"></div>
    <div class="container mx-auto px-6 relative z-10">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div class="reveal"><p class="text-5xl font-black text-white counter" data-target="25">0</p><p class="text-white/70 mt-2 text-sm font-medium">Tahun Berdiri</p></div>
            <div class="reveal" style="transition-delay:0.1s"><p class="text-5xl font-black text-white counter" data-target="1000">0</p><p class="text-white/70 mt-2 text-sm font-medium">Pelanggan Puas</p></div>
            <div class="reveal" style="transition-delay:0.2s"><p class="text-5xl font-black text-white counter" data-target="20">0</p><p class="text-white/70 mt-2 text-sm font-medium">Jenis Produk</p></div>
            <div class="reveal" style="transition-delay:0.3s"><p class="text-5xl font-black text-white counter" data-target="99">0</p><p class="text-white/70 mt-2 text-sm font-medium">% Kepuasan</p></div>
        </div>
    </div>
</section>

<!-- TESTIMONI -->
<section id="testimoni" class="py-28 bg-[#0f0f0f]">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16 reveal">
            <span class="text-red-500 text-xs font-semibold uppercase tracking-widest">Kata Pelanggan</span>
            <h2 class="text-4xl lg:text-5xl font-black mt-3">Apa Kata <span class="text-gradient">Mereka?</span></h2>
        </div>
        <div class="grid md:grid-cols-3 gap-6">
            <div class="glass rounded-3xl p-7 card-hover reveal">
                <div class="text-red-500 text-3xl font-serif leading-none mb-4">"</div>
                <p class="text-gray-300 text-sm leading-relaxed mb-6">Genteng Dwijaya sudah menjadi pilihan utama proyek saya selama 5 tahun. Kualitasnya tidak perlu diragukan lagi!</p>
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-red-600 to-red-900 flex items-center justify-center text-white font-bold text-sm">B</div>
                        <div><p class="font-semibold text-sm text-white">Budi Santoso</p><p class="text-gray-500 text-xs">Kontraktor Surabaya</p></div>
                    </div>
                    <span class="text-yellow-500 text-xs">★★★★★</span>
                </div>
            </div>
            <div class="glass rounded-3xl p-7 card-hover reveal" style="transition-delay:0.15s">
                <div class="text-red-500 text-3xl font-serif leading-none mb-4">"</div>
                <p class="text-gray-300 text-sm leading-relaxed mb-6">Sangat puas! Pemasangan profesional dan hasilnya rapi. Rumah jadi makin cantik dengan genteng pilihan ini.</p>
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-red-600 to-red-900 flex items-center justify-center text-white font-bold text-sm">S</div>
                        <div><p class="font-semibold text-sm text-white">Siti Rahayu</p><p class="text-gray-500 text-xs">Pemilik Rumah, Jakarta</p></div>
                    </div>
                    <span class="text-yellow-500 text-xs">★★★★★</span>
                </div>
            </div>
            <div class="glass rounded-3xl p-7 card-hover reveal" style="transition-delay:0.3s">
                <div class="text-red-500 text-3xl font-serif leading-none mb-4">"</div>
                <p class="text-gray-300 text-sm leading-relaxed mb-6">Harga bersaing, kualitas terjamin. Supplier terpercaya untuk semua proyek perumahan kami di Jawa Timur.</p>
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-red-600 to-red-900 flex items-center justify-center text-white font-bold text-sm">A</div>
                        <div><p class="font-semibold text-sm text-white">Ahmad Fauzi</p><p class="text-gray-500 text-xs">Developer Properti</p></div>
                    </div>
                    <span class="text-yellow-500 text-xs">★★★★★</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- LOKASI -->
<section id="lokasi" class="py-28 bg-[#0a0a0a]">
    <div class="container mx-auto px-6">
        <div class="text-center mb-14 reveal">
            <span class="text-red-500 text-xs font-semibold uppercase tracking-widest">Temukan Kami</span>
            <h2 class="text-4xl lg:text-5xl font-black mt-3">Lokasi <span class="text-gradient">Kami</span></h2>
            <p class="text-gray-500 mt-4 text-sm">Kunjungi lokasi kami untuk pengalaman langsung melihat produk unggulan kami.</p>
        </div>
        <div class="grid lg:grid-cols-3 gap-8 items-start">
            <div class="space-y-5 reveal">
                <div class="glass rounded-2xl p-5 flex gap-4 items-start card-hover">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-red-600 to-red-900 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div><p class="font-semibold text-white text-sm mb-1">Alamat</p><p class="text-gray-400 text-sm">Jl. Ahmad Yani, RT 3 RW 2<br>Bedingin Sambit Ponorogo</p></div>
                </div>
                <div class="glass rounded-2xl p-5 flex gap-4 items-start card-hover">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-red-600 to-red-900 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div><p class="font-semibold text-white text-sm mb-1">Jam Operasional</p><p class="text-gray-400 text-sm">Buka 24 Jam<br>Setiap Hari</p></div>
                </div>
                <div class="glass rounded-2xl p-5 flex gap-4 items-start card-hover">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-red-600 to-red-900 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    </div>
                    <div><p class="font-semibold text-white text-sm mb-1">Kontak</p><p class="text-gray-400 text-sm">+62 852-3543-0936<br>+62 857-3210-6401</p></div>
                </div>
            </div>
            <div class="lg:col-span-2 reveal glass rounded-3xl overflow-hidden" style="height: 360px; transition-delay:0.2s">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4002.6536453575686!2d111.48838777506573!3d-7.977684092047476!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e790be447d2027d%3A0x8d2227b20e3323f9!2sPABRIK%20GENTENG%20DWIJAYA%20PONOROGO!5e1!3m2!1sid!2sid!4v1785883810528!5m2!1sid!2sid" class="w-full h-full border-0" loading="lazy" title="Lokasi {{ $appSetting->app_name }}"></iframe>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-24 bg-[#0f0f0f] relative overflow-hidden">
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute left-1/4 top-0 w-96 h-96 bg-red-700/20 rounded-full blur-3xl"></div>
        <div class="absolute right-1/4 bottom-0 w-64 h-64 bg-orange-600/10 rounded-full blur-3xl"></div>
    </div>
    <div class="container mx-auto px-6 text-center relative z-10 reveal">
        <span class="text-red-500 text-xs font-semibold uppercase tracking-widest">Mulai Sekarang</span>
        <h2 class="text-4xl lg:text-5xl font-black mt-4 mb-6">Butuh Genteng <span class="text-gradient">Berkualitas?</span></h2>
        <p class="text-gray-500 max-w-lg mx-auto mb-10 text-sm">Konsultasikan kebutuhan Anda dengan tim ahli kami secara gratis. Dapatkan penawaran terbaik hari ini!</p>
        <div class="flex flex-wrap gap-4 justify-center">
            <a href="https://wa.me/6281234567890" class="btn-glow inline-flex items-center gap-2 text-white font-semibold px-8 py-4 rounded-2xl text-sm">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                Hubungi via WhatsApp
            </a>
            <a href="#produk" class="inline-flex items-center gap-2 border border-white/20 text-white font-semibold px-8 py-4 rounded-2xl text-sm hover:border-red-500 hover:bg-red-950/30 transition">
                Lihat Produk Kami
            </a>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="bg-[#050505] border-t border-white/5 py-12">
    <div class="container mx-auto px-6">
        <div class="grid md:grid-cols-3 gap-10 mb-10">
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-red-600 to-red-900 flex items-center justify-center shadow-lg overflow-hidden">
                        @if($appSetting->app_logo)
                            <img src="{{ asset($appSetting->app_logo) }}" alt="Logo" class="w-full h-full object-cover">
                        @else
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 8v2h20V8L12 2zm-9 9v9h6v-5h6v5h6V11H3z"/></svg>
                        @endif
                    </div>
                    @php $fpParts = explode(' ', $appSetting->app_name, 2); @endphp
                    <span class="text-lg font-bold">{{ $fpParts[0] }} @if(isset($fpParts[1]))<span class="text-gradient">{{ $fpParts[1] }}</span>@endif</span>
                </div>
                <p class="text-gray-600 text-sm leading-relaxed">Produsen genteng berkualitas tinggi sejak tahun 1998. Melayani seluruh wilayah Jawa & Bali.</p>
            </div>
            <div>
                <p class="font-semibold text-white mb-4 text-sm">Navigasi</p>
                <div class="space-y-2">
                    <a href="#hero"       class="block text-gray-600 hover:text-red-400 transition text-sm">Home</a>
                    <a href="#keunggulan" class="block text-gray-600 hover:text-red-400 transition text-sm">Keunggulan</a>
                    <a href="#produk"     class="block text-gray-600 hover:text-red-400 transition text-sm">Produk</a>
                    <a href="#lokasi"     class="block text-gray-600 hover:text-red-400 transition text-sm">Lokasi</a>
                </div>
            </div>
            <div>
                <p class="font-semibold text-white mb-4 text-sm">Ikuti Kami</p>
                <div class="flex gap-3">
                    <a href="https://wa.me/6285235430936" target="_blank" rel="noopener noreferrer" class="w-9 h-9 glass rounded-lg flex items-center justify-center text-gray-500 hover:text-red-400 transition" aria-label="WhatsApp">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    </a>
                    <a href="https://www.tiktok.com/@pg.dwijaya" target="_blank" rel="noopener noreferrer" class="w-9 h-9 glass rounded-lg flex items-center justify-center text-gray-500 hover:text-red-400 transition" aria-label="TikTok">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.04.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 2.23-.9 4.4-2.42 5.92-1.48 1.48-3.5 2.32-5.59 2.44-2.52.14-5.04-.75-6.84-2.47-1.7-1.62-2.58-3.93-2.48-6.26.11-2.49 1.34-4.78 3.32-6.15 1.83-1.27 4.1-1.65 6.22-1.07v4.02c-1.15-.31-2.4-.2-3.42.39-.8.47-1.39 1.19-1.67 2.05-.28.85-.22 1.82.16 2.62.4.83 1.14 1.45 2.01 1.7.9.26 1.9.15 2.7-.31.84-.48 1.41-1.31 1.6-2.27.08-.43.1-.88.1-1.32V.02z"/></svg>
                    </a>
                    <a href="https://www.facebook.com/profile.php?id=100063830661048" target="_blank" rel="noopener noreferrer" class="w-9 h-9 glass rounded-lg flex items-center justify-center text-gray-500 hover:text-red-400 transition" aria-label="Facebook">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="https://www.instagram.com/pg.dwijaya" target="_blank" rel="noopener noreferrer" class="w-9 h-9 glass rounded-lg flex items-center justify-center text-gray-500 hover:text-red-400 transition" aria-label="Instagram">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"/></svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="border-t border-white/5 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-gray-700 text-xs">&copy; {{ date('Y') }} {{ $appSetting->app_name }}. All rights reserved.</p>
            <div class="flex gap-6 text-xs text-gray-700">
                <a href="#" class="hover:text-red-400 transition">Kebijakan Privasi</a>
                <a href="#" class="hover:text-red-400 transition">Syarat &amp; Ketentuan</a>
            </div>
        </div>
    </div>
</footer>

<script>
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', () => navbar.classList.toggle('scrolled', window.scrollY > 60));

    const hamburgerBtn = document.getElementById('hamburger-btn');
    const mobileMenu   = document.getElementById('mobile-menu');
    hamburgerBtn.addEventListener('click', () => mobileMenu.classList.toggle('open'));
    document.querySelectorAll('#mobile-menu a').forEach(link => link.addEventListener('click', () => mobileMenu.classList.remove('open')));

    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => { if (entry.isIntersecting) entry.target.classList.add('visible'); });
    }, { threshold: 0.12 });
    document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));

    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (!entry.isIntersecting) return;
            const el = entry.target;
            const target = parseInt(el.dataset.target);
            const isK = target >= 1000;
            const isPct = target === 99;
            const dispVal = isK ? Math.round(target / 1000) : target;
            const suffix = isK ? 'K+' : isPct ? '%' : '+';
            let current = 0;
            const step = Math.ceil(dispVal / 60);
            const timer = setInterval(() => {
                current += step;
                if (current >= dispVal) { current = dispVal; clearInterval(timer); }
                el.textContent = current + suffix;
            }, 30);
            counterObserver.unobserve(el);
        });
    }, { threshold: 0.5 });
    document.querySelectorAll('.counter').forEach(el => counterObserver.observe(el));

    const container = document.getElementById('particles-container');
    if (container) {
        const colors = ['#e11d48','#f97316','#fda4af','#fb7185'];
        for (let i = 0; i < 22; i++) {
            const dot = document.createElement('div');
            const size = Math.random() * 5 + 2;
            dot.classList.add('particle');
            dot.style.cssText = 'left:' + Math.random() * 100 + '%;bottom:' + Math.random() * 20 + '%;width:' + size + 'px;height:' + size + 'px;background:' + colors[Math.floor(Math.random() * colors.length)] + ';animation-duration:' + (Math.random() * 8 + 6) + 's;animation-delay:' + Math.random() * 6 + 's';
            container.appendChild(dot);
        }
    }
</script>
</body>
</html>
