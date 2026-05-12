@php
    $userLogin = \App\Models\User::find(Session::get('user_id'));
@endphp

<header class="fixed top-0 left-0 w-full h-16 bg-gradient-to-r from-orange-800 via-red-700 to-amber-700 text-white shadow-lg flex items-center justify-between px-4 md:px-6 z-50">
    <!-- KIRI -->
    <div class="flex items-center gap-3">
        <!-- Tombol Mobile -->
        <button id="menuBtn"
            class="lg:hidden bg-white/20 hover:bg-white/30 p-2 rounded-md transition">
            ☰
        </button>

        <div>
            <h1 class="font-bold text-lg md:text-xl tracking-wide">
                Genteng Dwijaya.
            </h1>
            <p class="text-xs text-orange-100 hidden md:block">
                Sistem Informasi Penjualan Genteng
            </p>
        </div>
    </div>

    <!-- KANAN -->
    <div class="flex items-center gap-3 md:gap-4">

        @if(Session::get('user_id'))
        <!-- USER DROPDOWN -->
        <div class="relative">
            <button id="userDropdownBtn"
                class="flex items-center gap-3 hover:bg-white/10 px-3 py-2 rounded-xl transition-all duration-300">
                <!-- Avatar -->
                @if($userLogin && $userLogin->foto)
                    <img src="{{ asset('uploads/user/' . $userLogin->foto) }}"
                        alt="Profile"
                        class="w-9 h-9 rounded-full object-cover shadow">
                @else
                    <div class="w-9 h-9 rounded-full bg-white/20 flex items-center justify-center font-bold shadow">
                        {{ strtoupper(substr($userLogin->nama, 0, 1)) }}
                    </div>
                @endif
                <!-- Nama -->
                <div class="hidden sm:block text-left leading-tight">
                    <p class="text-sm font-semibold">
                        {{ $userLogin->nama }}
                    </p>
                    <p class="text-xs text-orange-100">
                        Administrator
                    </p>
                </div>
                <!-- Panah -->
                <svg id="dropdownArrow"
                    xmlns="http://www.w3.org/2000/svg"
                    class="w-4 h-4 transition-transform duration-300"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <!-- DROPDOWN MENU -->
            <div id="userDropdownMenu"
                class="absolute right-0 mt-2 w-56 bg-white rounded-2xl shadow-2xl overflow-hidden hidden border border-orange-100">
                <!-- Menu -->
                <div class="p-2">
                    <!-- Edit Profile -->
                    <a href="#" class="flex items-center gap-2 px-4 py-2 rounded-xl hover:bg-orange-50 transition text-gray-700">
                        <!-- Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4 text-orange-600"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M11 5h2m-1-1v2m-6 4h12M5 19h14" />
                        </svg>
                        <span>Edit Profile</span>
                    </a>

                    <!-- Logout -->
                    <a href="{{ route('logout') }}" class="flex items-center gap-2 px-4 py-2 rounded-xl hover:bg-red-50 transition text-red-600">
                        <!-- Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1m0-10V5" />
                        </svg>
                        <span>Logout</span>
                    </a>
                </div>
            </div>
        </div>

        @else
        <a href="{{ route('login') }}"
            class="bg-white text-orange-700 hover:bg-orange-100 px-4 py-2 rounded-lg text-sm font-semibold transition shadow">
            Login
        </a>

        @endif
    </div>
</header>

<script>
    const dropdownBtn = document.getElementById('userDropdownBtn');
    const dropdownMenu = document.getElementById('userDropdownMenu');
    const dropdownArrow = document.getElementById('dropdownArrow');

    if (dropdownBtn) {

        dropdownBtn.addEventListener('click', function (e) {
            e.stopPropagation();

            dropdownMenu.classList.toggle('hidden');

            // Rotasi panah
            dropdownArrow.classList.toggle('rotate-180');
        });

        // Klik luar dropdown
        document.addEventListener('click', function () {
            dropdownMenu.classList.add('hidden');
            dropdownArrow.classList.remove('rotate-180');
        });

        // Prevent close saat klik isi dropdown
        dropdownMenu.addEventListener('click', function (e) {
            e.stopPropagation();
        });
    }
</script>