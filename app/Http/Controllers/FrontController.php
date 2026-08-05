<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genteng;

class FrontController extends Controller
{
    public function index()
    {
        // Ambil genteng yang ditandai sebagai unggulan
        $genteng = Genteng::where('is_unggulan', true)->latest()->limit(4)->get();
        return view('landing-page', compact('genteng'));
    }

    public function katalog()
    {
        // Ambil semua genteng atau bisa di-paginate
        $genteng = Genteng::latest()->get();
        return view('daftar-genteng', compact('genteng'));
    }
}
