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
            'jarak_reng' => $request->jarak_reng,
            'dimensi'    => $request->dimensi,
            'isi_per_m2' => $request->isi_per_m2,
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
            'jarak_reng' => $request->jarak_reng,
            'dimensi'    => $request->dimensi,
            'isi_per_m2' => $request->isi_per_m2,
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

    public function toggleUnggulan($id)
    {
        $genteng = Genteng::findOrFail($id);
        
        if (!$genteng->is_unggulan) {
            // Check if there are already 4
            $count = Genteng::where('is_unggulan', true)->count();
            if ($count >= 4) {
                return response()->json([
                    'success' => false,
                    'error' => 'Maksimal 4 genteng yang dapat dijadikan produk unggulan. Jika ingin memasukkan yang baru, hapus salah satu terlebih dahulu.'
                ], 400);
            }
            $genteng->update(['is_unggulan' => true]);
            return response()->json([
                'success' => true,
                'is_unggulan' => true,
                'message' => 'Genteng berhasil ditambahkan ke produk unggulan'
            ]);
        } else {
            $genteng->update(['is_unggulan' => false]);
            return response()->json([
                'success' => true,
                'is_unggulan' => false,
                'message' => 'Genteng dihapus dari produk unggulan'
            ]);
        }
    }
}