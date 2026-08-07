@extends('layouts.app')
@section('title', 'Data Genteng - ' . $appSetting->app_name)

@section('content')

{{-- ===== PAGE HEADER ===== --}}
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
    <div>
        <div class="flex items-center gap-2 mb-1">
            <div class="w-1 h-6 rounded-full" style="background: linear-gradient(180deg,#e11d48,#f97316);"></div>
            <p class="text-xs font-semibold uppercase tracking-widest" style="color: rgba(225,29,72,0.8);">Inventaris</p>
        </div>
        <h1 class="text-2xl md:text-3xl font-black text-white">Data Genteng</h1>
        <p class="text-sm mt-1" style="color: rgba(107,114,128,0.9);">Kelola seluruh data produk genteng</p>
    </div>
    <button onclick="modalOpen('tambahModal')"
        class="inline-flex items-center gap-2 text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition-all self-start sm:self-auto"
        style="background: linear-gradient(135deg,#e11d48,#9f1239); box-shadow: 0 0 20px rgba(225,29,72,0.35);"
        onmouseover="this.style.boxShadow='0 0 30px rgba(225,29,72,0.55)'; this.style.transform='scale(1.03)'"
        onmouseout="this.style.boxShadow='0 0 20px rgba(225,29,72,0.35)'; this.style.transform='scale(1)'">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Genteng
    </button>
</div>

{{-- ===== FLASH MESSAGE ===== --}}
@if(session('success'))
<div id="flash-msg" class="flex items-center gap-3 rounded-2xl px-4 py-3 mb-6 text-sm"
     style="background: rgba(34,197,94,0.12); border: 1px solid rgba(34,197,94,0.25); color: #4ade80;">
    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
    {{ session('success') }}
    <button onclick="document.getElementById('flash-msg').remove()" class="ml-auto opacity-60 hover:opacity-100 transition">✕</button>
</div>
@endif

@if(session('error'))
<div id="flash-error" class="flex items-center gap-3 rounded-2xl px-4 py-3 mb-6 text-sm"
     style="background: rgba(225,29,72,0.12); border: 1px solid rgba(225,29,72,0.25); color: #f87171;">
    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
    {{ session('error') }}
    <button onclick="document.getElementById('flash-error').remove()" class="ml-auto opacity-60 hover:opacity-100 transition">✕</button>
</div>
@endif

{{-- ===== TABLE CARD ===== --}}
<div class="rounded-2xl overflow-hidden" style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.07);">
    <div class="px-5 py-4 flex items-center justify-between" style="border-bottom: 1px solid rgba(255,255,255,0.06);">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background: rgba(225,29,72,0.15);">
                <svg class="w-4 h-4" style="color:#e11d48;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
            </div>
            <span class="text-sm font-semibold text-white">Daftar Produk Genteng</span>
        </div>
        <span class="text-xs px-2.5 py-1 rounded-full font-medium"
              style="background: rgba(225,29,72,0.12); color: #f87171; border: 1px solid rgba(225,29,72,0.2);">
            {{ $data->count() }} produk
        </span>
    </div>

    <div class="p-4 overflow-x-auto">
        <table id="dataTable" class="min-w-full text-sm">
            <thead>
                <tr>
                    <th class="p-3 text-left">No</th>
                    <th class="p-3 text-left">Nama Genteng</th>
                    <th class="p-3 text-left">Jenis</th>
                    <th class="p-3 text-left">Harga</th>
                    <th class="p-3 text-left">Stok</th>
                    <th class="p-3 text-center">Unggulan</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $i => $d)
                <tr>
                    <td class="px-3 py-3">
                        <span class="text-xs font-semibold" style="color: rgba(107,114,128,0.7);">{{ $i+1 }}</span>
                    </td>
                    <td class="px-3 py-3">
                        <div class="flex items-center gap-2.5">
                            @php
                                $words = explode(' ', trim($d->nama));
                                $inisial = count($words) >= 2
                                    ? substr($words[0], 0, 1) . substr($words[1], 0, 1)
                                    : substr($words[0], 0, 2);
                            @endphp
                            @if($d->foto)
                                <div class="w-8 h-8 rounded-lg overflow-hidden flex-shrink-0"
                                     style="border:1px solid rgba(225,29,72,0.3); box-shadow:0 0 8px rgba(225,29,72,0.2);">
                                    <img src="{{ asset('uploads/genteng/' . $d->foto) }}"
                                         alt="{{ $d->nama }}" class="w-full h-full object-cover">
                                </div>
                            @else
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center text-xs font-bold text-white flex-shrink-0 tracking-wider"
                                     style="background: linear-gradient(135deg,rgba(225,29,72,0.6),rgba(159,18,57,0.9));">
                                    {{ strtoupper($inisial) }}
                                </div>
                            @endif
                            <span class="font-medium text-white">{{ $d->nama }}</span>
                        </div>
                    </td>
                    <td class="px-3 py-3">
                        @php
                            $jenisStyle = [
                                'Reng'       => 'background:rgba(245,158,11,0.15);color:#fbbf24;border:1px solid rgba(245,158,11,0.25)',
                                'Reng Cat'   => 'background:rgba(249,115,22,0.15);color:#fb923c;border:1px solid rgba(249,115,22,0.25)',
                                'Wuwung'     => 'background:rgba(168,85,247,0.15);color:#c084fc;border:1px solid rgba(168,85,247,0.25)',
                                'Wuwung Cat' => 'background:rgba(225,29,72,0.15);color:#f87171;border:1px solid rgba(225,29,72,0.25)',
                                'Variasi'    => 'background:rgba(59,130,246,0.15);color:#60a5fa;border:1px solid rgba(59,130,246,0.25)',
                            ];
                            $style = $jenisStyle[$d->jenis] ?? 'background:rgba(255,255,255,0.08);color:#9ca3af;border:1px solid rgba(255,255,255,0.12)';
                        @endphp
                        <span class="text-xs font-semibold px-2.5 py-1 rounded-full" style="{{ $style }}">
                            {{ $d->jenis }}
                        </span>
                    </td>
                    <td class="px-3 py-3">
                        <span class="font-semibold text-white">Rp {{ number_format($d->harga, 0, ',', '.') }}</span>
                    </td>
                    <td class="px-3 py-3">
                        @php $stokClass = $d->stok <= 50 ? 'color:#fca5a5' : 'color:#4ade80'; @endphp
                        <span class="font-semibold" style="{{ $stokClass }}">
                            {{ number_format($d->stok, 0, ',', '.') }}
                        </span>
                        <span class="text-xs ml-1" style="color:rgba(107,114,128,0.6);">pcs</span>
                    </td>
                    <td class="px-3 py-3 text-center">
                        <button type="button" onclick="toggleUnggulan({{ $d->id }}, this)" class="transition-transform hover:scale-110 focus:outline-none" title="{{ $d->is_unggulan ? 'Hapus dari Unggulan' : 'Jadikan Unggulan' }}">
                            <svg class="w-6 h-6 mx-auto {{ $d->is_unggulan ? 'text-yellow-400' : 'text-gray-500' }} star-icon" fill="{{ $d->is_unggulan ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                        </button>
                    </td>
                    <td class="px-3 py-3">
                        <div class="flex items-center justify-center gap-2">
                            <button onclick='openDetailModal(@json($d))'
                                title="Detail"
                                class="w-8 h-8 flex items-center justify-center rounded-lg transition-all"
                                style="background:rgba(59,130,246,0.15); color:#60a5fa; border:1px solid rgba(59,130,246,0.25);"
                                onmouseover="this.style.background='rgba(59,130,246,0.3)'"
                                onmouseout="this.style.background='rgba(59,130,246,0.15)'">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                            <button onclick='openEditModal(@json($d))'
                                title="Edit"
                                class="w-8 h-8 flex items-center justify-center rounded-lg transition-all"
                                style="background:rgba(245,158,11,0.15); color:#fbbf24; border:1px solid rgba(245,158,11,0.25);"
                                onmouseover="this.style.background='rgba(245,158,11,0.3)'"
                                onmouseout="this.style.background='rgba(245,158,11,0.15)'">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </button>
                            <button onclick="openDeleteModal({{ $d->id }}, '{{ addslashes($d->nama) }}')"
                                title="Hapus"
                                class="w-8 h-8 flex items-center justify-center rounded-lg transition-all"
                                style="background:rgba(225,29,72,0.15); color:#f87171; border:1px solid rgba(225,29,72,0.25);"
                                onmouseover="this.style.background='rgba(225,29,72,0.3)'"
                                onmouseout="this.style.background='rgba(225,29,72,0.15)'">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


{{-- ===== MODAL TAMBAH ===== --}}
<div id="tambahModal" class="modal-overlay" onclick="handleOverlayClick(event, 'tambahModal')">
    <div class="modal-box">
        <div class="modal-header">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center"
                     style="background:linear-gradient(135deg,#e11d48,#9f1239); box-shadow:0 0 14px rgba(225,29,72,0.4);">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-base font-bold text-white">Tambah Genteng</h2>
                    <p class="text-xs" style="color:rgba(107,114,128,0.8);">Isi data produk genteng baru</p>
                </div>
            </div>
            <button onclick="modalClose('tambahModal')" class="modal-close-btn">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <form method="POST" action="/admin/genteng/store" class="modal-body" enctype="multipart/form-data">
            @csrf
            <div class="form-grid">
                <div class="form-group col-span-2">
                    <label class="form-label">Nama Produk <span style="color:#e11d48">*</span></label>
                    <input type="text" name="nama" placeholder="cth. Genteng Morando Merah" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Jenis Genteng</label>
                    <select name="jenis" class="form-input">
                        <option value="">— Pilih Jenis —</option>
                        <option value="Reng">Reng</option>
                        <option value="Reng Cat">Reng Cat</option>
                        <option value="Wuwung">Wuwung</option>
                        <option value="Wuwung Cat">Wuwung Cat</option>
                        <option value="Variasi">Variasi</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Harga (Rp)</label>
                    <input type="number" name="harga" placeholder="cth. 5000" class="form-input" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Stok (lembar)</label>
                    <input type="number" name="stok" placeholder="cth. 1000" class="form-input" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Jarak Antar Reng (cm)</label>
                    <input type="text" name="jarak_reng" placeholder="cth. 23" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Dimensi P x L (cm)</label>
                    <input type="text" name="dimensi" placeholder="cth. 30 x 20" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Isi per m²</label>
                    <input type="text" name="isi_per_m2" placeholder="cth. 25 pcs" class="form-input">
                </div>
                <div class="form-group col-span-2">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" rows="3" placeholder="Deskripsi singkat produk..." class="form-input resize-none"></textarea>
                </div>
                <div class="form-group col-span-2">
                    <label class="form-label">Foto Genteng <span style="color:rgba(107,114,128,0.6);font-weight:400;">(opsional &middot; JPG, PNG, WebP &middot; Maks 2MB)</span></label>
                    <div class="foto-upload-area" onclick="document.getElementById('tambahFotoInput').click()">
                        <div id="tambahFotoPreviewWrap" class="hidden flex items-center gap-3">
                            <div class="w-14 h-14 rounded-xl overflow-hidden flex-shrink-0" style="border:1px solid rgba(225,29,72,0.3);">
                                <img id="tambahFotoPreview" src="" alt="" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <p id="tambahFotoName" class="text-xs text-white font-medium"></p>
                                <button type="button" onclick="clearTambahFoto(event)" class="text-xs mt-1" style="color:#f87171;">&#10005; Hapus</button>
                            </div>
                        </div>
                        <div id="tambahFotoPlaceholder" class="flex flex-col items-center gap-2 py-1">
                            <svg class="w-7 h-7" style="color:rgba(107,114,128,0.5);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span class="text-xs" style="color:rgba(107,114,128,0.6);">Klik untuk upload foto</span>
                        </div>
                        <input type="file" id="tambahFotoInput" name="foto" accept=".jpg,.jpeg,.png,.webp"
                               class="hidden" onchange="handleTambahFotoPreview(this)">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="modalClose('tambahModal')" class="btn-secondary">Batal</button>
                <button type="submit" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ===== MODAL EDIT ===== --}}
<div id="editModal" class="modal-overlay" onclick="handleOverlayClick(event, 'editModal')">
    <div class="modal-box">
        <div class="modal-header">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center"
                     style="background:linear-gradient(135deg,#d97706,#f59e0b); box-shadow:0 0 14px rgba(245,158,11,0.35);">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-base font-bold text-white">Edit Genteng</h2>
                    <p class="text-xs" style="color:rgba(107,114,128,0.8);">Perbarui data produk genteng</p>
                </div>
            </div>
            <button onclick="modalClose('editModal')" class="modal-close-btn">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <form id="editForm" method="POST" class="modal-body" enctype="multipart/form-data">
            @csrf
            <div class="form-grid">
                <div class="form-group col-span-2">
                    <label class="form-label">Nama Produk <span style="color:#e11d48">*</span></label>
                    <input type="text" name="nama" id="editNama" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Jenis Genteng</label>
                    <select name="jenis" id="editJenis" class="form-input">
                        <option value="">— Pilih Jenis —</option>
                        <option value="Reng">Reng</option>
                        <option value="Reng Cat">Reng Cat</option>
                        <option value="Wuwung">Wuwung</option>
                        <option value="Wuwung Cat">Wuwung Cat</option>
                        <option value="Variasi">Variasi</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Harga (Rp)</label>
                    <input type="number" name="harga" id="editHarga" class="form-input" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Stok (pcs)</label>
                    <input type="number" name="stok" id="editStok" class="form-input" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Jarak Antar Reng (cm)</label>
                    <input type="text" name="jarak_reng" id="editJarakReng" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Dimensi P x L (cm)</label>
                    <input type="text" name="dimensi" id="editDimensi" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Isi per m²</label>
                    <input type="text" name="isi_per_m2" id="editIsiPerM2" class="form-input">
                </div>
                <div class="form-group col-span-2">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" id="editDeskripsi" rows="3" class="form-input resize-none"></textarea>
                </div>
                <div class="form-group col-span-2">
                    <label class="form-label">Foto Genteng <span style="color:rgba(107,114,128,0.6);font-weight:400;">(opsional &middot; kosongkan jika tidak diubah)</span></label>
                    {{-- Foto saat ini --}}
                    <div id="editFotoCurrentWrap" class="hidden mb-2 flex items-center gap-3 rounded-xl px-3 py-2.5"
                         style="background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.07);">
                        <div class="w-14 h-14 rounded-xl overflow-hidden flex-shrink-0" style="border:1px solid rgba(225,29,72,0.25);">
                            <img id="editFotoCurrentImg" src="" alt="" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs text-white font-medium mb-1">Foto Saat Ini</p>
                            <p id="editFotoCurrentName" class="text-xs truncate" style="color:rgba(107,114,128,0.7);"></p>
                        </div>
                        <a id="editFotoDeleteBtn" href="#"
                           onclick="return confirm('Hapus foto genteng ini?')"
                           class="inline-flex items-center gap-1 text-xs px-2.5 py-1.5 rounded-lg transition flex-shrink-0"
                           style="background:rgba(225,29,72,0.12); color:#f87171; border:1px solid rgba(225,29,72,0.25);">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Hapus Foto
                        </a>
                    </div>
                    {{-- Upload foto baru --}}
                    <div class="foto-upload-area" onclick="document.getElementById('editFotoInput').click()">
                        <div id="editFotoPreviewWrap" class="hidden flex items-center gap-3">
                            <div class="w-14 h-14 rounded-xl overflow-hidden flex-shrink-0" style="border:1px solid rgba(225,29,72,0.3);">
                                <img id="editFotoPreview" src="" alt="" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <p id="editFotoName" class="text-xs text-white font-medium"></p>
                                <button type="button" onclick="clearEditFoto(event)" class="text-xs mt-1" style="color:#f87171;">&#10005; Batalkan</button>
                            </div>
                        </div>
                        <div id="editFotoPlaceholder" class="flex flex-col items-center gap-2 py-1">
                            <svg class="w-7 h-7" style="color:rgba(107,114,128,0.5);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span class="text-xs" style="color:rgba(107,114,128,0.6);">Klik untuk ganti foto</span>
                        </div>
                        <input type="file" id="editFotoInput" name="foto" accept=".jpg,.jpeg,.png,.webp"
                               class="hidden" onchange="handleEditFotoPreview(this)">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="modalClose('editModal')" class="btn-secondary">Batal</button>
                <button type="submit" class="btn-primary" style="background:linear-gradient(135deg,#d97706,#f59e0b); box-shadow:0 0 16px rgba(245,158,11,0.3);">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                    </svg>
                    Update
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ===== MODAL DELETE ===== --}}
<div id="deleteModal" class="modal-overlay" onclick="handleOverlayClick(event, 'deleteModal')">
    <div class="modal-box" style="max-width:420px;">
        <div class="modal-header">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center"
                     style="background:rgba(225,29,72,0.2); border:1px solid rgba(225,29,72,0.3);">
                    <svg class="w-4 h-4" style="color:#f87171;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <h2 class="text-base font-bold text-white">Konfirmasi Hapus</h2>
            </div>
            <button onclick="modalClose('deleteModal')" class="modal-close-btn">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <div class="px-5 py-5">
            <p class="text-sm" style="color:rgba(156,163,175,0.9);">Anda yakin ingin menghapus produk:</p>
            <p id="deleteNama" class="text-base font-bold text-white mt-1 mb-4"></p>
            <p class="text-xs" style="color:rgba(239,68,68,0.75);">⚠ Tindakan ini tidak dapat dibatalkan.</p>
        </div>
        <div class="modal-footer">
            <button onclick="modalClose('deleteModal')" class="btn-secondary">Batal</button>
            <a id="deleteLink" href="#"
               class="btn-primary inline-flex items-center gap-2"
               style="background:linear-gradient(135deg,#e11d48,#9f1239); box-shadow:0 0 16px rgba(225,29,72,0.3);">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
                Ya, Hapus
            </a>
        </div>
    </div>
</div>

{{-- ===== MODAL DETAIL ===== --}}
<div id="detailModal" class="modal-overlay" onclick="handleOverlayClick(event, 'detailModal')">
    <div class="modal-box">
        <div class="modal-header">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center"
                     style="background:linear-gradient(135deg,#3b82f6,#2563eb); box-shadow:0 0 14px rgba(59,130,246,0.35);">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-base font-bold text-white">Detail Genteng</h2>
                    <p class="text-xs" style="color:rgba(107,114,128,0.8);">Informasi lengkap produk genteng</p>
                </div>
            </div>
            <button onclick="modalClose('detailModal')" class="modal-close-btn">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <div class="modal-body form-grid">
            <div class="form-group col-span-2">
                <label class="form-label">Nama Produk</label>
                <div id="detailNama" class="text-white text-sm bg-white/5 px-3 py-2 rounded-lg border border-white/10 min-h-[38px]"></div>
            </div>
            <div class="form-group">
                <label class="form-label">Jenis Genteng</label>
                <div id="detailJenis" class="text-white text-sm bg-white/5 px-3 py-2 rounded-lg border border-white/10 min-h-[38px]"></div>
            </div>
            <div class="form-group">
                <label class="form-label">Harga (Rp)</label>
                <div id="detailHarga" class="text-white text-sm bg-white/5 px-3 py-2 rounded-lg border border-white/10 min-h-[38px]"></div>
            </div>
            <div class="form-group">
                <label class="form-label">Stok (pcs)</label>
                <div id="detailStok" class="text-white text-sm bg-white/5 px-3 py-2 rounded-lg border border-white/10 min-h-[38px]"></div>
            </div>
            <div class="form-group">
                <label class="form-label">Jarak Antar Reng (cm)</label>
                <div id="detailJarakReng" class="text-white text-sm bg-white/5 px-3 py-2 rounded-lg border border-white/10 min-h-[38px]"></div>
            </div>
            <div class="form-group">
                <label class="form-label">Dimensi P x L (cm)</label>
                <div id="detailDimensi" class="text-white text-sm bg-white/5 px-3 py-2 rounded-lg border border-white/10 min-h-[38px]"></div>
            </div>
            <div class="form-group">
                <label class="form-label">Isi per m²</label>
                <div id="detailIsiPerM2" class="text-white text-sm bg-white/5 px-3 py-2 rounded-lg border border-white/10 min-h-[38px]"></div>
            </div>
            <div class="form-group col-span-2">
                <label class="form-label">Deskripsi</label>
                <div id="detailDeskripsi" class="text-white text-sm bg-white/5 px-3 py-2 rounded-lg border border-white/10 min-h-[80px]"></div>
            </div>
            <div class="form-group col-span-2">
                <label class="form-label">Foto Genteng</label>
                <div id="detailFotoWrap" class="hidden mt-2">
                    <img id="detailFoto" src="" alt="Foto Genteng" class="rounded-xl border border-white/10 max-w-full h-auto max-h-64 object-contain">
                </div>
                <div id="detailFotoNone" class="hidden mt-2 w-32 h-32 flex items-center justify-center text-4xl font-bold text-white tracking-widest rounded-xl" style="background: linear-gradient(135deg,rgba(225,29,72,0.6),rgba(159,18,57,0.9));"></div>
            </div>
        </div>
        <div class="modal-footer">
            <button onclick="modalClose('detailModal')" class="btn-secondary">Tutup</button>
        </div>
    </div>
</div>

{{-- ===== STYLES ===== --}}
<style>
/* ---- Modal overlay & box ---- */
.modal-overlay {
    position: fixed; inset: 0; z-index: 1000;
    display: flex; align-items: center; justify-content: center;
    background: rgba(0,0,0,0.75);
    backdrop-filter: blur(6px);
    -webkit-backdrop-filter: blur(6px);
    opacity: 0; visibility: hidden;
    transition: opacity 0.25s ease, visibility 0.25s ease;
}
.modal-overlay.modal-active {
    opacity: 1; visibility: visible;
}
.modal-box {
    width: 100%; max-width: 540px; max-height: 90vh; overflow-y: auto;
    border-radius: 20px; position: relative;
    background: rgba(16,16,16,0.98);
    border: 1px solid rgba(255,255,255,0.10);
    box-shadow: 0 30px 80px rgba(0,0,0,0.7);
    transform: translateY(24px) scale(0.97);
    transition: transform 0.3s cubic-bezier(0.34,1.56,0.64,1), opacity 0.25s ease;
    opacity: 0;
}
.modal-overlay.modal-active .modal-box {
    transform: translateY(0) scale(1);
    opacity: 1;
}

/* ---- Modal sections ---- */
.modal-header {
    display: flex; align-items: center; justify-content: space-between;
    padding: 18px 20px;
    border-bottom: 1px solid rgba(255,255,255,0.07);
}
.modal-body { padding: 20px; }
.modal-footer {
    display: flex; justify-content: flex-end; gap: 10px;
    padding: 16px 20px;
    border-top: 1px solid rgba(255,255,255,0.07);
}
.modal-close-btn {
    width: 32px; height: 32px; border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    background: rgba(255,255,255,0.06);
    color: rgba(156,163,175,0.8);
    transition: background 0.2s, color 0.2s;
    border: 1px solid rgba(255,255,255,0.08);
}
.modal-close-btn:hover { background: rgba(225,29,72,0.15); color: #f87171; }

/* ---- Form elements ---- */
.form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
.form-group { display: flex; flex-direction: column; gap: 6px; }
.form-group.col-span-2 { grid-column: span 2; }
.form-label { font-size: 12px; font-weight: 600; color: rgba(209,213,219,0.9); }
.form-input {
    width: 100%; padding: 10px 14px; border-radius: 12px; font-size: 13px;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.10);
    color: white; outline: none;
    transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
}
.form-input::placeholder { color: rgba(107,114,128,0.6); }
.form-input:focus {
    border-color: #e11d48;
    background: rgba(225,29,72,0.05);
    box-shadow: 0 0 0 3px rgba(225,29,72,0.15);
}
select.form-input option { background: #1a1a1a; color: white; }

/* ---- Buttons ---- */
.btn-primary {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 9px 18px; border-radius: 12px;
    font-size: 13px; font-weight: 600; color: white;
    background: linear-gradient(135deg, #e11d48, #9f1239);
    box-shadow: 0 0 16px rgba(225,29,72,0.3);
    transition: box-shadow 0.25s, transform 0.2s;
    cursor: pointer;
}
.btn-primary:hover { box-shadow: 0 0 24px rgba(225,29,72,0.55); transform: scale(1.02); }
.btn-secondary {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 9px 18px; border-radius: 12px;
    font-size: 13px; font-weight: 600;
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.10);
    color: rgba(156,163,175,0.9);
    transition: background 0.2s, color 0.2s;
    cursor: pointer;
}
.btn-secondary:hover { background: rgba(255,255,255,0.1); color: white; }

@media (max-width: 480px) {
    .form-grid { grid-template-columns: 1fr; }
    .form-group.col-span-2 { grid-column: span 1; }
    .modal-box { border-radius: 16px 16px 0 0; margin-top: auto; max-height: 85vh; }
    .modal-overlay { align-items: flex-end; }
}

/* ---- Foto upload area ---- */
.foto-upload-area {
    border: 1.5px dashed rgba(255,255,255,0.12);
    border-radius: 12px; padding: 14px;
    cursor: pointer;
    transition: border-color 0.2s, background 0.2s;
    text-align: center; min-height: 62px;
    display: flex; align-items: center; justify-content: center;
}
.foto-upload-area:hover {
    border-color: rgba(225,29,72,0.4);
    background: rgba(225,29,72,0.04);
}
</style>

{{-- ===== SCRIPTS ===== --}}
<script>
    /* ---- Core modal functions ---- */
    function modalOpen(id) {
        const el = document.getElementById(id);
        el.classList.add('modal-active');
        document.body.style.overflow = 'hidden';
    }

    function modalClose(id) {
        const el = document.getElementById(id);
        el.classList.remove('modal-active');
        document.body.style.overflow = '';
    }

    function handleOverlayClick(e, id) {
        if (e.target === document.getElementById(id)) modalClose(id);
    }

    /* Close on ESC */
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            ['tambahModal','editModal','detailModal','deleteModal'].forEach(id => modalClose(id));
        }
    });

    /* ---- Detail modal ---- */
    function openDetailModal(data) {
        document.getElementById('detailNama').textContent = data.nama || '-';
        document.getElementById('detailJenis').textContent = data.jenis || '-';
        document.getElementById('detailHarga').textContent = 'Rp ' + (data.harga ? new Intl.NumberFormat('id-ID').format(data.harga) : '0');
        const formatUnit = (val, unit) => {
            if (!val || String(val).trim() === '') return '-';
            const str = String(val).trim();
            return str.toLowerCase().includes(unit.toLowerCase()) ? str : str + ' ' + unit;
        };

        document.getElementById('detailStok').textContent = data.stok != null && data.stok !== '' ? new Intl.NumberFormat('id-ID').format(data.stok) + ' pcs' : '-';
        document.getElementById('detailJarakReng').textContent = formatUnit(data.jarak_reng, 'cm');
        document.getElementById('detailDimensi').textContent = formatUnit(data.dimensi, 'cm');
        document.getElementById('detailIsiPerM2').textContent = formatUnit(data.isi_per_m2, 'pcs');
        document.getElementById('detailDeskripsi').textContent = data.deskripsi || 'Tidak ada deskripsi';
        
        const photoWrap = document.getElementById('detailFotoWrap');
        const photoImg = document.getElementById('detailFoto');
        const photoNone = document.getElementById('detailFotoNone');
        
        if (data.foto) {
            photoImg.src = '/uploads/genteng/' + data.foto;
            photoWrap.classList.remove('hidden');
            photoNone.classList.add('hidden');
        } else {
            photoImg.src = '';
            photoWrap.classList.add('hidden');
            
            const words = (data.nama || '').trim().split(' ');
            let inisial = '';
            if (words.length >= 2) {
                inisial = (words[0].substring(0, 1) + words[1].substring(0, 1)).toUpperCase();
            } else if (words.length === 1 && words[0] !== '') {
                inisial = words[0].substring(0, 2).toUpperCase();
            } else {
                inisial = 'GT';
            }
            photoNone.textContent = inisial;
            
            photoNone.classList.remove('hidden');
        }
        
        modalOpen('detailModal');
    }

    /* ---- Edit modal ---- */
    function openEditModal(data) {
        document.getElementById('editNama').value      = data.nama      || '';
        document.getElementById('editJenis').value     = data.jenis     || '';
        document.getElementById('editHarga').value     = data.harga     || '';
        document.getElementById('editStok').value      = data.stok      || '';
        document.getElementById('editDeskripsi').value = data.deskripsi || '';
        document.getElementById('editJarakReng').value = data.jarak_reng || '';
        document.getElementById('editDimensi').value   = data.dimensi || '';
        document.getElementById('editIsiPerM2').value  = data.isi_per_m2 || '';
        document.getElementById('editForm').action     = '/admin/genteng/update/' + data.id;

        // Reset upload area
        clearEditFoto(null);

        // Tampilkan foto saat ini jika ada
        const currentWrap = document.getElementById('editFotoCurrentWrap');
        const currentImg  = document.getElementById('editFotoCurrentImg');
        const currentName = document.getElementById('editFotoCurrentName');
        const deleteBtn   = document.getElementById('editFotoDeleteBtn');

        if (data.foto) {
            currentImg.src          = '/uploads/genteng/' + data.foto;
            currentName.textContent = data.foto;
            deleteBtn.href          = '/admin/genteng/delete-foto/' + data.id;
            currentWrap.classList.remove('hidden');
        } else {
            currentWrap.classList.add('hidden');
        }

        modalOpen('editModal');
    }

    /* ---- Delete modal ---- */
    function openDeleteModal(id, nama) {
        document.getElementById('deleteNama').textContent = nama || 'produk ini';
        document.getElementById('deleteLink').href        = '/admin/genteng/delete/' + id;
        modalOpen('deleteModal');
    }

    /* ---- Toggle Unggulan ---- */
    function toggleUnggulan(id, btnElement) {
        // Find icon
        const icon = btnElement.querySelector('.star-icon');
        
        fetch(`/admin/genteng/toggle-unggulan/${id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                // Update icon color
                if (data.is_unggulan) {
                    icon.classList.remove('text-gray-500');
                    icon.classList.add('text-yellow-400');
                    icon.setAttribute('fill', 'currentColor');
                    btnElement.setAttribute('title', 'Hapus dari Unggulan');
                } else {
                    icon.classList.remove('text-yellow-400');
                    icon.classList.add('text-gray-500');
                    icon.setAttribute('fill', 'none');
                    btnElement.setAttribute('title', 'Jadikan Unggulan');
                }
                showFlash(data.message, 'success');
            } else {
                showFlash(data.message || data.error, 'error');
            }
        })
        .catch(err => {
            showFlash('Terjadi kesalahan pada server.', 'error');
        });
    }

    function showFlash(message, type) {
        // Remove existing flash message if any
        const existingError = document.getElementById('flash-error');
        if (existingError) existingError.remove();
        const existingSuccess = document.getElementById('flash-msg');
        if (existingSuccess) existingSuccess.remove();

        const flashDiv = document.createElement('div');
        flashDiv.id = type === 'error' ? 'flash-error' : 'flash-msg';
        flashDiv.className = `flex items-center gap-3 rounded-2xl px-4 py-3 mb-6 text-sm flash-dynamic`;
        
        if (type === 'error') {
            flashDiv.style = "background: rgba(225,29,72,0.12); border: 1px solid rgba(225,29,72,0.25); color: #f87171;";
            flashDiv.innerHTML = `
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                ${message}
                <button onclick="this.parentElement.remove()" class="ml-auto opacity-60 hover:opacity-100 transition">✕</button>
            `;
        } else {
            flashDiv.style = "background: rgba(34,197,94,0.12); border: 1px solid rgba(34,197,94,0.25); color: #4ade80;";
            flashDiv.innerHTML = `
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                ${message}
                <button onclick="this.parentElement.remove()" class="ml-auto opacity-60 hover:opacity-100 transition">✕</button>
            `;
        }
        
        // Insert at the top of the table card
        const tableCard = document.querySelector('.overflow-x-auto').parentElement;
        tableCard.parentNode.insertBefore(flashDiv, tableCard);

        setTimeout(() => {
            if (document.body.contains(flashDiv)) {
                flashDiv.style.transition = 'opacity 0.5s';
                flashDiv.style.opacity = '0';
                setTimeout(() => flashDiv.remove(), 500);
            }
        }, 5000);
    }

    /* Flash auto-hide */
    setTimeout(function(){
        const el = document.getElementById('flash-msg');
        if (el) { el.style.transition='opacity 0.5s'; el.style.opacity='0'; setTimeout(()=>el.remove(),500); }
        const err = document.getElementById('flash-error');
        if (err) { err.style.transition='opacity 0.5s'; err.style.opacity='0'; setTimeout(()=>err.remove(),500); }
    }, 4000);

    /* ---- Foto Tambah ---- */
    function handleTambahFotoPreview(input) {
        if (!input.files || !input.files[0]) return;
        const file = input.files[0];
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('tambahFotoPreview').src = e.target.result;
            document.getElementById('tambahFotoName').textContent = file.name;
            document.getElementById('tambahFotoPreviewWrap').classList.remove('hidden');
            document.getElementById('tambahFotoPlaceholder').classList.add('hidden');
        };
        reader.readAsDataURL(file);
    }
    function clearTambahFoto(e) {
        if (e) e.stopPropagation();
        document.getElementById('tambahFotoInput').value = '';
        document.getElementById('tambahFotoPreviewWrap').classList.add('hidden');
        document.getElementById('tambahFotoPlaceholder').classList.remove('hidden');
    }

    /* ---- Foto Edit ---- */
    function handleEditFotoPreview(input) {
        if (!input.files || !input.files[0]) return;
        const file = input.files[0];
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('editFotoPreview').src = e.target.result;
            document.getElementById('editFotoName').textContent = file.name;
            document.getElementById('editFotoPreviewWrap').classList.remove('hidden');
            document.getElementById('editFotoPlaceholder').classList.add('hidden');
        };
        reader.readAsDataURL(file);
    }
    function clearEditFoto(e) {
        if (e) e.stopPropagation();
        const input = document.getElementById('editFotoInput');
        if (input) input.value = '';
        const pw = document.getElementById('editFotoPreviewWrap');
        const ph = document.getElementById('editFotoPlaceholder');
        if (pw) pw.classList.add('hidden');
        if (ph) ph.classList.remove('hidden');
    }
</script>

@endsection
