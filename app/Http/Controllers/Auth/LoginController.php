<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    // Tampilkan halaman login
    public function index()
    {
        if (Session::get('user_id')) {
            return redirect('/admin/dashboard');
        }

        return view('auth.login');
    }

    // Proses login
    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Simpan session
            Session::put('user_id', $user->id);
            Session::put('user_nama', $user->nama);
            Session::put('user_foto', $user->foto);

            // Update last login
            $user->last_login = now();
            $user->save();

            return redirect('/admin/dashboard')->with('success', 'Login berhasil');
        }

        return back()->with('error', 'Email atau password salah');
    }

    // Logout
    public function logout()
    {
        Session::flush();
        return redirect('/')->with('success', 'Logout berhasil');
    }
}