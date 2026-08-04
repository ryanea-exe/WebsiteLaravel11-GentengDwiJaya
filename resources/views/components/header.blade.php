@php
    $userLogin = \App\Models\User::find(Session::get('user_id'));
@endphp

<header class="fixed top-0 left-0 w-full h-16 z-50 flex items-center justify-between px-4 md:px-6"
        style="background: rgba(10,10,10,0.95); backdrop-filter: blur(18px); -webkit-backdrop-filter: blur(18px); border-bottom: 1px solid rgba(225,29,72,0.15); box-shadow: 0 4px 24px rgba(0,0,0,0.4);">

    <!-- KIRI: Hamburger + Brand -->
    <div class="flex items-center gap-4">
        <!-- Mobile toggle -->
        <button id="menuBtn"
            class="lg:hidden w-9 h-9 flex flex-col justify-center items-center gap-1.5 rounded-lg hover:bg-white/10 transition"
            aria-label="Menu">
            <span class="w-5 h-0.5 bg-white block transition-all"></span>
            <span class="w-3.5 h-0.5 bg-red-500 block transition-all"></span>
            <span class="w-5 h-0.5 bg-white block transition-all"></span>
        </button>

        <!-- Brand -->
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group">
            <div class="w-8 h-8 rounded-lg flex items-center justify-center shadow-lg transition group-hover:scale-105 overflow-hidden flex-shrink-0"
                 style="background: linear-gradient(135deg, #e11d48, #9f1239); box-shadow: 0 0 14px rgba(225,29,72,0.35);">
                @if($appSetting->app_logo)
                    <img src="{{ asset($appSetting->app_logo) }}" alt="Logo" class="w-full h-full object-cover">
                @else
                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L2 8v2h20V8L12 2zm-9 9v9h6v-5h6v5h6V11H3z"/>
                    </svg>
                @endif
            </div>
            <div class="hidden sm:block leading-tight">
                @php
                    $nameParts = explode(' ', $appSetting->app_name, 2);
                    $firstName  = $nameParts[0];
                    $restName   = $nameParts[1] ?? '';
                @endphp
                <p class="text-sm font-bold text-white tracking-tight">
                    {{ $firstName }}
                    @if($restName)
                        <span style="background: linear-gradient(135deg,#e11d48,#f97316); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;">{{ $restName }}</span>
                    @endif
                </p>
                <p class="text-xs text-gray-500">Admin Panel</p>
            </div>
        </a>
    </div>

    <!-- KANAN: User dropdown -->
    <div class="flex items-center gap-3">
        @if(Session::get('user_id'))
        <div class="relative">
            <button id="userDropdownBtn"
                class="flex items-center gap-2.5 hover:bg-white/8 px-3 py-2 rounded-xl transition-all duration-200"
                style="border: 1px solid rgba(255,255,255,0.08);">
                <!-- Avatar -->
                @if($userLogin && $userLogin->foto)
                    <img src="{{ asset('uploads/user/' . $userLogin->foto) }}"
                         alt="Profile"
                         class="w-8 h-8 rounded-full object-cover">
                @else
                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-white text-sm font-bold"
                         style="background: linear-gradient(135deg, #e11d48, #9f1239); box-shadow: 0 0 0 2px rgba(225,29,72,0.4);">
                        {{ strtoupper(substr($userLogin->nama, 0, 1)) }}
                    </div>
                @endif
                <!-- Nama -->
                <div class="hidden sm:block text-left leading-tight">
                    <p class="text-xs font-semibold text-white">{{ $userLogin->nama }}</p>
                    <p class="text-xs text-gray-500">Administrator</p>
                </div>
                <!-- Chevron -->
                <svg id="dropdownArrow" class="w-3.5 h-3.5 text-gray-500 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <!-- Dropdown Menu -->
            <div id="userDropdownMenu"
                 class="absolute right-0 mt-2 w-52 rounded-2xl shadow-2xl overflow-hidden hidden"
                 style="background: rgba(18,18,18,0.98); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.08); box-shadow: 0 20px 60px rgba(0,0,0,0.6); top: calc(100% + 8px);">
                <!-- User info header -->
                <div class="px-4 py-3" style="border-bottom: 1px solid rgba(255,255,255,0.06);">
                    <div class="flex items-center gap-2.5">
                        @if($userLogin && $userLogin->foto)
                            <img src="{{ asset('uploads/user/' . $userLogin->foto) }}"
                                 alt="Profile" class="w-8 h-8 rounded-full object-cover flex-shrink-0">
                        @else
                            <div class="w-8 h-8 rounded-full flex items-center justify-center text-white text-xs font-bold flex-shrink-0"
                                 style="background: linear-gradient(135deg, #e11d48, #9f1239);">
                                {{ strtoupper(substr($userLogin->nama, 0, 1)) }}
                            </div>
                        @endif
                        <div>
                            <p class="text-xs font-semibold text-white leading-tight">{{ $userLogin->nama }}</p>
                            <p class="text-xs text-gray-500 mt-0.5">Administrator</p>
                        </div>
                    </div>
                </div>
                <!-- Menu items -->
                <div class="p-2">
                    <a href="{{ route('admin.setting') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-gray-300 hover:bg-white/8 hover:text-white transition">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Pengaturan
                    </a>
                    <div style="height:1px; background: rgba(255,255,255,0.06); margin: 4px 8px;"></div>
                    {{-- Tombol logout → buka modal konfirmasi --}}
                    <button onclick="modalOpen('logoutModal')"
                            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition"
                            style="color: #f87171;">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                        Logout
                    </button>
                </div>
            </div>
        </div>

        @else
        <a href="{{ route('login') }}"
           class="text-sm font-semibold text-white px-4 py-2 rounded-xl transition"
           style="background: linear-gradient(135deg, #e11d48, #9f1239); box-shadow: 0 0 16px rgba(225,29,72,0.35);">
            Login
        </a>
        @endif
    </div>
</header>

{{-- ===== MODAL KONFIRMASI LOGOUT ===== --}}
<div id="logoutModal" class="modal-overlay" onclick="handleOverlayClick(event, 'logoutModal')">
    <div class="modal-box" style="max-width: 400px;">

        {{-- Header --}}
        <div class="modal-header">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                     style="background: rgba(225,29,72,0.15); border: 1px solid rgba(225,29,72,0.3);">
                    <svg class="w-5 h-5" style="color:#f87171;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-base font-bold text-white">Konfirmasi Logout</h2>
                    <p class="text-xs" style="color:rgba(107,114,128,0.8);">Anda akan keluar dari sesi ini</p>
                </div>
            </div>
            <button onclick="modalClose('logoutModal')" class="modal-close-btn">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Body --}}
        <div class="px-5 py-5">
            {{-- Ilustrasi user yang sedang login --}}
            <div class="flex items-center gap-3 rounded-xl px-4 py-3 mb-5"
                 style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.07);">
                @if($userLogin && $userLogin->foto)
                    <img src="{{ asset('uploads/user/' . $userLogin->foto) }}"
                         alt="Profile" class="w-10 h-10 rounded-full object-cover flex-shrink-0">
                @else
                    <div class="w-10 h-10 rounded-full flex items-center justify-center text-white font-bold flex-shrink-0"
                         style="background: linear-gradient(135deg, #e11d48, #9f1239);">
                        {{ strtoupper(substr($userLogin->nama ?? 'A', 0, 1)) }}
                    </div>
                @endif
                <div>
                    <p class="text-sm font-semibold text-white">{{ $userLogin->nama ?? 'Administrator' }}</p>
                    <p class="text-xs" style="color:rgba(107,114,128,0.7);">Administrator</p>
                </div>
                <div class="ml-auto">
                    <span class="text-xs px-2 py-1 rounded-full font-medium"
                          style="background: rgba(34,197,94,0.12); color:#4ade80; border:1px solid rgba(34,197,94,0.2);">
                        ● Online
                    </span>
                </div>
            </div>

            <p class="text-sm mb-1" style="color:rgba(156,163,175,0.9);">
                Apakah Anda yakin ingin keluar dari <span class="text-white font-semibold">Admin Panel</span>?
            </p>
            <p class="text-xs" style="color:rgba(107,114,128,0.6);">
                Sesi Anda akan diakhiri dan Anda perlu login kembali untuk mengakses panel admin.
            </p>
        </div>

        {{-- Footer --}}
        <div class="modal-footer">
            <button onclick="modalClose('logoutModal')" class="btn-secondary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                Batal
            </button>
            <a href="{{ route('logout') }}" class="btn-primary"
               style="background: linear-gradient(135deg,#e11d48,#9f1239); box-shadow: 0 0 16px rgba(225,29,72,0.3);">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                </svg>
                Ya, Logout
            </a>
        </div>
    </div>
</div>

{{-- ===== STYLES MODAL (konsisten dengan halaman lain) ===== --}}
<style>
.modal-overlay {
    position: fixed; inset: 0; z-index: 9999;
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
    width: calc(100% - 32px); max-width: 540px; max-height: 90vh; overflow-y: auto;
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
    cursor: pointer;
}
.modal-close-btn:hover { background: rgba(225,29,72,0.15); color: #f87171; }
.btn-primary {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 9px 18px; border-radius: 12px;
    font-size: 13px; font-weight: 600; color: white;
    background: linear-gradient(135deg, #e11d48, #9f1239);
    box-shadow: 0 0 16px rgba(225,29,72,0.3);
    transition: box-shadow 0.25s, transform 0.2s;
    cursor: pointer; text-decoration: none;
}
.btn-primary:hover { box-shadow: 0 0 28px rgba(225,29,72,0.55); transform: scale(1.02); }
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
    .modal-box { border-radius: 16px 16px 0 0; max-height: 85vh; }
    .modal-overlay { align-items: flex-end; }
}
</style>

<script>
    /* ===== Dropdown user ===== */
    const dropdownBtn   = document.getElementById('userDropdownBtn');
    const dropdownMenu  = document.getElementById('userDropdownMenu');
    const dropdownArrow = document.getElementById('dropdownArrow');

    if (dropdownBtn) {
        dropdownBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            dropdownMenu.classList.toggle('hidden');
            dropdownArrow.classList.toggle('rotate-180');
        });
        document.addEventListener('click', function() {
            dropdownMenu.classList.add('hidden');
            dropdownArrow.classList.remove('rotate-180');
        });
        dropdownMenu.addEventListener('click', function(e) { e.stopPropagation(); });
    }

    /* ===== Modal functions (konsisten dengan halaman lain) ===== */
    function modalOpen(id) {
        // Tutup dropdown dulu jika terbuka
        if (dropdownMenu) {
            dropdownMenu.classList.add('hidden');
            if (dropdownArrow) dropdownArrow.classList.remove('rotate-180');
        }
        const el = document.getElementById(id);
        if (el) {
            el.classList.add('modal-active');
            document.body.style.overflow = 'hidden';
        }
    }

    function modalClose(id) {
        const el = document.getElementById(id);
        if (el) {
            el.classList.remove('modal-active');
            document.body.style.overflow = '';
        }
    }

    function handleOverlayClick(e, id) {
        if (e.target === document.getElementById(id)) modalClose(id);
    }

    /* ESC key untuk tutup semua modal */
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('.modal-overlay.modal-active')
                .forEach(m => m.classList.remove('modal-active'));
            document.body.style.overflow = '';
        }
    });
</script>
