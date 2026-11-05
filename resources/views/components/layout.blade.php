<!DOCTYPE html>
<html lang="id" data-theme="">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($title) ? $title . ' - InsiLib' : 'InsiLib' }}</title>
    <link rel="preconnect" href="<https://fonts.bunny.net>">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Old+Standard+TT:ital,wght@0,400;0,700;1,400&display=swap"
        rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Old+Standard+TT:ital,wght@0,400;0,700;1,400&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap');

        body {
            font-family: 'Outfit', sans-serif;
        }

        .font-serif-italic {
            font-family: 'Playfair Display', serif;
            font-style: italic;
        }
    </style>
</head>

<body class="min-h-screen flex flex-col bg-base-200 font-sans">
    <div class="drawer flex-1">
        <input id="my-drawer-2" type="checkbox" class="drawer-toggle lg:hidden" />
        <div class="drawer-content flex flex-col">
            <!-- Navbar -->
            <div id="up" class="navbar border-b border-base-200 justify-between bg-base-100 shadow-sm no-print">
                <div class="flex-none lg:hidden">
                    <label for="my-drawer-2" aria-label="open sidebar" class="btn btn-square btn-ghost drawer-button">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            class="inline-block h-6 w-6 stroke-current">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </label>
                </div>
                <div class="lg:navbar-start mx-2 px-2">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <div
                            class="w-8 h-8 bg-cyan-700 rounded-md flex items-center justify-center text-white text-sm font-bold">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" />
                                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" />
                            </svg>
                        </div>
                        <span class="font-serif-italic text-lg text-cyan-700">InsiLib</span>
                    </a>
                </div>
                <div class="hidden lg:navbar-end flex-none lg:block lg:items-center">
                    <ul class="menu menu-horizontal mx-auto w-full justify-center">
                        <!-- Navbar menu content here -->
                        <li class="{{ request()->is('dashboard') ? 'border-b border-cyan-700' : '' }}"><a
                                href="{{ route('dashboard') }}"
                                class="{{ request()->is('dashboard') ? 'text-cyan-700' : '' }} hover:text-cyan-700">Dashboard</a>
                        </li>
                        <li class="{{ request()->is('profile') ? 'border-b border-cyan-700' : '' }}"><a
                                href="{{ route('profile') }}"
                                class="{{ request()->is('profile') ? 'text-cyan-700' : '' }} hover:text-cyan-700">Profil</a>
                        </li>
                        <li class="{{ request()->is('catalog') ? 'border-b border-cyan-700' : '' }}"><a
                                href="{{ route('catalog') }}"
                                class="{{ request()->is('catalog') ? 'text-cyan-700' : '' }} hover:text-cyan-700">Katalog
                                Buku</a></li>
                    </ul>
                </div>
                <div class="lg:navbar-end">
                    <button type="submit" onclick="modal_logout.showModal()"
                        class="btn bg-cyan-700 text-sm font-medium text-white hover:bg-red-800">
                        Logout
                    </button>
                </div>

                <dialog id="modal_logout" class="modal">
                    <div class="modal-box">
                        <div role="alert" class="alert alert-warning alert-soft alert-vertical sm:alert-horizontal">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current"
                                fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <span>Apakah Anda yakin untuk Logout?</span>
                        </div>
                        <div class="mt-2 flex flex-row justify-center gap-6">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="btn w-full bg-cyan-700 text-sm font-medium text-white hover:bg-red-800">
                                    Ya
                                </button>
                            </form>
                            <form method="dialog">
                                <button class="btn w-full text-sm font-light">Tidak</button>
                            </form>
                        </div>
                    </div>
                </dialog>
            </div>
            <main class="container mx-auto w-full max-w-7xl flex-1 px-4 py-8 md:py-10">
                {{ $slot }}
            </main>
        </div>
        <div class="drawer-side">
            <label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay"></label>
            <ul class="menu min-h-full w-80 bg-base-100 p-4">
                <!-- Sidebar content here -->
                <li class="{{ request()->is('dashboard') ? 'border-l border-cyan-700 text-cyan-700 bg-base-300' : '' }}"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="{{ request()->is('profile') ? 'border-l border-cyan-700 text-cyan-700 bg-base-300' : '' }}"><a href="{{ route('profile') }}">Profil</a></li>
                <li class="{{ request()->is('catalog') ? 'border-l border-cyan-700 text-cyan-700 bg-base-300' : '' }}"><a href="{{ route('catalog') }}">Katalog Buku</a></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST"
                        onsubmit="return confirm('Apakah Anda yakin ingin keluar?')">
                        @csrf
                        <button type="submit"
                            class="rounded-md bg-cyan-700 px-4 py-1.5 text-sm font-medium text-white hover:bg-cyan-800">
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>

    <div class="fab no-print">
        <a href="#up" class="btn btn-lg btn-circle bg-cyan-700 text-white">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <path d="M12 4V20M12 4L8 8M12 4L16 8" stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                </g>
            </svg>
        </a>
    </div>



    <footer class="border-t border-base-300 bg-base-100 no-print">
        <div class="footer mx-auto max-w-7xl gap-10 px-6 py-10 text-base-content sm:footer-horizontal md:px-8">
            <aside class="max-w-sm">
                <a href="{{ route('catalog') }}" class="flex items-center gap-3">
                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-cyan-700 text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2">
                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" fill="oklch(52% 0.105 223.128" />
                            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" />
                        </svg>
                    </span>
                    <span class="font-serif-italic text-xl text-cyan-700">InsiLib</span>
                </a>
                <p class="mt-2 text-sm leading-relaxed text-base-content/70">
                    Perpustakaan digital untuk menjelajahi koleksi, menemukan bacaan baru, dan mengelola informasi buku.
                </p>
            </aside>
            <nav>
                <h2 class="footer-title">Jelajahi</h2>
                <a href="{{ route('catalog') }}" class="link link-hover">Katalog Buku</a>
                <a href="{{ route('dashboard') }}" class="link link-hover">Dashboard</a>
                <a href="{{ route('profile') }}" class="link link-hover">Profil</a>
            </nav>
            <nav>
                <h2 class="footer-title">Tentang InsiLib</h2>
                <p class="max-w-xs text-sm text-base-content/70">
                    Temukan informasi judul, penulis, kategori, dan ketersediaan buku dalam satu tempat.
                </p>
            </nav>
        </div>
        <div class="border-t border-base-200 px-6 py-4 text-center text-xs text-base-content/60">
            © {{ date('Y') }} InsiLib. Semua hak dilindungi.
        </div>
    </footer>
</body>

</html>
