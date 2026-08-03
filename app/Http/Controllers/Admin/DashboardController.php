<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genteng;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // ── Statistik Utama ──────────────────────────────
        $totalProduk   = Genteng::count();
        $totalStok     = Genteng::sum('stok');
        $totalNilai    = Genteng::selectRaw('SUM(harga * stok) as nilai')->value('nilai') ?? 0;
        $avgHarga      = Genteng::avg('harga') ?? 0;
        $hargaTertinggi = Genteng::max('harga') ?? 0;
        $hargaTerendah  = Genteng::min('harga') ?? 0;
        $totalUser     = User::count();

        // ── Stok kritis (≤ 50) ───────────────────────────
        $stokKritis    = Genteng::where('stok', '<=', 50)->count();
        $produkStokKritis = Genteng::where('stok', '<=', 50)
                            ->orderBy('stok')
                            ->take(5)
                            ->get(['nama', 'jenis', 'stok', 'harga']);

        // ── Per jenis ─────────────────────────────────────
        $byJenis = Genteng::selectRaw('jenis, COUNT(*) as total_produk, SUM(stok) as total_stok, AVG(harga) as avg_harga, SUM(harga * stok) as nilai')
                    ->groupBy('jenis')
                    ->orderByDesc('total_stok')
                    ->get();

        // ── Produk terbaru ───────────────────────────────
        $produkTerbaru = Genteng::latest()->take(5)->get();

        // ── Produk stok terbanyak ────────────────────────
        $produkTopStok = Genteng::orderByDesc('stok')->take(5)->get(['nama', 'jenis', 'stok', 'harga']);

        // ── Produk harga tertinggi ────────────────────────
        $produkTopHarga = Genteng::orderByDesc('harga')->take(5)->get(['nama', 'jenis', 'harga', 'stok']);

        return view('admin.dashboard', compact(
            'totalProduk', 'totalStok', 'totalNilai', 'avgHarga',
            'hargaTertinggi', 'hargaTerendah', 'totalUser', 'stokKritis',
            'produkStokKritis', 'byJenis', 'produkTerbaru',
            'produkTopStok', 'produkTopHarga'
        ));
    }
}