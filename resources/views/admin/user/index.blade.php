@extends('layouts.app')
@section('title', 'Manajemen User - Genteng Dwijaya')

@section('content')

{{-- ===== PAGE HEADER ===== --}}
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
    <div>
        <div class="flex items-center gap-2 mb-1">
            <div class="w-1 h-6 rounded-full" style="background: linear-gradient(180deg,#e11d48,#f97316);"></div>
            <p class="text-xs font-semibold uppercase tracking-widest" style="color: rgba(225,29,72,0.8);">Sistem</p>
        </div>
        <h1 class="text-2xl md:text-3xl font-black text-white">Manajemen User</h1>
        <p class="text-sm mt-1" style="color: rgba(107,114,128,0.9);">Kelola akun administrator sistem</p>
    </div>
    <button onclick="modalOpen('tambahModal')"
        class="inline-flex items-center gap-2 text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition-all self-start sm:self-auto"
        style="background: linear-gradient(135deg,#e11d48,#9f1239); box-shadow: 0 0 20px rgba(225,29,72,0.35);"
        onmouseover="this.style.boxShadow='0 0 30px rgba(225,29,72,0.55)'; this.style.transform='scale(1.03)'"
        onmouseout="this.style.boxShadow='0 0 20px rgba(225,29,72,0.35)'; this.style.transform='scale(1)'">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
        </svg>
        Tambah User
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <span class="text-sm font-semibold text-white">Daftar Administrator</span>
        </div>
        <span class="text-xs px-2.5 py-1 rounded-full font-medium"
              style="background: rgba(225,29,72,0.12); color: #f87171; border: 1px solid rgba(225,29,72,0.2);">
            {{ $users->count() }} user
        </span>
    </div>

    <div class="p-4 overflow-x-auto">
        <table id="dataTable" class="min-w-full text-sm">
            <thead>
                <tr>
                    <th class="p-3 text-left">No</th>
                    <th class="p-3 text-left">User</th>
                    <th class="p-3 text-left">Email</th>
                    <th class="p-3 text-left">Role</th>
                    <th class="p-3 text-left">Login Terakhir</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $i => $u)
                <tr>
                    <td class="px-3 py-3">
                        <span class="text-xs font-semibold" style="color: rgba(107,114,128,0.7);">{{ $i+1 }}</span>
                    </td>
                    <td class="px-3 py-3">
                        <div class="flex items-center gap-3">
                            {{-- Avatar --}}
                            @if($u->foto)
                                <img src="{{ asset('uploads/user/' . $u->foto) }}"
                                     alt="{{ $u->nama }}"
                                     class="w-9 h-9 rounded-full object-cover flex-shrink-0">
                                     <!-- style="box-shadow: 0 0 0 2px rgba(225,29,72,0.35);"> -->
                            @else
                                <div class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-bold text-white flex-shrink-0"
                                     style="background: linear-gradient(135deg,#e11d48,#9f1239); box-shadow: 0 0 0 2px rgba(225,29,72,0.25);">
                                    {{ strtoupper(substr($u->nama, 0, 1)) }}
                                </div>
                            @endif
                            <div>
                                <p class="font-semibold text-white leading-tight">{{ $u->nama }}</p>
                                <p class="text-xs" style="color: rgba(107,114,128,0.7);">ID #{{ $u->id }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-3 py-3">
                        <div class="flex items-center gap-2">
                            <svg class="w-3.5 h-3.5 flex-shrink-0" style="color: rgba(107,114,128,0.5);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                            </svg>
                            <span style="color: rgba(209,213,219,0.85);">{{ $u->email }}</span>
                        </div>
                    </td>
                    <td class="px-3 py-3">
                        <span class="text-xs font-semibold px-2.5 py-1 rounded-full"
                              style="background: rgba(59,130,246,0.15); color: #60a5fa; border: 1px solid rgba(59,130,246,0.25);">
                            Administrator
                        </span>
                    </td>
                    <td class="px-3 py-3">
                        <span class="text-xs" style="color: rgba(107,114,128,0.7);">
                            {{ $u->last_login ? \Carbon\Carbon::parse($u->last_login)->diffForHumans() : 'Belum pernah' }}
                        </span>
                    </td>
                    <td class="px-3 py-3">
                        <div class="flex items-center justify-center gap-2">
                            <button onclick='openEditModal(@json($u))'
                                title="Edit User"
                                class="w-8 h-8 flex items-center justify-center rounded-lg transition-all"
                                style="background:rgba(245,158,11,0.15); color:#fbbf24; border:1px solid rgba(245,158,11,0.25);"
                                onmouseover="this.style.background='rgba(245,158,11,0.3)'"
                                onmouseout="this.style.background='rgba(245,158,11,0.15)'">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </button>
                            <button onclick="openDeleteModal({{ $u->id }}, '{{ addslashes($u->nama) }}')"
                                title="Hapus User"
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-base font-bold text-white">Tambah User</h2>
                    <p class="text-xs" style="color:rgba(107,114,128,0.8);">Buat akun administrator baru</p>
                </div>
            </div>
            <button onclick="modalClose('tambahModal')" class="modal-close-btn">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <form method="POST" action="/admin/user/store" enctype="multipart/form-data" class="modal-body">
            @csrf
            <div class="form-grid">
                <div class="form-group col-span-2">
                    <label class="form-label">Nama Lengkap <span style="color:#e11d48">*</span></label>
                    <input type="text" name="nama" placeholder="cth. Budi Santoso" class="form-input" required>
                </div>
                <div class="form-group col-span-2">
                    <label class="form-label">Alamat Email <span style="color:#e11d48">*</span></label>
                    <div style="position:relative;">
                        <input type="email" name="email" placeholder="nama@email.com" class="form-input" style="padding-left:36px;" required>
                        <svg class="w-4 h-4" style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:rgba(107,114,128,0.5);pointer-events:none;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                        </svg>
                    </div>
                </div>
                <div class="form-group col-span-2">
                    <label class="form-label">Password <span style="color:#e11d48">*</span></label>
                    <div style="position:relative;">
                        <input type="password" name="password" id="tambahPw" placeholder="Min. 5 karakter" class="form-input" style="padding-left:36px; padding-right:40px;" required minlength="5">
                        <svg class="w-4 h-4" style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:rgba(107,114,128,0.5);pointer-events:none;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <button type="button" onclick="togglePw('tambahPw', this)" class="pw-toggle-btn">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="form-group col-span-2">
                    <label class="form-label">Foto Profil <span style="color:rgba(107,114,128,0.6); font-weight:400;">(opsional)</span></label>
                    <div class="file-upload-area" onclick="document.getElementById('tambahFoto').click()">
                        <svg class="w-6 h-6 mb-1" style="color:rgba(107,114,128,0.5);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p id="tambahFotoLabel" class="text-xs" style="color:rgba(107,114,128,0.7);">Klik untuk pilih gambar (JPG, PNG)</p>
                        <input type="file" id="tambahFoto" name="foto" accept="image/*" class="hidden"
                               onchange="previewFoto(this, 'tambahFotoLabel', 'tambahPreview')">
                    </div>
                    <img id="tambahPreview" src="" alt="" class="hidden mt-2 w-16 h-16 rounded-full object-cover" style="border: 2px solid rgba(225,29,72,0.3);">
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
                    <h2 class="text-base font-bold text-white">Edit User</h2>
                    <p class="text-xs" style="color:rgba(107,114,128,0.8);">Perbarui data akun administrator</p>
                </div>
            </div>
            <button onclick="modalClose('editModal')" class="modal-close-btn">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Current avatar preview --}}
        <div class="px-5 pt-4 flex items-center gap-3">
            <div id="editAvatarWrap">
                <div id="editAvatarInitial"
                     class="w-12 h-12 rounded-full flex items-center justify-center text-lg font-black text-white"
                     style="background: linear-gradient(135deg,#e11d48,#9f1239); box-shadow: 0 0 0 2px rgba(225,29,72,0.3);">
                </div>
            </div>
            <div>
                <p id="editPreviewNama" class="text-sm font-semibold text-white"></p>
                <p class="text-xs" style="color:rgba(107,114,128,0.7);">Administrator</p>
            </div>
        </div>

        <form id="editForm" method="POST" enctype="multipart/form-data" class="modal-body" style="padding-top:14px;">
            @csrf
            <div class="form-grid">
                <div class="form-group col-span-2">
                    <label class="form-label">Nama Lengkap <span style="color:#e11d48">*</span></label>
                    <input type="text" name="nama" id="editNama" class="form-input" required
                           oninput="document.getElementById('editPreviewNama').textContent=this.value; document.getElementById('editAvatarInitial').textContent=this.value.charAt(0).toUpperCase()">
                </div>
                <div class="form-group col-span-2">
                    <label class="form-label">Alamat Email <span style="color:#e11d48">*</span></label>
                    <div style="position:relative;">
                        <input type="email" name="email" id="editEmail" class="form-input" style="padding-left:36px;" required>
                        <svg class="w-4 h-4" style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:rgba(107,114,128,0.5);pointer-events:none;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                        </svg>
                    </div>
                </div>
                <div class="form-group col-span-2">
                    <label class="form-label">Password Baru
                        <span style="color:rgba(107,114,128,0.6); font-weight:400;">(kosongkan jika tidak diubah)</span>
                    </label>
                    <div style="position:relative;">
                        <input type="password" name="password" id="editPw" placeholder="Masukkan password baru..." class="form-input" style="padding-left:36px; padding-right:40px;">
                        <svg class="w-4 h-4" style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:rgba(107,114,128,0.5);pointer-events:none;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <button type="button" onclick="togglePw('editPw', this)" class="pw-toggle-btn">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="form-group col-span-2">
                    <label class="form-label">Ganti Foto Profil <span style="color:rgba(107,114,128,0.6); font-weight:400;">(opsional)</span></label>
                    <div class="file-upload-area" onclick="document.getElementById('editFotoInput').click()">
                        <svg class="w-6 h-6 mb-1" style="color:rgba(107,114,128,0.5);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p id="editFotoLabel" class="text-xs" style="color:rgba(107,114,128,0.7);">Klik untuk pilih gambar baru</p>
                        <input type="file" id="editFotoInput" name="foto" accept="image/*" class="hidden"
                               onchange="previewFoto(this, 'editFotoLabel', 'editFotoPreview')">
                    </div>
                    <img id="editFotoPreview" src="" alt="" class="hidden mt-2 w-16 h-16 rounded-full object-cover" style="border: 2px solid rgba(245,158,11,0.4);">
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
            <p class="text-sm" style="color:rgba(156,163,175,0.9);">Anda yakin ingin menghapus user:</p>
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


{{-- ===== STYLES (sama dengan genteng) ===== --}}
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

/* Password toggle */
.pw-toggle-btn {
    position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
    color: rgba(107,114,128,0.6); background: none; border: none; cursor: pointer;
    transition: color 0.2s;
}
.pw-toggle-btn:hover { color: #e11d48; }

/* File upload area */
.file-upload-area {
    border: 1.5px dashed rgba(255,255,255,0.12);
    border-radius: 12px; padding: 16px;
    display: flex; flex-direction: column; align-items: center; justify-content: center;
    cursor: pointer; transition: border-color 0.2s, background 0.2s;
    min-height: 72px;
}
.file-upload-area:hover {
    border-color: rgba(225,29,72,0.4);
    background: rgba(225,29,72,0.04);
}

/* Buttons */
.btn-primary {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 9px 18px; border-radius: 12px;
    font-size: 13px; font-weight: 600; color: white;
    background: linear-gradient(135deg, #e11d48, #9f1239);
    box-shadow: 0 0 16px rgba(225,29,72,0.3);
    transition: box-shadow 0.25s, transform 0.2s;
    cursor: pointer; text-decoration: none;
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
    .modal-box { border-radius: 16px 16px 0 0; max-height: 85vh; }
    .modal-overlay { align-items: flex-end; }
}
</style>


{{-- ===== SCRIPTS ===== --}}
<script>
    /* ---- Core modal functions (sama dengan halaman genteng) ---- */
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
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            ['tambahModal','editModal','deleteModal'].forEach(id => modalClose(id));
        }
    });

    /* ---- Edit modal ---- */
    function openEditModal(user) {
        document.getElementById('editNama').value  = user.nama  || '';
        document.getElementById('editEmail').value = user.email || '';
        document.getElementById('editPw').value    = '';
        document.getElementById('editForm').action = '/admin/user/update/' + user.id;

        // Update preview nama & inisial
        document.getElementById('editPreviewNama').textContent    = user.nama || '';
        document.getElementById('editAvatarInitial').textContent  = (user.nama || '?').charAt(0).toUpperCase();

        // Reset foto preview
        const prev = document.getElementById('editFotoPreview');
        prev.classList.add('hidden'); prev.src = '';
        document.getElementById('editFotoLabel').textContent = 'Klik untuk pilih gambar baru';

        modalOpen('editModal');
    }

    /* ---- Delete modal ---- */
    function openDeleteModal(id, nama) {
        document.getElementById('deleteNama').textContent = nama || 'user ini';
        document.getElementById('deleteLink').href        = '/admin/user/delete/' + id;
        modalOpen('deleteModal');
    }

    /* ---- Toggle password visibility ---- */
    function togglePw(inputId, btn) {
        const input = document.getElementById(inputId);
        const isHidden = input.type === 'password';
        input.type = isHidden ? 'text' : 'password';
        btn.style.color = isHidden ? '#e11d48' : '';
    }

    /* ---- Foto preview ---- */
    function previewFoto(input, labelId, previewId) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const prev = document.getElementById(previewId);
                prev.src = e.target.result;
                prev.classList.remove('hidden');
                document.getElementById(labelId).textContent = input.files[0].name;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    /* ---- Flash auto-hide ---- */
    setTimeout(function() {
        const el = document.getElementById('flash-msg');
        if (el) {
            el.style.transition = 'opacity 0.5s ease';
            el.style.opacity = '0';
            setTimeout(() => el.remove(), 500);
        }
    }, 4000);
</script>

@endsection
