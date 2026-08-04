<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Genteng;

class GentengController extends Controller
{
    public function index()
    {
        $data = Genteng::all();
        return view('admin.genteng.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'  => 'required',
            'foto'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $foto = null;
        if ($request->hasFile('foto')) {
            $foto = time() . '_' . $request->foto->getClientOriginalName();
            $request->foto->move(public_path('uploads/genteng'), $foto);
        }

        Genteng::create([
            'nama'      => $request->nama,
            'jenis'     => $request->jenis,
            'harga'     => $request->harga,
            'stok'      => $request->stok,
            'deskripsi' => $request->deskripsi,
            'foto'      => $foto,
        ]);

        return back()->with('success', 'Data genteng berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $genteng = Genteng::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $foto = $genteng->foto;
        if ($request->hasFile('foto')) {
            // Hapus foto lama
            if ($foto && file_exists(public_path('uploads/genteng/' . $foto))) {
                unlink(public_path('uploads/genteng/' . $foto));
            }
            $foto = time() . '_' . $request->foto->getClientOriginalName();
            $request->foto->move(public_path('uploads/genteng'), $foto);
        }

        $genteng->update([
            'nama'      => $request->nama,
            'jenis'     => $request->jenis,
            'harga'     => $request->harga,
            'stok'      => $request->stok,
            'deskripsi' => $request->deskripsi,
            'foto'      => $foto,
        ]);

        return back()->with('success', 'Data genteng berhasil diperbarui');
    }

    public function deleteFoto($id)
    {
        $genteng = Genteng::findOrFail($id);
        if ($genteng->foto && file_exists(public_path('uploads/genteng/' . $genteng->foto))) {
            unlink(public_path('uploads/genteng/' . $genteng->foto));
        }
        $genteng->update(['foto' => null]);
        return back()->with('success', 'Foto genteng berhasil dihapus');
    }

    public function destroy($id)
    {
        $genteng = Genteng::findOrFail($id);
        // Hapus foto jika ada
        if ($genteng->foto && file_exists(public_path('uploads/genteng/' . $genteng->foto))) {
            unlink(public_path('uploads/genteng/' . $genteng->foto));
        }
        $genteng->delete();
        return back()->with('success', 'Data genteng berhasil dihapus');
    }
}