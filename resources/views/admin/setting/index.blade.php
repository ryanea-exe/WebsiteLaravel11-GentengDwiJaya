@extends('layouts.app')
@section('title', 'Pengaturan - ' . $appSetting->app_name)

@section('content')

{{-- ===== PAGE HEADER ===== --}}
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
    <div>
        <div class="flex items-center gap-2 mb-1">
            <div class="w-1 h-6 rounded-full" style="background: linear-gradient(180deg,#e11d48,#f97316);"></div>
            <p class="text-xs font-semibold uppercase tracking-widest" style="color: rgba(225,29,72,0.8);">Konfigurasi</p>
        </div>
        <h1 class="text-2xl md:text-3xl font-black text-white">Pengaturan Sistem</h1>
        <p class="text-sm mt-1" style="color: rgba(107,114,128,0.9);">Kelola identitas dan tampilan aplikasi</p>
    </div>
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

<div class="grid lg:grid-cols-3 gap-6">

    {{-- ===== FORM PENGATURAN ===== --}}
    <div class="lg:col-span-2">
        <form method="POST" action="{{ route('admin.setting.update') }}" enctype="multipart/form-data">
            @csrf

            {{-- SECTION: Nama Aplikasi --}}
            <div class="rounded-2xl mb-5" style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.07);">
                <div class="px-5 py-4 flex items-center gap-3" style="border-bottom: 1px solid rgba(255,255,255,0.06);">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background: rgba(225,29,72,0.15);">
                        <svg class="w-4 h-4" style="color:#e11d48;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-white">Nama Aplikasi</p>
                        <p class="text-xs" style="color:rgba(107,114,128,0.8);">Akan tampil di navbar, login, dan title browser</p>
                    </div>
                </div>
                <div class="p-5">
                    <label class="block text-xs font-semibold mb-2" style="color:rgba(209,213,219,0.9);">Nama Aplikasi <span style="color:#e11d48">*</span></label>
                    <input type="text" name="app_name"
                           value="{{ old('app_name', $setting->app_name) }}"
                           placeholder="cth. Genteng Dwijaya"
                           required maxlength="100"
                           class="setting-input"
                           oninput="updatePreview(this.value)">
                    <p class="text-xs mt-2" style="color:rgba(107,114,128,0.6);">
                        Tip: Jika nama terdiri dari 2 kata atau lebih, kata pertama akan berwarna putih dan sisanya akan berwarna merah-oranye (gradient).
                    </p>
                </div>
            </div>

            {{-- SECTION: Teks Landing Page --}}
            <div class="rounded-2xl mb-5" style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.07);">
                <div class="px-5 py-4 flex items-center gap-3" style="border-bottom: 1px solid rgba(255,255,255,0.06);">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background: rgba(168,85,247,0.15);">
                        <svg class="w-4 h-4" style="color:#a855f7;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-white">Teks Landing Page</p>
                        <p class="text-xs" style="color:rgba(107,114,128,0.8);">Atur teks utama (headline) dan deskripsi (subheadline) di Hero Section</p>
                    </div>
                </div>
                <div class="p-5">
                    <div class="mb-4">
                        <label class="block text-xs font-semibold mb-2" style="color:rgba(209,213,219,0.9);">Main Headline <span style="color:rgba(107,114,128,0.6); font-weight:400;">(25-35 karakter)</span></label>
                        <input type="text" name="mainheadline"
                               value="{{ old('mainheadline', $setting->mainheadline) }}"
                               placeholder="Contoh: Genteng Kuat, Rumah Aman & Indah"
                               minlength="25" maxlength="200"
                               class="setting-input">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold mb-2" style="color:rgba(209,213,219,0.9);">Sub Headline <span style="color:rgba(107,114,128,0.6); font-weight:400;">(150-200 karakter)</span></label>
                        <textarea name="subheadline" rows="3"
                                  placeholder="Contoh: Genteng pilihan kualitas premium — tahan cuaca ekstrem..."
                                  minlength="150" maxlength="200"
                                  class="setting-input">{{ old('subheadline', $setting->subheadline) }}</textarea>
                    </div>
                </div>
            </div>

            {{-- SECTION: Logo --}}
            <div class="rounded-2xl mb-5" style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.07);">
                <div class="px-5 py-4 flex items-center gap-3" style="border-bottom: 1px solid rgba(255,255,255,0.06);">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background: rgba(249,115,22,0.15);">
                        <svg class="w-4 h-4" style="color:#fb923c;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-white">Logo Aplikasi</p>
                        <p class="text-xs" style="color:rgba(107,114,128,0.8);">Akan tampil di navbar, halaman login, dan landing page</p>
                    </div>
                </div>
                <div class="p-5">
                    {{-- Current logo --}}
                    <div class="flex items-center gap-4 mb-5">
                        <div class="w-16 h-16 rounded-2xl flex items-center justify-center overflow-hidden flex-shrink-0"
                             style="background: linear-gradient(135deg,#e11d48,#9f1239); box-shadow: 0 0 20px rgba(225,29,72,0.3);">
                            @if($setting->app_logo)
                                <img id="currentLogoImg" src="{{ asset($setting->app_logo) }}" alt="Logo" class="w-full h-full object-cover">
                            @else
                                <div id="currentLogoSvg">
                                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2L2 8v2h20V8L12 2zm-9 9v9h6v-5h6v5h6V11H3z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-white mb-1">
                                @if($setting->app_logo) Logo Saat Ini @else Logo Default @endif
                            </p>
                            <p class="text-xs mb-2" style="color:rgba(107,114,128,0.7);">
                                @if($setting->app_logo)
                                    {{ basename($setting->app_logo) }}
                                @else
                                    Ikon default (rumah/genteng)
                                @endif
                            </p>
                            @if($setting->app_logo)
                            <a href="{{ route('admin.setting.delete-logo') }}"
                               onclick="return confirm('Hapus logo dan kembali ke default?')"
                               class="inline-flex items-center gap-1.5 text-xs px-3 py-1.5 rounded-lg transition"
                               style="background:rgba(225,29,72,0.12); color:#f87171; border:1px solid rgba(225,29,72,0.25);"
                               onmouseover="this.style.background='rgba(225,29,72,0.25)'"
                               onmouseout="this.style.background='rgba(225,29,72,0.12)'">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Hapus Logo (Reset Default)
                            </a>
                            @endif
                        </div>
                    </div>

                    {{-- Upload area --}}
                    <label class="block text-xs font-semibold mb-2" style="color:rgba(209,213,219,0.9);">Upload Logo Baru
                        <span style="color:rgba(107,114,128,0.6); font-weight:400;">(opsional — JPG, PNG, SVG, WebP · Maks 2MB)</span>
                    </label>
                    <div class="logo-upload-area" onclick="document.getElementById('logoInput').click()" id="uploadDropArea">
                        <div class="flex flex-col items-center gap-2 py-2">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background:rgba(249,115,22,0.15);">
                                <svg class="w-5 h-5" style="color:#fb923c;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                </svg>
                            </div>
                            <p id="uploadLabel" class="text-sm font-medium" style="color:rgba(156,163,175,0.9);">Klik atau drag & drop gambar logo</p>
                            <p class="text-xs" style="color:rgba(107,114,128,0.6);">Format: JPG, PNG, SVG, WebP · Maks 2MB · Rekomendasi: 1:1</p>
                        </div>
                        <input type="file" id="logoInput" name="app_logo" accept=".jpg,.jpeg,.png,.svg,.webp"
                               class="hidden" onchange="handleLogoPreview(this)">
                    </div>

                    {{-- Preview baru --}}
                    <div id="newLogoPreviewWrap" class="hidden mt-4 flex items-center gap-4">
                        <div class="w-16 h-16 rounded-2xl overflow-hidden flex-shrink-0" style="border: 2px solid rgba(249,115,22,0.4); box-shadow: 0 0 16px rgba(249,115,22,0.2);">
                            <img id="newLogoPreview" src="" alt="Preview" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-white mb-0.5">Preview Logo Baru</p>
                            <p id="newLogoName" class="text-xs" style="color:rgba(107,114,128,0.7);"></p>
                            <button type="button" onclick="clearLogoInput()" class="text-xs mt-1" style="color:#f87171;">✕ Batalkan</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Submit --}}
            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.dashboard') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Pengaturan
                </button>
            </div>
        </form>
    </div>

    {{-- ===== PREVIEW PANEL ===== --}}
    <div class="space-y-5">

        {{-- Live Preview Card --}}
        <div class="rounded-2xl p-5 sticky top-24" style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.07);">
            <p class="text-xs font-semibold uppercase tracking-widest mb-4" style="color: rgba(225,29,72,0.7);">Preview Tampilan</p>

            {{-- Preview Navbar --}}
            <div class="mb-4">
                <p class="text-xs mb-2" style="color:rgba(107,114,128,0.7);">Header Admin:</p>
                <div class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl" style="background:rgba(10,10,10,0.9); border:1px solid rgba(225,29,72,0.15);">
                    <div class="w-7 h-7 rounded-lg flex items-center justify-center overflow-hidden flex-shrink-0" id="prevIconWrap"
                         style="background:linear-gradient(135deg,#e11d48,#9f1239); box-shadow:0 0 10px rgba(225,29,72,0.3);">
                        @if($setting->app_logo)
                            <img id="prevIcon" src="{{ asset($setting->app_logo) }}" alt="" class="w-full h-full object-cover">
                        @else
                            <svg id="prevIconSvg" class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2L2 8v2h20V8L12 2zm-9 9v9h6v-5h6v5h6V11H3z"/>
                            </svg>
                        @endif
                    </div>
                    <div class="leading-tight">
                        <p class="text-xs font-bold text-white" id="prevName1">
                            @php $pp = explode(' ', $setting->app_name, 2); @endphp
                            {{ $pp[0] }} @if(isset($pp[1]))<span style="background:linear-gradient(135deg,#e11d48,#f97316);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;" id="prevName2">{{ $pp[1] }}</span>@endif
                        </p>
                        <p class="text-xs" style="color:rgba(107,114,128,0.7);">Admin Panel</p>
                    </div>
                </div>
            </div>

            {{-- Preview Login --}}
            <div class="mb-4">
                <p class="text-xs mb-2" style="color:rgba(107,114,128,0.7);">Halaman Login:</p>
                <div class="flex flex-col items-center py-4 rounded-xl" style="background:rgba(10,10,10,0.7); border:1px solid rgba(255,255,255,0.05);">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center overflow-hidden mb-2" id="prevLoginIconWrap"
                         style="background:linear-gradient(135deg,#e11d48,#9f1239); box-shadow:0 0 14px rgba(225,29,72,0.4);">
                        @if($setting->app_logo)
                            <img id="prevLoginIcon" src="{{ asset($setting->app_logo) }}" alt="" class="w-full h-full object-cover">
                        @else
                            <svg id="prevLoginIconSvg" class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2L2 8v2h20V8L12 2zm-9 9v9h6v-5h6v5h6V11H3z"/>
                            </svg>
                        @endif
                    </div>
                    <p class="text-sm font-black text-white" id="prevLoginName">
                        {{ $setting->app_name }}
                    </p>
                    <p class="text-xs" style="color:rgba(107,114,128,0.7);">Admin Panel</p>
                </div>
            </div>

            {{-- Info --}}
            <div class="rounded-xl p-3 text-xs" style="background:rgba(225,29,72,0.08); border:1px solid rgba(225,29,72,0.15); color:rgba(248,113,113,0.85);">
                <p class="font-semibold mb-1">💡 Tips Logo</p>
                <p style="color:rgba(156,163,175,0.7);">Gunakan gambar persegi (1:1) dengan background transparan atau merah untuk hasil terbaik.</p>
            </div>
        </div>
    </div>

</div>

<style>
.setting-input {
    width: 100%; padding: 11px 14px; border-radius: 12px; font-size: 14px;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.10);
    color: white; outline: none;
    transition: border-color 0.2s, box-shadow 0.2s;
}
.setting-input::placeholder { color: rgba(107,114,128,0.5); }
.setting-input:focus {
    border-color: #e11d48;
    background: rgba(225,29,72,0.05);
    box-shadow: 0 0 0 3px rgba(225,29,72,0.15);
}

.logo-upload-area {
    border: 1.5px dashed rgba(255,255,255,0.12);
    border-radius: 14px; padding: 20px;
    cursor: pointer; transition: border-color 0.2s, background 0.2s;
    text-align: center;
}
.logo-upload-area:hover {
    border-color: rgba(249,115,22,0.45);
    background: rgba(249,115,22,0.04);
}
.logo-upload-area.drag-over {
    border-color: rgba(249,115,22,0.6);
    background: rgba(249,115,22,0.08);
}

.btn-primary {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 10px 20px; border-radius: 12px;
    font-size: 13px; font-weight: 600; color: white;
    background: linear-gradient(135deg, #e11d48, #9f1239);
    box-shadow: 0 0 16px rgba(225,29,72,0.3);
    transition: box-shadow 0.25s, transform 0.2s;
    cursor: pointer;
}
.btn-primary:hover { box-shadow: 0 0 28px rgba(225,29,72,0.55); transform: scale(1.02); }

.btn-secondary {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 10px 20px; border-radius: 12px;
    font-size: 13px; font-weight: 600;
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.10);
    color: rgba(156,163,175,0.9);
    transition: background 0.2s, color 0.2s;
    cursor: pointer; text-decoration: none;
}
.btn-secondary:hover { background: rgba(255,255,255,0.1); color: white; }
</style>

<script>
    /* ---- Live preview: nama ---- */
    function updatePreview(val) {
        const parts = val.trim().split(/\s+/);
        const first = parts[0] || '';
        const rest  = parts.slice(1).join(' ');

        // Header preview
        const p1 = document.getElementById('prevName1');
        if (p1) {
            p1.innerHTML = first + (rest
                ? ' <span style="background:linear-gradient(135deg,#e11d48,#f97316);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">' + rest + '</span>'
                : '');
        }

        // Login preview
        const pl = document.getElementById('prevLoginName');
        if (pl) pl.textContent = val || 'Nama Aplikasi';
    }

    /* ---- Logo preview ---- */
    function handleLogoPreview(input) {
        if (!input.files || !input.files[0]) return;
        const file = input.files[0];
        const reader = new FileReader();
        reader.onload = function(e) {
            const url = e.target.result;
            // Show preview wrap
            document.getElementById('newLogoPreviewWrap').classList.remove('hidden');
            document.getElementById('newLogoPreview').src = url;
            document.getElementById('newLogoName').textContent = file.name;
            document.getElementById('uploadLabel').textContent = file.name;

            // Update live previews
            updatePreviewLogo(url);
        };
        reader.readAsDataURL(file);
    }

    function updatePreviewLogo(url) {
        // Header nav preview
        const wrap = document.getElementById('prevIconWrap');
        if (wrap) {
            wrap.innerHTML = '<img src="' + url + '" alt="" class="w-full h-full object-cover" style="width:100%;height:100%;object-fit:cover;">';
        }
        // Login preview
        const wrapL = document.getElementById('prevLoginIconWrap');
        if (wrapL) {
            wrapL.innerHTML = '<img src="' + url + '" alt="" style="width:100%;height:100%;object-fit:cover;">';
        }
    }

    function clearLogoInput() {
        document.getElementById('logoInput').value = '';
        document.getElementById('newLogoPreviewWrap').classList.add('hidden');
        document.getElementById('uploadLabel').textContent = 'Klik atau drag & drop gambar logo';

        // Restore current logo in previews
        @if($setting->app_logo)
            const origUrl = '{{ asset($setting->app_logo) }}';
            updatePreviewLogo(origUrl);
        @else
            const svgHtml = '<svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24" style="width:1rem;height:1rem;color:white;"><path d="M12 2L2 8v2h20V8L12 2zm-9 9v9h6v-5h6v5h6V11H3z"/></svg>';
            const w = document.getElementById('prevIconWrap');
            if (w) w.innerHTML = svgHtml;
            const wL = document.getElementById('prevLoginIconWrap');
            const svgL = '<svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24" style="width:1.5rem;height:1.5rem;color:white;"><path d="M12 2L2 8v2h20V8L12 2zm-9 9v9h6v-5h6v5h6V11H3z"/></svg>';
            if (wL) wL.innerHTML = svgL;
        @endif
    }

    /* ---- Drag & Drop ---- */
    const dropArea = document.getElementById('uploadDropArea');
    if (dropArea) {
        dropArea.addEventListener('dragover', (e) => { e.preventDefault(); dropArea.classList.add('drag-over'); });
        dropArea.addEventListener('dragleave', () => dropArea.classList.remove('drag-over'));
        dropArea.addEventListener('drop', (e) => {
            e.preventDefault();
            dropArea.classList.remove('drag-over');
            const file = e.dataTransfer.files[0];
            if (file && file.type.startsWith('image/')) {
                const input = document.getElementById('logoInput');
                const dt = new DataTransfer();
                dt.items.add(file);
                input.files = dt.files;
                handleLogoPreview(input);
            }
        });
    }

    /* ---- Flash auto-hide ---- */
    setTimeout(function() {
        const el = document.getElementById('flash-msg');
        if (el) { el.style.transition = 'opacity 0.5s'; el.style.opacity = '0'; setTimeout(() => el.remove(), 500); }
    }, 4000);
</script>

@endsection
