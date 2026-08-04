<aside id="sidebar"
    class="fixed top-16 left-0 w-64 h-[calc(100vh-4rem)] p-4 shadow-2xl z-40 -translate-x-full lg:translate-x-0 lg:transform-none transition-all duration-300 flex flex-col"
    style="background: rgba(12,12,12,0.98); backdrop-filter: blur(20px); border-right: 1px solid rgba(225,29,72,0.1);">

    <!-- Brand dalam sidebar -->
    <div class="mb-6 px-2">
        <p class="text-xs font-semibold uppercase tracking-widest mb-1" style="color: rgba(225,29,72,0.7);">Navigation</p>
        <div class="h-px" style="background: linear-gradient(90deg, rgba(225,29,72,0.5), transparent);"></div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 space-y-1 text-sm">
        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard') }}"
            class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 group
            {{ request()->routeIs('admin.dashboard')
                ? 'active-link'
                : 'inactive-link' }}">
            <span class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0 transition-all
                {{ request()->routeIs('admin.dashboard') ? 'icon-active' : 'icon-inactive' }}">
                <i class="fa-solid fa-house text-sm"></i>
            </span>
            <span class="font-medium">Dashboard</span>
            @if(request()->routeIs('admin.dashboard'))
            <span class="ml-auto w-1.5 h-1.5 rounded-full" style="background: #e11d48;"></span>
            @endif
        </a>

        <!-- Genteng -->
        <a href="{{ route('admin.genteng') }}"
            class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 group
            {{ request()->routeIs('admin.genteng')
                ? 'active-link'
                : 'inactive-link' }}">
            <span class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0 transition-all
                {{ request()->routeIs('admin.genteng') ? 'icon-active' : 'icon-inactive' }}">
                <i class="fa-solid fa-layer-group text-sm"></i>
            </span>
            <span class="font-medium">Data Genteng</span>
            @if(request()->routeIs('admin.genteng'))
            <span class="ml-auto w-1.5 h-1.5 rounded-full" style="background: #e11d48;"></span>
            @endif
        </a>

        <!-- User -->
        <a href="{{ route('admin.user') }}"
            class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 group
            {{ request()->routeIs('admin.user')
                ? 'active-link'
                : 'inactive-link' }}">
            <span class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0 transition-all
                {{ request()->routeIs('admin.user') ? 'icon-active' : 'icon-inactive' }}">
                <i class="fa-solid fa-users text-sm"></i>
            </span>
            <span class="font-medium">Manajemen User</span>
            @if(request()->routeIs('admin.user'))
            <span class="ml-auto w-1.5 h-1.5 rounded-full" style="background: #e11d48;"></span>
            @endif
        </a>

        <!-- Setting -->
        <a href="{{ route('admin.setting') }}"
            class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 group
            {{ request()->routeIs('admin.setting')
                ? 'active-link'
                : 'inactive-link' }}">
            <span class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0 transition-all
                {{ request()->routeIs('admin.setting') ? 'icon-active' : 'icon-inactive' }}">
                <i class="fa-solid fa-gear text-sm"></i>
            </span>
            <span class="font-medium">Setting</span>
            @if(request()->routeIs('admin.setting'))
            <span class="ml-auto w-1.5 h-1.5 rounded-full" style="background: #e11d48;"></span>
            @endif
        </a>
    </nav>

    <!-- Bottom: Jam & Tanggal Realtime -->
    <div class="mt-4 pt-4" style="border-top: 1px solid rgba(225,29,72,0.2);">
        <div class="px-2 py-2 rounded-xl text-center">
            {{-- Jam realtime --}}
            <p id="sidebarClock"
               class="text-xl font-black text-white tracking-tight leading-none mb-1"
               style="font-variant-numeric: tabular-nums; letter-spacing: -0.5px;">
                00:00:00
            </p>
            {{-- Hari + Tanggal --}}
            <p id="sidebarDate" class="text-xs font-medium" style="color: rgba(156,163,175,0.75);">
                Memuat...
            </p>
        </div>
    </div>

</aside>

<!-- Overlay Mobile -->
<div id="overlay" class="fixed inset-0 bg-black/60 z-30 hidden lg:hidden backdrop-blur-sm"></div>

<style>
    .active-link {
        color: white;
        background: rgba(225,29,72,0.15);
        border: 1px solid rgba(225,29,72,0.25);
    }
    .inactive-link {
        color: rgba(156,163,175,1);
        border: 1px solid transparent;
    }
    .inactive-link:hover {
        background: rgba(255,255,255,0.05);
        color: white;
        border-color: rgba(255,255,255,0.06);
    }
    .icon-active {
        background: linear-gradient(135deg, #e11d48, #9f1239);
        color: white;
        box-shadow: 0 0 12px rgba(225,29,72,0.4);
    }
    .icon-inactive {
        background: rgba(255,255,255,0.06);
        color: rgba(156,163,175,0.8);
    }
    .inactive-link:hover .icon-inactive {
        background: rgba(225,29,72,0.12);
        color: #e11d48;
    }
</style>

<script>
    const menuBtn = document.getElementById('menuBtn');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    menuBtn.addEventListener('click', () => {
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    });
    overlay.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
    });

    /* ===== Real-time clock ===== */
    const hariID = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
    const bulanID = ['Januari','Februari','Maret','April','Mei','Juni',
                     'Juli','Agustus','September','Oktober','November','Desember'];

    function updateClock() {
        const now  = new Date();
        const hh   = String(now.getHours()).padStart(2, '0');
        const mm   = String(now.getMinutes()).padStart(2, '0');
        const ss   = String(now.getSeconds()).padStart(2, '0');
        const hari = hariID[now.getDay()];
        const tgl  = now.getDate();
        const bln  = bulanID[now.getMonth()];
        const thn  = now.getFullYear();

        const clockEl = document.getElementById('sidebarClock');
        const dateEl  = document.getElementById('sidebarDate');
        if (clockEl) clockEl.textContent = `${hh}:${mm}:${ss}`;
        if (dateEl)  dateEl.textContent  = `${hari}, ${tgl} ${bln} ${thn}`;
    }

    updateClock();
    setInterval(updateClock, 1000);
</script>
