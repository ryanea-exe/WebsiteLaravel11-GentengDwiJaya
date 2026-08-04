@extends('layouts.app')
@section('title', 'Edit Profile - ' . $appSetting->app_name)

@section('content')

{{-- ===== PAGE HEADER ===== --}}
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
    <div>
        <div class="flex items-center gap-2 mb-1">
            <div class="w-1 h-6 rounded-full" style="background: linear-gradient(180deg,#e11d48,#f97316);"></div>
            <p class="text-xs font-semibold uppercase tracking-widest" style="color: rgba(225,29,72,0.8);">Akun Saya</p>
        </div>
        <h1 class="text-2xl md:text-3xl font-black text-white">Edit Profile</h1>
        <p class="text-sm mt-1" style="color: rgba(107,114,128,0.9);">Perbarui informasi akun dan foto profil Anda</p>
    </div>
    <a href="{{ route('admin.dashboard') }}"
       class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-medium transition"
       style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.09); color:rgba(156,163,175,0.9);"
       onmouseover="this.style.background='rgba(255,255,255,0.09)'; this.style.color='white';"
       onmouseout="this.style.background='rgba(255,255,255,0.05)'; this.style.color='rgba(156,163,175,0.9)';">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Kembali
    </a>
</div>

{{-- ===== FLASH ===== --}}
@if(session('success'))
<div id="flash-msg" class="flex items-center gap-3 rounded-2xl px-4 py-3 mb-6 text-sm"
     style="background: rgba(34,197,94,0.12); border: 1px solid rgba(34,197,94,0.25); color: #4ade80;">
    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
    {{ session('success') }}
    <button onclick="document.getElementById('flash-msg').remove()" class="ml-auto opacity-60 hover:opacity-100">✕</button>
</div>
@endif

@if($errors->any())
<div class="flex items-start gap-3 rounded-2xl px-4 py-3 mb-6 text-sm"
     style="background: rgba(225,29,72,0.10); border: 1px solid rgba(225,29,72,0.25); color: #f87171;">
    <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
    </svg>
    <ul class="list-disc list-inside space-y-0.5">
        @foreach($errors->all() as $err) <li>{{ $err }}</li> @endforeach
    </ul>
</div>
@endif

<div class="grid lg:grid-cols-3 gap-6">

    {{-- ===== KIRI: AVATAR ===== --}}
    <div class="lg:col-span-1">
        <div class="rounded-2xl p-5 sticky top-24" style="background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.07);">
            <p class="text-xs font-semibold uppercase tracking-widest mb-4" style="color:rgba(225,29,72,0.7);">Foto Profil</p>

            {{-- Avatar display --}}
            <div class="flex flex-col items-center gap-4">
                <div class="relative group">
                    <div id="avatarWrap"
                         class="w-28 h-28 rounded-full overflow-hidden flex items-center justify-center flex-shrink-0"
                         style="background:linear-gradient(135deg,#e11d48,#9f1239); box-shadow: 0 0 24px rgba(225,29,72,0.35);">
                        @if($user->foto)
                            <img id="avatarImg" src="{{ asset('uploads/user/' . $user->foto) }}"
                                 alt="Avatar" class="w-full h-full object-cover">
                        @else
                            <span id="avatarInitial" class="text-4xl font-black text-white">
                                {{ strtoupper(substr($user->nama, 0, 1)) }}
                            </span>
                        @endif
                    </div>
                    {{-- Overlay klik --}}
                    <label for="fotoInput"
                           class="absolute inset-0 rounded-full flex items-center justify-center cursor-pointer opacity-0 group-hover:opacity-100 transition-all duration-200"
                           style="background:rgba(0,0,0,0.55); backdrop-filter:blur(2px);">
                        <div class="flex flex-col items-center gap-1">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="text-white text-xs font-medium">Ubah</span>
                        </div>
                    </label>
                </div>

                <div class="text-center">
                    <p class="text-sm font-semibold text-white">{{ $user->nama }}</p>
                    <p class="text-xs mt-0.5" style="color:rgba(107,114,128,0.7);">{{ $user->email }}</p>
                    <span class="inline-block mt-2 text-xs px-3 py-1 rounded-full font-medium"
                          style="background:rgba(225,29,72,0.12); color:#f87171; border:1px solid rgba(225,29,72,0.2);">
                        Administrator
                    </span>
                </div>

                {{-- File info --}}
                <div class="w-full text-center">
                    <p id="fotoLabel" class="text-xs" style="color:rgba(107,114,128,0.6);">
                        JPG, PNG, WebP · Maks 2MB
                    </p>
                    <p class="text-xs mt-1" style="color:rgba(107,114,128,0.5);">Hover foto untuk mengganti</p>
                </div>
            </div>

            {{-- Info card --}}
            <div class="mt-5 rounded-xl p-3 text-xs" style="background:rgba(225,29,72,0.07); border:1px solid rgba(225,29,72,0.14);">
                <p class="font-semibold mb-1" style="color:#f87171;">💡 Tips Foto Profil</p>
                <p style="color:rgba(156,163,175,0.7);">Gunakan foto persegi (1:1) dengan resolusi minimal 200×200px untuk tampilan terbaik.</p>
            </div>
        </div>
    </div>

    {{-- ===== KANAN: FORM ===== --}}
    <div class="lg:col-span-2">
        <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
            @csrf
            {{-- Input foto tersembunyi --}}
            <input type="file" id="fotoInput" name="foto" accept=".jpg,.jpeg,.png,.webp"
                   class="hidden" onchange="handleAvatarPreview(this)">

            {{-- SECTION: Informasi Dasar --}}
            <div class="rounded-2xl mb-5" style="background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.07);">
                <div class="px-5 py-4 flex items-center gap-3" style="border-bottom:1px solid rgba(255,255,255,0.06);">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:rgba(225,29,72,0.13);">
                        <svg class="w-4 h-4" style="color:#e11d48;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-white">Informasi Dasar</p>
                        <p class="text-xs" style="color:rgba(107,114,128,0.8);">Nama dan alamat email akun Anda</p>
                    </div>
                </div>
                <div class="p-5 grid sm:grid-cols-2 gap-4">
                    {{-- Nama --}}
                    <div>
                        <label class="block text-xs font-semibold mb-2" style="color:rgba(209,213,219,0.9);">
                            Nama Lengkap <span style="color:#e11d48">*</span>
                        </label>
                        <input type="text" name="nama"
                               value="{{ old('nama', $user->nama) }}"
                               placeholder="Nama lengkap Anda"
                               required maxlength="100"
                               class="profile-input {{ $errors->has('nama') ? 'input-error' : '' }}">
                        @error('nama')
                            <p class="text-xs mt-1" style="color:#f87171;">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="block text-xs font-semibold mb-2" style="color:rgba(209,213,219,0.9);">
                            Alamat Email <span style="color:#e11d48">*</span>
                        </label>
                        <input type="email" name="email"
                               value="{{ old('email', $user->email) }}"
                               placeholder="email@contoh.com"
                               required
                               class="profile-input {{ $errors->has('email') ? 'input-error' : '' }}">
                        @error('email')
                            <p class="text-xs mt-1" style="color:#f87171;">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- SECTION: Keamanan / Password --}}
            <div class="rounded-2xl mb-5" style="background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.07);">
                <div class="px-5 py-4 flex items-center gap-3" style="border-bottom:1px solid rgba(255,255,255,0.06);">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:rgba(249,115,22,0.13);">
                        <svg class="w-4 h-4" style="color:#fb923c;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-white">Keamanan Akun</p>
                        <p class="text-xs" style="color:rgba(107,114,128,0.8);">Kosongkan jika tidak ingin mengganti password</p>
                    </div>
                </div>
                <div class="p-5 grid sm:grid-cols-2 gap-4">
                    {{-- Password --}}
                    <div>
                        <label class="block text-xs font-semibold mb-2" style="color:rgba(209,213,219,0.9);">
                            Password Baru
                        </label>
                        <div class="relative">
                            <input type="password" name="password" id="passInput"
                                   placeholder="Min. 5 karakter"
                                   class="profile-input pr-10 {{ $errors->has('password') ? 'input-error' : '' }}">
                            <button type="button" onclick="togglePass('passInput','eyePass')"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-300 transition">
                                <svg id="eyePass" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-xs mt-1" style="color:#f87171;">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div>
                        <label class="block text-xs font-semibold mb-2" style="color:rgba(209,213,219,0.9);">
                            Konfirmasi Password Baru
                        </label>
                        <div class="relative">
                            <input type="password" name="password_confirmation" id="passConfInput"
                                   placeholder="Ulangi password baru"
                                   class="profile-input pr-10">
                            <button type="button" onclick="togglePass('passConfInput','eyePassConf')"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-300 transition">
                                <svg id="eyePassConf" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Password strength hint --}}
                    <div class="sm:col-span-2">
                        <div class="flex items-start gap-2 text-xs rounded-xl px-3 py-2.5"
                             style="background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.06); color:rgba(107,114,128,0.8);">
                            <svg class="w-4 h-4 flex-shrink-0 mt-0.5" style="color:rgba(249,115,22,0.7);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p>Password minimal 5 karakter. Gunakan kombinasi huruf, angka, dan simbol untuk keamanan lebih baik.</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Submit --}}
            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.dashboard') }}" class="ep-btn-secondary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Batal
                </a>
                <button type="submit" class="ep-btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ===== STYLES ===== --}}
<style>
.profile-input {
    width: 100%; padding: 11px 14px; border-radius: 12px; font-size: 14px;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.10);
    color: white; outline: none;
    transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
}
.profile-input::placeholder { color: rgba(107,114,128,0.5); }
.profile-input:focus {
    border-color: #e11d48;
    background: rgba(225,29,72,0.05);
    box-shadow: 0 0 0 3px rgba(225,29,72,0.15);
}
.profile-input.input-error {
    border-color: rgba(225,29,72,0.5);
    box-shadow: 0 0 0 2px rgba(225,29,72,0.15);
}
.ep-btn-primary {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 10px 22px; border-radius: 12px;
    font-size: 13px; font-weight: 600; color: white;
    background: linear-gradient(135deg, #e11d48, #9f1239);
    box-shadow: 0 0 18px rgba(225,29,72,0.3);
    transition: box-shadow 0.25s, transform 0.2s; cursor: pointer;
}
.ep-btn-primary:hover { box-shadow: 0 0 30px rgba(225,29,72,0.55); transform: scale(1.02); }
.ep-btn-secondary {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 10px 18px; border-radius: 12px;
    font-size: 13px; font-weight: 600;
    background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.10);
    color: rgba(156,163,175,0.9);
    transition: background 0.2s, color 0.2s; cursor: pointer; text-decoration: none;
}
.ep-btn-secondary:hover { background: rgba(255,255,255,0.1); color: white; }
</style>

{{-- ===== SCRIPTS ===== --}}
<script>
    /* ---- Avatar live preview ---- */
    function handleAvatarPreview(input) {
        if (!input.files || !input.files[0]) return;
        const file = input.files[0];
        const reader = new FileReader();
        reader.onload = function(e) {
            const url = e.target.result;
            const wrap = document.getElementById('avatarWrap');
            wrap.innerHTML = '<img src="' + url + '" alt="Avatar" class="w-full h-full object-cover" style="width:100%;height:100%;object-fit:cover;">';
            document.getElementById('fotoLabel').textContent = file.name;
        };
        reader.readAsDataURL(file);
    }

    /* ---- Password visibility toggle ---- */
    function togglePass(inputId, eyeId) {
        const inp = document.getElementById(inputId);
        const eye = document.getElementById(eyeId);
        if (inp.type === 'password') {
            inp.type = 'text';
            eye.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>`;
        } else {
            inp.type = 'password';
            eye.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`;
        }
    }

    /* ---- Flash auto-hide ---- */
    setTimeout(function() {
        const el = document.getElementById('flash-msg');
        if (el) { el.style.transition = 'opacity 0.5s'; el.style.opacity = '0'; setTimeout(() => el.remove(), 500); }
    }, 4000);
</script>

@endsection
