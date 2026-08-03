<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login - Genteng Dwijaya Admin Panel">
    <title>Login | Genteng Dwijaya</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        html, body { height: 100%; }
        body { font-family: 'Inter', sans-serif; }

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #0f0f0f; }
        ::-webkit-scrollbar-thumb { background: #e11d48; border-radius: 3px; }

        .text-gradient {
            background: linear-gradient(135deg, #e11d48 0%, #f97316 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Page background */
        .page-bg {
            background:
                radial-gradient(ellipse at 20% 50%, rgba(225,29,72,0.15) 0%, transparent 55%),
                radial-gradient(ellipse at 80% 20%, rgba(249,115,22,0.10) 0%, transparent 50%),
                radial-gradient(ellipse at 60% 90%, rgba(159,18,57,0.12) 0%, transparent 50%),
                #0a0a0a;
        }

        /* Grid overlay */
        .grid-bg {
            background-image:
                linear-gradient(rgba(225,29,72,0.07) 1px, transparent 1px),
                linear-gradient(90deg, rgba(225,29,72,0.07) 1px, transparent 1px);
            background-size: 60px 60px;
        }

        /* Glass card */
        .glass-card {
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255,255,255,0.10);
        }

        /* Blob animation */
        .blob {
            background: linear-gradient(135deg, #e11d48 0%, #9f1239 60%, #f97316 100%);
            border-radius: 60% 40% 70% 30% / 50% 60% 40% 70%;
            animation: blobMove 8s ease-in-out infinite;
        }
        @keyframes blobMove {
            0%,100% { border-radius: 60% 40% 70% 30% / 50% 60% 40% 70%; }
            33%      { border-radius: 40% 60% 30% 70% / 60% 40% 70% 50%; }
            66%      { border-radius: 70% 30% 60% 40% / 40% 70% 50% 60%; }
        }

        /* Input focus glow */
        .input-glow {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.12);
            color: white;
            transition: border-color 0.3s, box-shadow 0.3s, background 0.3s;
        }
        .input-glow::placeholder { color: rgba(156,163,175,0.6); }
        .input-glow:focus {
            outline: none;
            border-color: #e11d48;
            background: rgba(225,29,72,0.05);
            box-shadow: 0 0 0 3px rgba(225,29,72,0.15);
        }

        /* Button glow */
        .btn-glow {
            background: linear-gradient(135deg, #e11d48, #9f1239);
            box-shadow: 0 0 20px rgba(225,29,72,0.4);
            transition: box-shadow 0.3s, transform 0.3s;
        }
        .btn-glow:hover {
            box-shadow: 0 0 35px rgba(225,29,72,0.65);
            transform: translateY(-1px);
        }
        .btn-glow:active { transform: translateY(0); }

        /* Particle */
        .particle {
            position: absolute;
            border-radius: 50%;
            animation: particleFloat linear infinite;
        }
        @keyframes particleFloat {
            0%   { transform: translateY(0) translateX(0); opacity: 0; }
            10%  { opacity: 0.35; }
            90%  { opacity: 0.35; }
            100% { transform: translateY(-500px) translateX(30px); opacity: 0; }
        }

        /* Card entrance */
        .card-enter {
            animation: cardEnter 0.7s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
        }
        @keyframes cardEnter {
            0%   { opacity: 0; transform: translateY(40px) scale(0.96); }
            100% { opacity: 1; transform: translateY(0) scale(1); }
        }

        /* Input icon */
        .input-wrapper { position: relative; }
        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(156,163,175,0.7);
            pointer-events: none;
            transition: color 0.3s;
        }
        .input-glow:focus ~ .input-icon,
        .input-wrapper:focus-within .input-icon { color: #e11d48; }

        /* Show password toggle */
        .toggle-pw {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(156,163,175,0.6);
            cursor: pointer;
            transition: color 0.2s;
            background: none;
            border: none;
        }
        .toggle-pw:hover { color: #e11d48; }

        /* Checkbox custom */
        input[type="checkbox"] { accent-color: #e11d48; }

        /* Pulse ring */
        @keyframes pulseRing {
            0%   { transform: scale(0.9); opacity: 0.6; }
            100% { transform: scale(1.3); opacity: 0; }
        }
        .pulse-ring { animation: pulseRing 2.5s ease-out infinite; }

        /* Shake on error */
        @keyframes shake {
            0%,100% { transform: translateX(0); }
            20%     { transform: translateX(-8px); }
            40%     { transform: translateX(8px); }
            60%     { transform: translateX(-5px); }
            80%     { transform: translateX(5px); }
        }
        .shake { animation: shake 0.5s ease-in-out; }
    </style>
</head>

<body class="page-bg min-h-screen flex items-center justify-center relative overflow-hidden">

    <!-- Grid overlay -->
    <div class="absolute inset-0 grid-bg opacity-100 pointer-events-none"></div>

    <!-- Particle container -->
    <div class="absolute inset-0 pointer-events-none" id="particles-container"></div>

    <!-- Blobs decoratif -->
    <div class="blob absolute w-[500px] h-[500px] -top-40 -left-40 opacity-20 pointer-events-none"></div>
    <div class="blob absolute w-[400px] h-[400px] -bottom-32 -right-32 opacity-15 pointer-events-none" style="animation-delay: 4s; animation-direction: reverse;"></div>

    <!-- Pulse rings dekoratif -->
    <div class="absolute top-1/4 right-1/4 w-80 h-80 rounded-full border border-red-500/10 pulse-ring pointer-events-none"></div>
    <div class="absolute bottom-1/4 left-1/3 w-48 h-48 rounded-full border border-orange-500/10 pulse-ring pointer-events-none" style="animation-delay: 1.2s;"></div>

    <!-- MAIN CARD -->
    <div class="relative z-10 w-full max-w-md mx-4 card-enter">

        <!-- Logo / Branding -->
        <div class="text-center mb-8">
            <a href="/" class="inline-flex flex-col items-center gap-3 group">
                <div class="relative">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-red-600 to-red-900 flex items-center justify-center shadow-2xl shadow-red-950/60 group-hover:shadow-red-500/40 transition-all duration-300 group-hover:scale-105">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2L2 8v2h20V8L12 2zm-9 9v9h6v-5h6v5h6V11H3z"/>
                        </svg>
                    </div>
                    <div class="absolute -inset-1 rounded-2xl bg-gradient-to-br from-red-600 to-red-900 opacity-20 blur-lg group-hover:opacity-30 transition"></div>
                </div>
                <div>
                    <p class="text-xl font-black tracking-tight text-white">Genteng <span class="text-gradient">Dwijaya</span></p>
                    <p class="text-gray-500 text-xs mt-0.5">Admin Panel</p>
                </div>
            </a>
        </div>

        <!-- Card -->
        <div class="glass-card rounded-3xl p-8 shadow-2xl shadow-black/50">

            <!-- Header card -->
            <div class="mb-7">
                <h1 class="text-2xl font-black text-white">Selamat Datang</h1>
                <p class="text-gray-500 text-sm mt-1">Masuk ke akun Anda untuk melanjutkan</p>
            </div>

            <!-- Alert Error -->
            @if(session('error'))
            <div id="alert-error" class="flex items-start gap-3 bg-red-950/60 border border-red-800/50 rounded-2xl px-4 py-3 mb-6 shake">
                <svg class="w-5 h-5 text-red-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-red-300 text-sm">{{ session('error') }}</p>
            </div>
            @endif

            <!-- Alert Success -->
            @if(session('success'))
            <div class="flex items-start gap-3 bg-green-950/60 border border-green-800/50 rounded-2xl px-4 py-3 mb-6">
                <svg class="w-5 h-5 text-green-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-green-300 text-sm">{{ session('success') }}</p>
            </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}" id="login-form">
                @csrf

                <!-- Email -->
                <div class="mb-5">
                    <label for="email" class="block text-sm font-medium text-gray-300 mb-2">
                        Alamat Email
                    </label>
                    <div class="input-wrapper">
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="nama@email.com"
                            required
                            autocomplete="email"
                            class="input-glow w-full rounded-xl py-3 pl-11 pr-4 text-sm @error('email') border-red-500 @enderror">
                        <span class="input-icon">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                            </svg>
                        </span>
                    </div>
                    @error('email')
                    <p class="text-red-400 text-xs mt-1.5 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-5">
                    <div class="flex items-center justify-between mb-2">
                        <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                        <a href="#" class="text-xs text-red-400 hover:text-red-300 transition">Lupa password?</a>
                    </div>
                    <div class="input-wrapper">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Masukkan password"
                            required
                            autocomplete="current-password"
                            class="input-glow w-full rounded-xl py-3 pl-11 pr-11 text-sm @error('password') border-red-500 @enderror">
                        <span class="input-icon">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </span>
                        <button type="button" id="toggle-pw" class="toggle-pw" aria-label="Tampilkan password">
                            <svg id="eye-icon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                    <p class="text-red-400 text-xs mt-1.5 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <!-- Remember me -->
                <div class="flex items-center gap-2 mb-6">
                    <input type="checkbox" id="remember" name="remember" class="w-4 h-4 rounded">
                    <label for="remember" class="text-sm text-gray-400 cursor-pointer select-none">Ingat saya di perangkat ini</label>
                </div>

                <!-- Submit -->
                <button type="submit" id="btn-login"
                    class="btn-glow w-full text-white font-bold py-3.5 rounded-xl text-sm flex items-center justify-center gap-2">
                    <svg id="btn-icon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                    <span id="btn-text">Masuk ke Dashboard</span>
                </button>

            </form>

            <!-- Divider -->
            <div class="flex items-center gap-3 my-6">
                <div class="flex-1 h-px bg-white/10"></div>
                <span class="text-gray-600 text-xs">atau</span>
                <div class="flex-1 h-px bg-white/10"></div>
            </div>

            <!-- Back to landing -->
            <a href="/"
               class="flex items-center justify-center gap-2 w-full border border-white/10 text-gray-400 text-sm font-medium py-3 rounded-xl hover:border-red-500/40 hover:text-red-400 hover:bg-red-950/20 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Halaman Utama
            </a>

        </div>

        <!-- Footer text -->
        <p class="text-center text-gray-700 text-xs mt-6">
            &copy; 2026 Genteng Dwijaya. All rights reserved.
        </p>

    </div>

    <script>
        // Particle generator
        const container = document.getElementById('particles-container');
        if (container) {
            const colors = ['#e11d48','#f97316','#fda4af','#fb7185'];
            for (let i = 0; i < 18; i++) {
                const dot = document.createElement('div');
                const size = Math.random() * 4 + 2;
                dot.classList.add('particle');
                dot.style.cssText = 'left:' + Math.random() * 100 + '%;bottom:' + Math.random() * 15 + '%;width:' + size + 'px;height:' + size + 'px;background:' + colors[Math.floor(Math.random() * colors.length)] + ';animation-duration:' + (Math.random() * 7 + 5) + 's;animation-delay:' + Math.random() * 5 + 's;opacity:0.3';
                container.appendChild(dot);
            }
        }

        // Toggle password visibility
        const toggleBtn = document.getElementById('toggle-pw');
        const pwInput   = document.getElementById('password');
        const eyeIcon   = document.getElementById('eye-icon');
        const eyeOpenPath  = 'M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z';
        const eyeClosedPath = 'M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21';

        if (toggleBtn && pwInput) {
            toggleBtn.addEventListener('click', () => {
                const isHidden = pwInput.type === 'password';
                pwInput.type = isHidden ? 'text' : 'password';
                eyeIcon.innerHTML = isHidden
                    ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="' + eyeClosedPath + '"/>'
                    : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>';
                toggleBtn.style.color = isHidden ? '#e11d48' : '';
            });
        }

        // Loading state on submit
        const form    = document.getElementById('login-form');
        const btnText = document.getElementById('btn-text');
        const btnIcon = document.getElementById('btn-icon');
        if (form) {
            form.addEventListener('submit', () => {
                btnText.textContent = 'Memproses...';
                btnIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>';
                btnIcon.classList.add('animate-spin');
            });
        }
    </script>

</body>
</html>
