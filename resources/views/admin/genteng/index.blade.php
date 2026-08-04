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
                    <th class="p-3 text-left">Nama Produk</th>
                    <th class="p-3 text-left">Jenis</th>
                    <th class="p-3 text-left">Harga</th>
                    <th class="p-3 text-left">Stok</th>
                    <th class="p-3 text-left">Deskripsi</th>
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
                            <div class="w-8 h-8 rounded-lg flex items-center justify-center text-xs font-bold text-white flex-shrink-0"
                                 style="background: linear-gradient(135deg,rgba(225,29,72,0.6),rgba(159,18,57,0.9));">
                                {{ strtoupper(substr($d->nama, 0, 1)) }}
                            </div>
                            <span class="font-medium text-white">{{ $d->nama }}</span>
                        </div>
                    </td>
                    <td class="px-3 py-3">
                        @php
                            $jenisStyle = [
                                'Tanah Liat' => 'background:rgba(225,29,72,0.15);color:#f87171;border:1px solid rgba(225,29,72,0.25)',
                                'Keramik'    => 'background:rgba(249,115,22,0.15);color:#fb923c;border:1px solid rgba(249,115,22,0.25)',
                                'Beton'      => 'background:rgba(168,85,247,0.15);color:#c084fc;border:1px solid rgba(168,85,247,0.25)',
                                'Metal'      => 'background:rgba(20,184,166,0.15);color:#2dd4bf;border:1px solid rgba(20,184,166,0.25)',
                                'Fiber'      => 'background:rgba(59,130,246,0.15);color:#60a5fa;border:1px solid rgba(59,130,246,0.25)',
                                'Reng'       => 'background:rgba(245,158,11,0.15);color:#fbbf24;border:1px solid rgba(245,158,11,0.25)',
                            ];
                            $style = $jenisStyle[$d->jenis] ?? 'background:rgba(255,255,255,0.08);color:#9ca3af;border:1px solid rgba(255,255,255,0.12)';
                        @endphp
                        <span class="text-xs font-semibold px-2.5 py-1 rounded-full" style="{{ $style }}">
                            {{ $d->jenis }}
                        </span>
                    </td>
                    <td class="px-3 py-3">
                        <span class="font-semibold text-white">Rp {{ number_format($d->harga) }}</span>
                    </td>
                    <td class="px-3 py-3">
                        @php $stokClass = $d->stok <= 50 ? 'color:#fca5a5' : 'color:#4ade80'; @endphp
                        <span class="font-semibold" style="{{ $stokClass }}">
                            {{ number_format($d->stok) }}
                        </span>
                        <span class="text-xs ml-1" style="color:rgba(107,114,128,0.6);">lbr</span>
                    </td>
                    <td class="px-3 py-3">
                        <span class="text-xs" style="color:rgba(156,163,175,0.75);">
                            {{ $d->deskripsi ? Str::limit($d->deskripsi, 40) : '-' }}
                        </span>
                    </td>
                    <td class="px-3 py-3">
                        <div class="flex items-center justify-center gap-2">
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

        <form method="POST" action="/admin/genteng/store" class="modal-body">
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
                        <option value="Tanah Liat">Tanah Liat</option>
                        <option value="Keramik">Keramik</option>
                        <option value="Beton">Beton</option>
                        <option value="Metal">Metal</option>
                        <option value="Fiber">Fiber</option>
                        <option value="Reng">Reng</option>
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
                <div class="form-group col-span-2">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" rows="3" placeholder="Deskripsi singkat produk..." class="form-input resize-none"></textarea>
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

        <form id="editForm" method="POST" class="modal-body">
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
                        <option value="Tanah Liat">Tanah Liat</option>
                        <option value="Keramik">Keramik</option>
                        <option value="Beton">Beton</option>
                        <option value="Metal">Metal</option>
                        <option value="Fiber">Fiber</option>
                        <option value="Reng">Reng</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Harga (Rp)</label>
                    <input type="number" name="harga" id="editHarga" class="form-input" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Stok (lembar)</label>
                    <input type="number" name="stok" id="editStok" class="form-input" min="0">
                </div>
                <div class="form-group col-span-2">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" id="editDeskripsi" rows="3" class="form-input resize-none"></textarea>
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
            ['tambahModal','editModal','deleteModal'].forEach(id => modalClose(id));
        }
    });

    /* ---- Edit modal ---- */
    function openEditModal(data) {
        document.getElementById('editNama').value     = data.nama    || '';
        document.getElementById('editJenis').value    = data.jenis   || '';
        document.getElementById('editHarga').value    = data.harga   || '';
        document.getElementById('editStok').value     = data.stok    || '';
        document.getElementById('editDeskripsi').value = data.deskripsi || '';
        document.getElementById('editForm').action   = '/admin/genteng/update/' + data.id;
        modalOpen('editModal');
    }

    /* ---- Delete modal ---- */
    function openDeleteModal(id, nama) {
        document.getElementById('deleteNama').textContent = nama || 'produk ini';
        document.getElementById('deleteLink').href        = '/admin/genteng/delete/' + id;
        modalOpen('deleteModal');
    }

    /* Flash auto-hide */
    setTimeout(function(){
        const el = document.getElementById('flash-msg');
        if (el) el.remove();
    }, 4000);
</script>

@endsection
