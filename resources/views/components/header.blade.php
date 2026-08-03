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
            <div class="w-8 h-8 rounded-lg flex items-center justify-center shadow-lg transition group-hover:scale-105"
                 style="background: linear-gradient(135deg, #e11d48, #9f1239); box-shadow: 0 0 14px rgba(225,29,72,0.35);">
                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2L2 8v2h20V8L12 2zm-9 9v9h6v-5h6v5h6V11H3z"/>
                </svg>
            </div>
            <div class="hidden sm:block leading-tight">
                <p class="text-sm font-bold text-white tracking-tight">
                    Genteng <span style="background: linear-gradient(135deg,#e11d48,#f97316); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;">Dwijaya</span>
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
                         <!-- style="box-shadow: 0 0 0 2px rgba(225,29,72,0.5);"> -->
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
                 style="background: rgba(18,18,18,0.98); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.08); box-shadow: 0 20px 60px rgba(0,0,0,0.6);">
                <!-- User info header -->
                <div class="px-4 py-3" style="border-bottom: 1px solid rgba(255,255,255,0.06);">
                    <p class="text-sm font-semibold text-white">{{ $userLogin->nama }}</p>
                    <p class="text-xs text-gray-500 mt-0.5">Administrator</p>
                </div>
                <!-- Menu items -->
                <div class="p-2">
                    <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-gray-300 hover:bg-white/8 hover:text-white transition">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Edit Profile
                    </a>
                    <div style="height:1px; background: rgba(255,255,255,0.06); margin: 4px 8px;"></div>
                    <a href="{{ route('logout') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition" style="color: #f87171;">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                        Logout
                    </a>
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

<script>
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
</script>
