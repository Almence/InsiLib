<!DOCTYPE html>
<html lang="en" data-theme="lofi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($title) ? $title . ' - Chirper' : 'Chirper' }}</title>
    <link rel="preconnect" href="<https://fonts.bunny.net>">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .font-serif-italic {
            font-family: 'Playfair Display', serif;
            font-style: italic;
        }
    </style>
</head>

<body class="min-h-screen flex flex-col bg-base-200 font-sans">
    <nav class="flex items-center justify-between px-6 md:px-10 py-4 border-b border-gray-100">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-cyan-700 rounded-md flex items-center justify-center text-white text-sm font-bold">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2">
                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" />
                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" />
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
            <button type="submit"
                class="text-sm bg-cyan-50 text-cyan-700 px-4 py-1.5 rounded-md font-medium hover:bg-cyan-100">
                Logout
            </button>
        </form>
    </nav>

    <main class="flex-1 container mx-auto px-4 py-8">
        {{ $slot }}
    </main>

    <footer class="footer footer-center p-5 bg-base-300 text-base-content text-xs">
        <div>
            <p>© {{ date('Y') }} Chirper - Built with Laravel and ❤️</p>
        </div>
    </footer>
</body>

</html>