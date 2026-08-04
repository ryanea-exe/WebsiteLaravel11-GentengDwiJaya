<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Tampilkan halaman user
    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    // Simpan user
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|min:5'
        ]);

        $foto = null;
        if ($request->hasFile('foto')) {
            $foto = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('uploads/user'), $foto);
        }

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'foto' => $foto
        ]);

        return back()->with('success', 'User berhasil ditambahkan');
    }

    // Update user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $foto = $user->foto;
        if ($request->hasFile('foto')) {
            $foto = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('uploads/user'), $foto);
        }

        $user->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'foto' => $foto
        ]);

        // update password kalau diisi
        if ($request->password) {
            $user->update([
                'password' => Hash::make($request->password)
            ]);
        }

        return back()->with('success', 'User berhasil diupdate');
    }

    // Edit profile user yang sedang login
    public function editProfile()
    {
        $user = User::findOrFail(session('user_id'));
        return view('admin.user.edit-profile', compact('user'));
    }

    // Update profile user yang sedang login
    public function updateProfile(Request $request)
    {
        $user = User::findOrFail(session('user_id'));

        $request->validate([
            'nama'     => 'required|string|max:100',
            'email'    => 'required|email|unique:user,email,' . $user->id,
            'password' => 'nullable|min:5|confirmed',
            'foto'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Handle foto upload
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($user->foto && file_exists(public_path('uploads/user/' . $user->foto))) {
                unlink(public_path('uploads/user/' . $user->foto));
            }
            $foto = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('uploads/user'), $foto);
            $user->foto = $foto;
        }

        $user->nama  = $request->nama;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    // Delete user
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return back()->with('success', 'User berhasil dihapus');
    }
}