@extends('layouts.app')
@section('title', 'Dashboard - Genteng Dwijaya')

@section('content')

{{-- ========== PAGE HEADER ========== --}}
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
    <div>
        <div class="flex items-center gap-2 mb-1">
            <div class="w-1 h-6 rounded-full" style="background: linear-gradient(180deg,#e11d48,#f97316);"></div>
            <p class="text-xs font-semibold uppercase tracking-widest" style="color: rgba(225,29,72,0.8);">Overview</p>
        </div>
        <h1 class="text-2xl md:text-3xl font-black text-white">Dashboard</h1>
        <p class="text-sm mt-1" style="color: rgba(107,114,128,0.9);">Statistik & ringkasan data inventaris genteng</p>
    </div>
    <div class="flex items-center gap-2 text-xs" style="color: rgba(107,114,128,0.7);">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        {{ now()->isoFormat('dddd, D MMMM Y') }}
    </div>
</div>

{{-- ========== STAT CARDS ========== --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">

    {{-- Total Produk --}}
    <div class="stat-card rounded-2xl p-5 relative overflow-hidden group" style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.07);">
        <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300" style="background: linear-gradient(135deg, rgba(225,29,72,0.08), transparent);"></div>
        <div class="relative z-10">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-4" style="background: linear-gradient(135deg,#9f1239,#e11d48); box-shadow: 0 0 16px rgba(225,29,72,0.35);">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
            </div>
            <p class="text-2xl font-black text-white">{{ number_format($totalProduk) }}</p>
            <p class="text-xs mt-1 font-medium" style="color: rgba(156,163,175,0.8);">Jenis Produk</p>
            <div class="flex items-center gap-1 mt-2">
                <span class="text-xs px-2 py-0.5 rounded-full" style="background: rgba(225,29,72,0.15); color: #f87171;">{{ $byJenis->count() }} kategori</span>
            </div>
        </div>
    </div>

    {{-- Total Stok --}}
    <div class="stat-card rounded-2xl p-5 relative overflow-hidden group" style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.07);">
        <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300" style="background: linear-gradient(135deg, rgba(249,115,22,0.08), transparent);"></div>
        <div class="relative z-10">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-4" style="background: linear-gradient(135deg,#c2410c,#f97316); box-shadow: 0 0 16px rgba(249,115,22,0.3);">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            </div>
            <p class="text-2xl font-black text-white">{{ number_format($totalStok) }}</p>
            <p class="text-xs mt-1 font-medium" style="color: rgba(156,163,175,0.8);">Total Stok (lembar)</p>
            <div class="flex items-center gap-1 mt-2">
                @if($stokKritis > 0)
                <span class="text-xs px-2 py-0.5 rounded-full animate-pulse" style="background: rgba(239,68,68,0.2); color: #fca5a5;">⚠ {{ $stokKritis }} stok kritis</span>
                @else
                <span class="text-xs px-2 py-0.5 rounded-full" style="background: rgba(34,197,94,0.15); color: #86efac;">✓ Stok aman</span>
                @endif
            </div>
        </div>
    </div>

    {{-- Nilai Inventaris --}}
    <div class="stat-card rounded-2xl p-5 relative overflow-hidden group" style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.07);">
        <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300" style="background: linear-gradient(135deg, rgba(168,85,247,0.08), transparent);"></div>
        <div class="relative z-10">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-4" style="background: linear-gradient(135deg,#7e22ce,#a855f7); box-shadow: 0 0 16px rgba(168,85,247,0.3);">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <p class="text-xl font-black text-white">Rp {{ number_format($totalNilai / 1000000, 1) }}jt</p>
            <p class="text-xs mt-1 font-medium" style="color: rgba(156,163,175,0.8);">Nilai Inventaris</p>
            <div class="mt-2">
                <span class="text-xs" style="color: rgba(107,114,128,0.7);">Rp {{ number_format($totalNilai) }}</span>
            </div>
        </div>
    </div>

    {{-- Rata-rata Harga --}}
    <div class="stat-card rounded-2xl p-5 relative overflow-hidden group" style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.07);">
        <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300" style="background: linear-gradient(135deg, rgba(20,184,166,0.08), transparent);"></div>
        <div class="relative z-10">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-4" style="background: linear-gradient(135deg,#0f766e,#14b8a6); box-shadow: 0 0 16px rgba(20,184,166,0.3);">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"/></svg>
            </div>
            <p class="text-2xl font-black text-white">Rp {{ number_format($avgHarga, 0, ',', '.') }}</p>
            <p class="text-xs mt-1 font-medium" style="color: rgba(156,163,175,0.8);">Rata-rata Harga</p>
            <div class="flex items-center gap-1 mt-2 text-xs" style="color: rgba(107,114,128,0.7);">
                <span>Rp {{ number_format($hargaTerendah) }}</span>
                <span>–</span>
                <span>Rp {{ number_format($hargaTertinggi) }}</span>
            </div>
        </div>
    </div>
</div>

{{-- ========== ROW 2: Distribusi Jenis + Stok Kritis ========== --}}
<div class="grid lg:grid-cols-3 gap-6 mb-6">

    {{-- Distribusi per Jenis (spanning 2 cols) --}}
    <div class="lg:col-span-2 rounded-2xl p-6" style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.07);">
        <div class="flex items-center justify-between mb-5">
            <div>
                <h2 class="text-base font-bold text-white">Distribusi per Jenis Genteng</h2>
                <p class="text-xs mt-0.5" style="color: rgba(107,114,128,0.8);">Perbandingan stok & nilai tiap kategori</p>
            </div>
            <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background: rgba(225,29,72,0.15);">
                <svg class="w-4 h-4" style="color: #e11d48;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
            </div>
        </div>

        @php
            $maxStok = $byJenis->max('total_stok') ?: 1;
            $jenisColors = [
                'Tanah Liat' => ['#e11d48','#f43f5e'],
                'Keramik'    => ['#f97316','#fb923c'],
                'Beton'      => ['#a855f7','#c084fc'],
                'Metal'      => ['#14b8a6','#2dd4bf'],
                'Fiber'      => ['#3b82f6','#60a5fa'],
                'Reng'       => ['#f59e0b','#fbbf24'],
            ];
        @endphp

        <div class="space-y-4">
            @foreach($byJenis as $j)
            @php
                $pct = $totalStok > 0 ? round(($j->total_stok / $totalStok) * 100, 1) : 0;
                $barPct = round(($j->total_stok / $maxStok) * 100);
                $color = $jenisColors[$j->jenis] ?? ['#e11d48','#f43f5e'];
            @endphp
            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full flex-shrink-0" style="background: {{ $color[0] }};"></span>
                        <span class="text-sm font-medium text-white">{{ $j->jenis }}</span>
                        <span class="text-xs px-2 py-0.5 rounded-full" style="background: rgba(255,255,255,0.06); color: rgba(156,163,175,0.9);">{{ $j->total_produk }} produk</span>
                    </div>
                    <div class="text-right">
                        <span class="text-sm font-bold text-white">{{ number_format($j->total_stok) }}</span>
                        <span class="text-xs ml-1" style="color: rgba(107,114,128,0.8);">({{ $pct }}%)</span>
                    </div>
                </div>
                <div class="h-2 rounded-full" style="background: rgba(255,255,255,0.06);">
                    <div class="h-2 rounded-full transition-all duration-700"
                         style="width: {{ $barPct }}%; background: linear-gradient(90deg, {{ $color[0] }}, {{ $color[1] }}); box-shadow: 0 0 8px {{ $color[0] }}55;">
                    </div>
                </div>
                <div class="flex items-center justify-between mt-1">
                    <span class="text-xs" style="color: rgba(107,114,128,0.6);">Avg. Rp {{ number_format($j->avg_harga, 0, ',', '.') }}/lembar</span>
                    <span class="text-xs" style="color: rgba(107,114,128,0.6);">Nilai: Rp {{ number_format($j->nilai / 1000000, 2) }}jt</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Ringkasan Cepat --}}
    <div class="flex flex-col gap-4">

        {{-- Harga Info --}}
        <div class="rounded-2xl p-5" style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.07);">
            <h3 class="text-sm font-bold text-white mb-4">Rentang Harga</h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 rounded-lg flex items-center justify-center text-xs" style="background: rgba(34,197,94,0.15); color: #4ade80;">↑</div>
                        <span class="text-xs" style="color: rgba(156,163,175,0.8);">Tertinggi</span>
                    </div>
                    <span class="text-sm font-bold text-white">Rp {{ number_format($hargaTertinggi) }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 rounded-lg flex items-center justify-center text-xs" style="background: rgba(239,68,68,0.15); color: #f87171;">↓</div>
                        <span class="text-xs" style="color: rgba(156,163,175,0.8);">Terendah</span>
                    </div>
                    <span class="text-sm font-bold text-white">Rp {{ number_format($hargaTerendah) }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 rounded-lg flex items-center justify-center text-xs" style="background: rgba(249,115,22,0.15); color: #fb923c;">⌀</div>
                        <span class="text-xs" style="color: rgba(156,163,175,0.8);">Rata-rata</span>
                    </div>
                    <span class="text-sm font-bold text-white">Rp {{ number_format($avgHarga, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        {{-- Pengguna --}}
        <div class="rounded-2xl p-5" style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.07);">
            <h3 class="text-sm font-bold text-white mb-4">Pengguna Sistem</h3>
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0" style="background: linear-gradient(135deg,#1d4ed8,#3b82f6); box-shadow: 0 0 14px rgba(59,130,246,0.3);">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <div>
                    <p class="text-2xl font-black text-white">{{ $totalUser }}</p>
                    <p class="text-xs" style="color: rgba(107,114,128,0.8);">Administrator aktif</p>
                </div>
            </div>
        </div>

        {{-- Stok Status --}}
        <div class="rounded-2xl p-5 flex-1" style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.07);">
            <h3 class="text-sm font-bold text-white mb-4">Status Stok</h3>
            @php
                $stokAman   = $totalProduk - $stokKritis;
                $pctAman    = $totalProduk > 0 ? round(($stokAman / $totalProduk) * 100) : 0;
                $pctKritis  = $totalProduk > 0 ? round(($stokKritis / $totalProduk) * 100) : 0;
            @endphp
            <div class="flex gap-2 mb-3">
                <div class="flex-1 h-3 rounded-full overflow-hidden" style="background: rgba(255,255,255,0.06);">
                    <div class="h-3 rounded-full" style="width:{{ $pctAman }}%; background: linear-gradient(90deg,#16a34a,#4ade80);"></div>
                </div>
            </div>
            <div class="flex items-center justify-between text-xs">
                <div class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full" style="background:#4ade80;"></span><span style="color:rgba(156,163,175,0.8);">Aman ({{ $stokAman }})</span></div>
                <div class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full" style="background:#f87171;"></span><span style="color:rgba(156,163,175,0.8);">Kritis ({{ $stokKritis }})</span></div>
            </div>
        </div>
    </div>
</div>

{{-- ========== ROW 3: Tabel-tabel ========== --}}
<div class="grid lg:grid-cols-2 gap-6 mb-6">

    {{-- Produk Terbaru --}}
    <div class="rounded-2xl overflow-hidden" style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.07);">
        <div class="flex items-center justify-between px-5 py-4" style="border-bottom: 1px solid rgba(255,255,255,0.06);">
            <h2 class="text-sm font-bold text-white">Produk Terbaru</h2>
            <a href="{{ route('admin.genteng') }}" class="text-xs px-3 py-1 rounded-lg transition"
               style="background: rgba(225,29,72,0.12); color: #f87171; border: 1px solid rgba(225,29,72,0.2);"
               onmouseover="this.style.background='rgba(225,29,72,0.2)'" onmouseout="this.style.background='rgba(225,29,72,0.12)'">
                Lihat Semua →
            </a>
        </div>
        <div class="divide-y" style="border-color: rgba(255,255,255,0.04);">
            @forelse($produkTerbaru as $item)
            <div class="flex items-center justify-between px-5 py-3 hover:bg-white/5 transition">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0 text-xs font-bold text-white"
                         style="background: linear-gradient(135deg, rgba(225,29,72,0.6), rgba(159,18,57,0.8));">
                        {{ substr($item->nama, 0, 1) }}
                    </div>
                    <div>
                        <p class="text-sm font-medium text-white leading-tight">{{ Str::limit($item->nama, 28) }}</p>
                        <p class="text-xs" style="color: rgba(107,114,128,0.8);">{{ $item->jenis }}</p>
                    </div>
                </div>
                <div class="text-right flex-shrink-0">
                    <p class="text-sm font-bold text-white">Rp {{ number_format($item->harga) }}</p>
                    <p class="text-xs" style="color: rgba(107,114,128,0.7);">stok: {{ number_format($item->stok) }}</p>
                </div>
            </div>
            @empty
            <div class="px-5 py-8 text-center text-sm" style="color: rgba(107,114,128,0.6);">Belum ada data produk</div>
            @endforelse
        </div>
    </div>

    {{-- Produk Stok Terbanyak --}}
    <div class="rounded-2xl overflow-hidden" style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.07);">
        <div class="flex items-center justify-between px-5 py-4" style="border-bottom: 1px solid rgba(255,255,255,0.06);">
            <h2 class="text-sm font-bold text-white">Stok Terbanyak</h2>
            <span class="text-xs px-2 py-0.5 rounded-full" style="background: rgba(249,115,22,0.12); color: #fb923c; border: 1px solid rgba(249,115,22,0.2);">Top 5</span>
        </div>
        @php $maxS = $produkTopStok->max('stok') ?: 1; @endphp
        <div class="p-5 space-y-3">
            @forelse($produkTopStok as $i => $item)
            @php $pct = round(($item->stok / $maxS) * 100); @endphp
            <div>
                <div class="flex items-center justify-between mb-1">
                    <div class="flex items-center gap-2">
                        <span class="text-xs font-bold w-5 text-center" style="color: rgba(107,114,128,0.6);">{{ $i+1 }}</span>
                        <span class="text-sm text-white font-medium">{{ Str::limit($item->nama, 22) }}</span>
                    </div>
                    <span class="text-sm font-bold text-white">{{ number_format($item->stok) }}</span>
                </div>
                <div class="h-1.5 rounded-full ml-7" style="background: rgba(255,255,255,0.06);">
                    <div class="h-1.5 rounded-full" style="width: {{ $pct }}%; background: linear-gradient(90deg, #c2410c, #f97316);"></div>
                </div>
            </div>
            @empty
            <p class="text-center text-sm py-4" style="color: rgba(107,114,128,0.6);">Tidak ada data</p>
            @endforelse
        </div>
    </div>
</div>

{{-- ========== ROW 4: Harga Tertinggi + Stok Kritis ========== --}}
<div class="grid lg:grid-cols-2 gap-6">

    {{-- Produk Harga Tertinggi --}}
    <div class="rounded-2xl overflow-hidden" style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.07);">
        <div class="flex items-center justify-between px-5 py-4" style="border-bottom: 1px solid rgba(255,255,255,0.06);">
            <h2 class="text-sm font-bold text-white">Produk Harga Tertinggi</h2>
            <span class="text-xs px-2 py-0.5 rounded-full" style="background: rgba(168,85,247,0.12); color: #c084fc; border: 1px solid rgba(168,85,247,0.2);">Premium</span>
        </div>
        <div class="divide-y" style="border-color: rgba(255,255,255,0.04);">
            @forelse($produkTopHarga as $i => $item)
            <div class="flex items-center justify-between px-5 py-3 hover:bg-white/5 transition">
                <div class="flex items-center gap-3">
                    <span class="text-xs font-black w-6 text-center"
                          style="{{ $i === 0 ? 'color:#f59e0b' : ($i === 1 ? 'color:#9ca3af' : ($i === 2 ? 'color:#b45309' : 'color:rgba(107,114,128,0.5)')) }}">
                        #{{ $i+1 }}
                    </span>
                    <div>
                        <p class="text-sm font-medium text-white">{{ Str::limit($item->nama, 26) }}</p>
                        <p class="text-xs" style="color: rgba(107,114,128,0.7);">{{ $item->jenis }} · stok {{ number_format($item->stok) }}</p>
                    </div>
                </div>
                <span class="text-sm font-black" style="color: #c084fc;">Rp {{ number_format($item->harga) }}</span>
            </div>
            @empty
            <div class="px-5 py-8 text-center text-sm" style="color: rgba(107,114,128,0.6);">Tidak ada data</div>
            @endforelse
        </div>
    </div>

    {{-- Stok Kritis / Ringkasan Kategori --}}
    <div class="rounded-2xl overflow-hidden" style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.07);">
        <div class="flex items-center justify-between px-5 py-4" style="border-bottom: 1px solid rgba(255,255,255,0.06);">
            <h2 class="text-sm font-bold text-white">Ringkasan Kategori</h2>
            <span class="text-xs px-2 py-0.5 rounded-full" style="background: rgba(20,184,166,0.12); color: #2dd4bf; border: 1px solid rgba(20,184,166,0.2);">{{ $byJenis->count() }} jenis</span>
        </div>
        <div class="p-5">
            <div class="grid grid-cols-2 gap-3">
                @foreach($byJenis as $j)
                @php $color2 = $jenisColors[$j->jenis] ?? ['#e11d48','#f43f5e']; @endphp
                <div class="rounded-xl p-3 transition hover:scale-105" style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.06);">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="w-2 h-2 rounded-full" style="background: {{ $color2[0] }};"></span>
                        <span class="text-xs font-semibold text-white">{{ $j->jenis }}</span>
                    </div>
                    <p class="text-lg font-black text-white">{{ number_format($j->total_stok) }}</p>
                    <p class="text-xs" style="color: rgba(107,114,128,0.7);">{{ $j->total_produk }} produk · Rp {{ number_format($j->avg_harga, 0, ',', '.') }}/lbr</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<style>
    .stat-card { transition: transform 0.25s ease, box-shadow 0.25s ease; }
    .stat-card:hover { transform: translateY(-4px); box-shadow: 0 16px 40px rgba(0,0,0,0.3); }
</style>

@endsection
