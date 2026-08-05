<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::get();
        return view('admin.setting.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'app_name'     => 'required|string|max:100',
            'app_logo'     => 'nullable|image|mimes:jpg,jpeg,png,svg,webp|max:2048',
            'mainheadline' => 'nullable|string|min:25|max:200',
            'subheadline'  => 'nullable|string|min:150|max:200',
        ]);

        $setting = Setting::get();

        // Handle logo upload
        if ($request->hasFile('app_logo')) {
            // Hapus logo lama jika ada
            if ($setting->app_logo && file_exists(public_path($setting->app_logo))) {
                unlink(public_path($setting->app_logo));
            }

            $file     = $request->file('app_logo');
            $filename = 'logo_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/setting'), $filename);

            $setting->app_logo = 'uploads/setting/' . $filename;
        }

        $setting->app_name     = $request->app_name;
        $setting->mainheadline = $request->mainheadline;
        $setting->subheadline  = $request->subheadline;
        $setting->save();

        return back()->with('success', 'Pengaturan berhasil disimpan!');
    }

    public function deleteLogo()
    {
        $setting = Setting::get();

        if ($setting->app_logo && file_exists(public_path($setting->app_logo))) {
            unlink(public_path($setting->app_logo));
        }

        $setting->app_logo = null;
        $setting->save();

        return back()->with('success', 'Logo berhasil dihapus, kembali ke default.');
    }
}
