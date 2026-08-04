<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $appSetting->app_name }} - Daftar lengkap genteng berkualitas tinggi, tahan lama, dan harga terjangkau.">
    <title>{{ $appSetting->app_name }} | Daftar Genteng Lengkap</title>
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
        .card-hover { transition: transform 0.35s ease, box-shadow 0.35s ease; }
        .card-hover:hover { transform: translateY(-10px); box-shadow: 0 24px 60px rgba(225,29,72,0.18); }
        .reveal { opacity: 0; transform: translateY(40px); transition: opacity 0.8s ease, transform 0.8s ease; }
        .reveal.visible { opacity: 1; transform: translateY(0); }
        .btn-glow { background: linear-gradient(135deg, #e11d48, #9f1239); box-shadow: 0 0 20px rgba(225,29,72,0.4); transition: box-shadow 0.3s, transform 0.3s; }
        .btn-glow:hover { box-shadow: 0 0 35px rgba(225,29,72,0.7); transform: scale(1.05); }
        .glass { background: rgba(255,255,255,0.06); backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px); border: 1px solid rgba(255,255,255,0.10); }
        .product-img-wrap { overflow: hidden; }
        .product-img-wrap img { transition: transform 0.5s ease; }
        .product-img-wrap:hover img { transform: scale(1.08); }
        #mobile-menu { transition: max-height 0.3s ease; max-height: 0; overflow: hidden; }
        #mobile-menu.open { max-height: 300px; }
    </style>
</head>
<body class="bg-[#0a0a0a] text-white overflow-x-hidden">

<!-- NAVBAR -->
<nav id="navbar" class="fixed top-0 w-full z-50 py-4 bg-[#0f0f0f]/90 backdrop-blur-lg border-b border-white/5">
    <div class="container mx-auto px-6 flex items-center justify-between">
        <a href="{{ route('home') }}" class="flex items-center gap-3 group">
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
            <a href="{{ route('home') }}" class="hover:text-red-400 transition relative group">Home<span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-red-500 group-hover:w-full transition-all duration-300"></span></a>
            <a href="{{ route('home') }}#keunggulan" class="hover:text-red-400 transition relative group">Keunggulan<span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-red-500 group-hover:w-full transition-all duration-300"></span></a>
            <a href="{{ route('home') }}#produk" class="hover:text-red-400 transition relative group">Produk<span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-red-500 group-hover:w-full transition-all duration-300"></span></a>
            <a href="{{ route('home') }}#stats" class="hover:text-red-400 transition relative group">Statistik<span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-red-500 group-hover:w-full transition-all duration-300"></span></a>
            <a href="{{ route('home') }}#lokasi" class="hover:text-red-400 transition relative group">Lokasi<span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-red-500 group-hover:w-full transition-all duration-300"></span></a>
        </div>
        <button id="hamburger-btn" class="md:hidden flex flex-col gap-1.5 p-2" aria-label="Menu">
            <span class="w-6 h-0.5 bg-white block"></span>
            <span class="w-4 h-0.5 bg-red-500 block"></span>
            <span class="w-6 h-0.5 bg-white block"></span>
        </button>
    </div>
    <div id="mobile-menu" class="md:hidden bg-black/90 backdrop-blur-lg border-t border-white/5 mt-4">
        <div class="container mx-auto px-6 py-4 flex flex-col gap-4 text-sm">
            <a href="{{ route('home') }}"       class="text-gray-300 hover:text-red-400 transition">Home</a>
            <a href="{{ route('home') }}#keunggulan" class="text-gray-300 hover:text-red-400 transition">Keunggulan</a>
            <a href="{{ route('home') }}#produk"     class="text-gray-300 hover:text-red-400 transition">Produk</a>
            <a href="{{ route('home') }}#stats"      class="text-gray-300 hover:text-red-400 transition">Statistik</a>
            <a href="{{ route('home') }}#lokasi"     class="text-gray-300 hover:text-red-400 transition">Lokasi</a>
        </div>
    </div>
</nav>

<!-- MAIN CONTENT -->
<section id="produk-katalog" class="pt-36 pb-28 bg-[#0a0a0a] min-h-screen relative overflow-hidden">
    <div class="absolute left-0 top-40 w-72 h-72 bg-red-950/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="container mx-auto px-6">
        
        <div class="mb-12 reveal">
            <a href="{{ route('home') }}#produk" class="inline-flex items-center gap-2 text-gray-500 hover:text-red-400 transition mb-4 text-sm font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-black">Katalog <span class="text-gradient">Genteng</span> Lengkap</h1>
            <p class="text-gray-400 mt-3 max-w-xl text-sm leading-relaxed">Lihat seluruh koleksi genteng kami. Kualitas terbaik untuk berbagai macam gaya hunian, dijamin kuat dan tahan lama.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
            @forelse($genteng as $index => $item)
            <div class="glass rounded-3xl overflow-hidden card-hover reveal" style="transition-delay:{{ 0.05 * ($index % 9) }}s">
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
            <div class="col-span-full text-center py-20">
                <p class="text-gray-500">Belum ada data genteng yang tersedia di katalog ini.</p>
            </div>
            @endforelse
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
                <p class="text-gray-600 text-sm leading-relaxed">Produsen genteng berkualitas tinggi sejak tahun 2000. Melayani seluruh wilayah Indonesia.</p>
            </div>
            <div>
                <p class="font-semibold text-white mb-4 text-sm">Navigasi</p>
                <div class="space-y-2">
                    <a href="{{ route('home') }}"       class="block text-gray-600 hover:text-red-400 transition text-sm">Home</a>
                    <a href="{{ route('home') }}#keunggulan" class="block text-gray-600 hover:text-red-400 transition text-sm">Keunggulan</a>
                    <a href="{{ route('home') }}#produk"     class="block text-gray-600 hover:text-red-400 transition text-sm">Produk</a>
                    <a href="{{ route('home') }}#lokasi"     class="block text-gray-600 hover:text-red-400 transition text-sm">Lokasi</a>
                </div>
            </div>
            <div>
                <p class="font-semibold text-white mb-4 text-sm">Ikuti Kami</p>
                <div class="flex gap-3">
                    <a href="#" class="w-9 h-9 glass rounded-lg flex items-center justify-center text-gray-500 hover:text-red-400 transition" aria-label="WhatsApp">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    </a>
                    <a href="#" class="w-9 h-9 glass rounded-lg flex items-center justify-center text-gray-500 hover:text-red-400 transition" aria-label="TikTok">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.04.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 2.23-.9 4.4-2.42 5.92-1.48 1.48-3.5 2.32-5.59 2.44-2.52.14-5.04-.75-6.84-2.47-1.7-1.62-2.58-3.93-2.48-6.26.11-2.49 1.34-4.78 3.32-6.15 1.83-1.27 4.1-1.65 6.22-1.07v4.02c-1.15-.31-2.4-.2-3.42.39-.8.47-1.39 1.19-1.67 2.05-.28.85-.22 1.82.16 2.62.4.83 1.14 1.45 2.01 1.7.9.26 1.9.15 2.7-.31.84-.48 1.41-1.31 1.6-2.27.08-.43.1-.88.1-1.32V.02z"/></svg>
                    </a>
                    <a href="#" class="w-9 h-9 glass rounded-lg flex items-center justify-center text-gray-500 hover:text-red-400 transition" aria-label="Facebook">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="#" class="w-9 h-9 glass rounded-lg flex items-center justify-center text-gray-500 hover:text-red-400 transition" aria-label="Instagram">
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
    // navbar.classList.add('scrolled'); // Optional: force scrolled style on catalog page if desired

    const hamburgerBtn = document.getElementById('hamburger-btn');
    const mobileMenu   = document.getElementById('mobile-menu');
    hamburgerBtn.addEventListener('click', () => mobileMenu.classList.toggle('open'));

    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => { if (entry.isIntersecting) entry.target.classList.add('visible'); });
    }, { threshold: 0.1 });
    document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));
</script>
</body>
</html>
