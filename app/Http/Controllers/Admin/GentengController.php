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
        Genteng::create($request->all());
        return back()->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        Genteng::findOrFail($id)->update($request->all());
        return back()->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        Genteng::findOrFail($id)->delete();
        return back()->with('success', 'Data berhasil dihapus');
    }
}