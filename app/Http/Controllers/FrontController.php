<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genteng;

class FrontController extends Controller
{
    public function index()
    {
        // Ambil genteng yang ditandai sebagai unggulan, diurutkan dari nama
        $genteng = Genteng::where('is_unggulan', true)->orderBy('nama', 'asc')->limit(4)->get();
        return view('landing-page', compact('genteng'));
    }

    public function katalog()
    {
        // Ambil semua genteng, urutkan dari yang unggulan dulu, lalu berdasarkan nama
        $genteng = Genteng::orderBy('is_unggulan', 'desc')->orderBy('nama', 'asc')->get();
        return view('daftar-genteng', compact('genteng'));
    }
}
