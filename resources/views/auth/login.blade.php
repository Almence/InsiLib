<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>InsiLib - Masuk</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:ital@1&display=swap" rel="stylesheet">
<style>
  body { font-family: 'Inter', sans-serif; }
  .font-serif-italic { font-family: 'Playfair Display', serif; font-style: italic; }
</style>
</head>
<body class="bg-white">

  <!-- Navbar -->
  <nav class="flex items-center justify-between px-6 md:px-10 py-4 border-b border-gray-100">
    <div class="flex items-center gap-2">
      <div class="w-8 h-8 bg-cyan-700 rounded-md flex items-center justify-center text-white text-sm font-bold">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
          <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
        </svg>
      </div>
      <span class="font-serif-italic text-lg text-cyan-800">InsiLib</span>
    </div>
    <div class="hidden sm:flex items-center gap-6 text-sm text-gray-600">
      <a href="#" class="text-cyan-700 font-medium">Beranda</a>
      <a href="#" class="hover:text-gray-900">Tentang</a>
      <a href="#" class="hover:text-gray-900">Pengaturan</a>
    </div>
    <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin keluar?')">
      @csrf
      <button type="submit" class="text-sm bg-cyan-50 text-cyan-700 px-4 py-1.5 rounded-md font-medium hover:bg-cyan-100">
        Logout
      </button>
    </form>
  </nav>

  <!-- Main split section -->
  <div class="flex flex-col md:flex-row min-h-[calc(100vh-65px)]">

    <!-- Left panel -->
    <div class="relative w-full md:w-1/2 min-h-[320px] md:min-h-full flex flex-col justify-between p-8 md:p-12 overflow-hidden">
      <!-- background image + overlay -->
      <div class="absolute inset-0 bg-cover bg-center"
           style="background-image: url('https://images.unsplash.com/photo-1521587760476-6c12a4b040da?auto=format&fit=crop&w=1200&q=80');"></div>
      <div class="absolute inset-0 bg-cyan-800/80"></div>

      <div class="relative z-10">
        <span class="inline-block border border-white/40 text-white text-xs px-3 py-1 rounded-full mb-6">
          Gerbang Pengetahuan
        </span>
        <h1 class="font-serif-italic text-white text-4xl md:text-5xl mb-2">InsiLib</h1>
      </div>

      <div class="relative z-10 text-white max-w-md">
        <h2 class="text-2xl md:text-3xl font-semibold mb-3">Perpustakaan Wawasan Anda</h2>
        <p class="text-white/80 text-sm mb-5 leading-relaxed">
          Temukan koleksi pustaka digital, arsip pengetahuan, dan literatur pilihan dari
          seluruh dunia untuk menunjang pencapaian akademis dan riset terbaik Anda.
        </p>
        <ul class="space-y-2 text-sm">
          <li class="flex items-center gap-2">
            <span class="text-cyan-300">✦</span> Akses 24/7 Tanpa Batas
          </li>
          <li class="flex items-center gap-2">
            <span class="text-cyan-300">✦</span> Ribuan Jurnal Terakreditasi
          </li>
          <li class="flex items-center gap-2">
            <span class="text-cyan-300">✦</span> Rekomendasi Cerdas Berbasis AI
          </li>
        </ul>
      </div>
    </div>

    <!-- Right panel -->
    <div class="w-full md:w-1/2 flex items-center justify-center bg-[#F3F1EC] p-8 md:p-12">
      <div class="w-full max-w-sm">
        <h2 class="text-2xl font-bold text-gray-900 mb-1">Selamat Datang</h2>
        <p class="text-sm text-gray-500 mb-8">Masukkan kredensial Anda untuk mengakses akun</p>

        <form action="{{ route('login.process') }}" method="POST" class="space-y-5">
            @csrf
          @if ($errors->any())
            <div class="rounded-md bg-red-100 p-3 text-sm text-red-700" role="alert">
              {{ $errors->first() }}
            </div>
          @endif
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">Alamat Email</label>
            <div class="relative">
              <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <rect x="2" y="4" width="20" height="16" rx="2"/>
                  <path d="m22 6-10 7L2 6"/>
                </svg>
              </span>
              <input type="email" id="email" name="email" placeholder="example@email.com" required value="{{ old('email') }}"
                class="w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-md text-sm bg-white focus:outline-none focus:ring-2 focus:ring-cyan-600 focus:border-transparent">
            </div>
          </div>

          <div>
            <div class="flex items-center justify-between mb-1.5">
              <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi</label>
            </div>
            <div class="relative">
              <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <rect x="3" y="11" width="18" height="10" rx="2"/>
                  <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                </svg>
              </span>
              <input type="password" id="password" name="password" placeholder="••••••••••" required
                class="w-full pl-10 pr-10 py-2.5 border border-gray-300 rounded-md text-sm bg-white focus:outline-none focus:ring-2 focus:ring-cyan-600 focus:border-transparent">
              <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-3 flex items-center text-cyan-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z"/>
                  <circle cx="12" cy="12" r="3"/>
                </svg>
              </button>
            </div>
            <div class="text-right mt-1.5">
              <a href="#" class="text-xs text-cyan-700 hover:underline">Lupa Kata Sandi?</a>
            </div>
          </div>

          <button type="submit"
            class="w-full bg-cyan-800 hover:bg-cyan-900 text-white font-medium py-2.5 rounded-md text-sm transition-colors">
            Masuk Ke Perpustakaan
          </button>

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-sm font-medium">
            {{ session('success') }}
                </div>
            @endif

          <p class="text-center text-sm text-gray-500">
            Baru di InsiLib? <a href="#" class="text-cyan-700 font-medium hover:underline">Daftar akun</a>
          </p>
        </form>
      </div>
    </div>

  </div>

  <script>
    function togglePassword() {
      const input = document.getElementById('password');
      input.type = input.type === 'password' ? 'text' : 'password';
    }
  </script>
</body>
</html>
