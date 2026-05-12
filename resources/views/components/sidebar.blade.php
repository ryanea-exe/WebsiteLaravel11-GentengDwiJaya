<aside id="sidebar"
    class="fixed top-16 left-0 w-64 h-[calc(100vh-4rem)] bg-gradient-to-b from-orange-900 via-red-800 to-amber-900 text-white p-5 shadow-xl z-40 -translate-x-full lg:translate-x-0 lg:transform-none transition-all duration-300">
    <!-- Logo / Judul -->
    <div class="mb-4">
        <h2 class="text-xl font-bold tracking-wide">
            MENU ADMIN
        </h2>
        <div class="w-16 h-1 bg-orange-300 rounded-full mt-1"></div>
    </div>

    <!-- Navigation -->
    <nav class="space-y-1 text-sm">
        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard') }}"
            class="flex items-center gap-3 px-4 py-1 rounded-xl transition
            {{ request()->routeIs('admin.dashboard')
                ? 'bg-white text-orange-800 font-semibold shadow'
                : 'hover:bg-white/10' }}">
            <i class="fa-solid fa-house text-base w-5 text-center"></i>
            <span>Dashboard</span>
        </a>
        <!-- Genteng -->
        <a href="{{ route('admin.genteng') }}"
            class="flex items-center gap-3 px-4 py-1 rounded-xl transition
            {{ request()->routeIs('admin.genteng')
                ? 'bg-white text-orange-800 font-semibold shadow'
                : 'hover:bg-white/10' }}">
            <i class="fa-solid fa-layer-group text-base w-5 text-center"></i>
            <span>Data Genteng</span>
        </a>
        <!-- User -->
        <a href="{{ route('admin.user') }}"
            class="flex items-center gap-3 px-4 py-1 rounded-xl transition
            {{ request()->routeIs('admin.user')
                ? 'bg-white text-orange-800 font-semibold shadow'
                : 'hover:bg-white/10' }}">
            <i class="fa-solid fa-users text-base w-5 text-center"></i>
            <span>Manajemen User</span>
        </a>
        <!-- Setting -->
        <a href="{{ route('admin.setting') }}"
            class="flex items-center gap-3 px-4 py-1 rounded-xl transition
            {{ request()->routeIs('admin.setting')
                ? 'bg-white text-orange-800 font-semibold shadow-lg'
                : 'hover:bg-white/10' }}">
            <i class="fa-solid fa-gear text-base w-5 text-center"></i>
            <span>Setting</span>
        </a>
    </nav>
</aside>

<!-- Overlay Mobile -->
<div id="overlay"
    class="fixed inset-0 bg-black/50 z-30 hidden lg:hidden">
</div>

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
</script>