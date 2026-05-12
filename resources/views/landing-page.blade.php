<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Genteng Dwijaya</title>
    {{-- @vite('resources/css/app.css') --}}
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-sans">
    <!-- NAVBAR -->
    <nav class="fixed top-0 w-full bg-white shadow z-50">
        <div class="container mx-auto flex items-center justify-between p-4">
            <!-- Kiri -->
            <div class="text-xl font-bold text-gray-800">
                Genteng Dwijaya
            </div>
            <!-- Tengah -->
            <div class="hidden md:flex space-x-6 text-gray-600">
                <a href="#hero" class="hover:text-blue-600">Home</a>
                <a href="#keunggulan" class="hover:text-blue-600">Keunggulan</a>
                <a href="#produk" class="hover:text-blue-600">Produk</a>
                <a href="#lokasi" class="hover:text-blue-600">Lokasi</a>
            </div>
            <!-- Kanan -->
            <div>
                <a href="/login" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Login
                </a>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <!--
    <section id="hero" class="h-screen bg-cover bg-center flex items-center justify-center"
        style="background-image: url('https://images.unsplash.com/photo-1598300056393-4aac492f4344');">
        <div class="bg-black bg-opacity-50 w-full h-full flex items-center justify-center">
            <div class="text-center text-white px-6">
                <h1 class="text-4xl md:text-6xl font-bold mb-4">
                    Genteng Berkualitas untuk Rumah Anda
                </h1>
                <p class="text-lg md:text-xl mb-6">
                    Tahan lama, kuat, dan terpercaya sejak lama
                </p>
                <a href="#produk" class="bg-blue-600 px-6 py-3 rounded text-white hover:bg-blue-700">
                    Lihat Produk
                </a>
            </div>
        </div>
    </section>
    -->

    <!-- HERO SECTION MODERN -->
    <section id="hero" class="min-h-screen flex items-center bg-gradient-to-r from-blue-50 to-purple-100 pt-20">
        <div class="container mx-auto px-6 grid md:grid-cols-2 items-center gap-10">
            <!-- LEFT -->
            <div>
                <!-- Label kecil -->
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-1 bg-blue-600"></div>
                    <p class="text-blue-600 font-semibold uppercase text-sm tracking-wide">
                        Genteng Berkualitas
                    </p>
                </div>
                <!-- Heading -->
                <h1 class="text-4xl md:text-6xl font-bold text-gray-800 leading-tight mb-6">
                    Genteng Kuat, <br>
                    <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                        Rumah Aman
                    </span>
                </h1>
                <!-- Deskripsi -->
                <p class="text-gray-600 mb-8 max-w-lg">
                    Genteng pilihan dengan kualitas terbaik, tahan lama, 
                    dan cocok untuk segala kondisi cuaca.
                </p>
                <!-- Button -->
                <div class="flex items-center gap-4 mb-10">
                    <a href="#produk"
                    class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-3 rounded-xl shadow-lg hover:scale-105 transition">
                        Lihat Produk
                    </a>
                    <a href="#"
                    class="flex items-center gap-2 border border-blue-600 text-blue-600 px-6 py-3 rounded-xl hover:bg-blue-600 hover:text-white transition">
                        ▶ Video Profile
                    </a>
                </div>
                <!-- ICON KEUNGGULAN -->
                <div class="flex gap-8 text-center">
                    <div>
                        <div class="w-12 h-12 mx-auto bg-blue-100 text-blue-600 flex items-center justify-center rounded-full mb-2">
                            ✓
                        </div>
                        <p class="text-sm text-gray-600">Tahan Lama</p>
                    </div>
                    <div>
                        <div class="w-12 h-12 mx-auto bg-blue-100 text-blue-600 flex items-center justify-center rounded-full mb-2">
                            ★
                        </div>
                        <p class="text-sm text-gray-600">Kualitas Terbaik</p>
                    </div>
                    <div>
                        <div class="w-12 h-12 mx-auto bg-blue-100 text-blue-600 flex items-center justify-center rounded-full mb-2">
                            $
                        </div>
                        <p class="text-sm text-gray-600">Harga Terjangkau</p>
                    </div>
                </div>
            </div>
            <!-- RIGHT -->
            <div class="relative flex justify-center items-center">
                <!-- SHAPE UTAMA -->
                <div class="absolute w-[420px] h-[420px] 
                    bg-gradient-to-br from-blue-600 to-indigo-700 
                    rounded-[40%_60%_50%_70%/60%_40%_60%_50%] z-0">
                </div>
                <!-- SHAPE BAWAH -->
                <div class="absolute w-[500px] h-[250px] 
                    bg-gradient-to-r from-blue-500 to-purple-500 
                    bottom-0 rounded-t-full z-0">
                </div>
                <!-- DOT PATTERN -->
                <div class="absolute top-10 left-10 grid grid-cols-4 gap-2 z-0">
                    @for ($i = 0; $i < 12; $i++)
                        <div class="w-2 h-2 bg-blue-400 rounded-full"></div>
                    @endfor
                </div>
                <!-- BULAT -->
                <div class="absolute top-0 right-0 w-32 h-32 bg-pink-400 rounded-full opacity-80 z-0"></div>
                <!-- GARIS -->
                <div class="absolute right-0 top-20 w-32 h-32 border-r-4 border-blue-400 rotate-45 opacity-50"></div>
                <!-- IMAGE -->
                <img src="https://cdn-icons-png.flaticon.com/512/619/619153.png"
                    class="relative z-10 w-[350px] md:w-[450px] drop-shadow-2xl hover:scale-105 transition duration-500">
            </div>
        </div>
    </section>

    <!-- SECTION KEUNGGULAN -->
    <section id="keunggulan" class="py-20 bg-gray-100">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold mb-10">Keunggulan Kami</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded shadow">
                    <h3 class="font-bold text-xl mb-2">Kualitas Terbaik</h3>
                    <p>Genteng dibuat dari bahan pilihan dan proses terbaik.</p>
                </div>
                <div class="bg-white p-6 rounded shadow">
                    <h3 class="font-bold text-xl mb-2">Tahan Lama</h3>
                    <p>Ketahanan tinggi terhadap cuaca ekstrem.</p>
                </div>
                <div class="bg-white p-6 rounded shadow">
                    <h3 class="font-bold text-xl mb-2">Harga Terjangkau</h3>
                    <p>Kualitas premium dengan harga bersaing.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION PRODUK -->
    <section id="produk" class="py-20">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold mb-10">Produk Genteng</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Produk 1 -->
                <div class="border rounded shadow">
                    <img src="https://images.unsplash.com/photo-1581091215367-59ab6b1a2a4d" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold">Genteng Natural</h3>
                        <p class="text-gray-600">Kuat dan tahan lama</p>
                    </div>
                </div>
                <!-- Produk 2 -->
                <div class="border rounded shadow">
                    <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold">Genteng Press</h3>
                        <p class="text-gray-600">Desain modern</p>
                    </div>
                </div>
                <!-- Produk 3 -->
                <div class="border rounded shadow">
                    <img src="https://images.unsplash.com/photo-1507089947368-19c1da9775ae" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold">Genteng Glazur</h3>
                        <p class="text-gray-600">Finishing premium</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION MAPS -->
    <section id="lokasi" class="py-20 bg-gray-100">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold mb-6">Lokasi Kami</h2>
            <div class="w-full h-[400px]">
                <iframe 
                    src="https://maps.google.com/maps?q=ponorogo&t=&z=13&ie=UTF8&iwloc=&output=embed"
                    class="w-full h-full rounded shadow"
                    loading="lazy">
                </iframe>
            </div>
        </div>
    </section>

    <!-- NAVBAR BAWAH / CTA -->
    <section class="bg-blue-600 py-10 text-center text-white">
        <h2 class="text-2xl font-bold mb-4">Butuh Genteng Berkualitas?</h2>
        <a href="#" class="bg-white text-blue-600 px-6 py-3 rounded font-semibold">
            Hubungi Kami
        </a>
    </section>

    <!-- FOOTER -->
    <footer class="bg-gray-800 text-white py-6">
        <div class="container mx-auto text-center">
            <p>&copy; 2026 Genteng Dwijaya. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>