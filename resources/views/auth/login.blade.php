<x-layout>
    <x-slot:title>
        Masuk
    </x-slot:title>

    <div class="mx-auto my-8 max-w-5xl md:my-10">
        <div class="overflow-hidden rounded-3xl border border-base-200 bg-base-100 shadow-xl">
            <div class="grid md:grid-cols-5">
                <aside class="relative flex min-h-64 flex-col justify-between overflow-hidden bg-gradient-to-br from-cyan-700 to-cyan-950 p-7 text-white md:col-span-2 md:min-h-full md:p-9">
                    <div class="pointer-events-none absolute -right-14 -top-14 h-48 w-48 rounded-full border-[24px] border-white/10"></div>
                    <div class="pointer-events-none absolute -bottom-20 -left-16 h-56 w-56 rounded-full border-[28px] border-cyan-400/10"></div>

                    <div class="relative">
                        <span class="inline-flex items-center gap-2 rounded-full border border-white/25 bg-white/10 px-3 py-1 text-xs font-medium text-cyan-50">
                            Gerbang Pengetahuan
                        </span>
                        <h1 class="mt-6 font-serif-italic text-4xl md:text-5xl">InsiLib</h1>
                    </div>

                    <div class="relative mt-10">
                        <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-white/10 text-cyan-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2Z" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold md:text-2xl">Selamat datang kembali.</h2>
                        <p class="mt-3 text-sm leading-relaxed text-cyan-50/80">
                            Masuk untuk menjelajahi koleksi, melanjutkan bacaan, dan melihat aktivitas peminjamanmu.
                        </p>
                        <ul class="mt-5 space-y-3 text-sm text-cyan-50/90">
                            <li class="flex items-center gap-3">
                                <span class="flex h-6 w-6 items-center justify-center rounded-full bg-white/10 text-cyan-200">✓</span>
                                Temukan koleksi pilihan
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="flex h-6 w-6 items-center justify-center rounded-full bg-white/10 text-cyan-200">✓</span>
                                Pantau peminjaman buku
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="flex h-6 w-6 items-center justify-center rounded-full bg-white/10 text-cyan-200">✓</span>
                                Kelola akun perpustakaan
                            </li>
                        </ul>
                    </div>
                </aside>

                <section class="flex items-center p-6 sm:p-8 md:col-span-3 md:p-10">
                    <div class="mx-auto w-full max-w-md">
                        <div class="mb-7">
                            <p class="text-xs font-bold uppercase tracking-[0.18em] text-cyan-700">Akun InsiLib</p>
                            <h2 class="mt-2 text-2xl font-bold tracking-tight text-base-content md:text-3xl">Selamat Datang</h2>
                            <p class="mt-2 text-sm leading-relaxed text-base-content/60">
                                Masukkan kredensial untuk mengakses akun perpustakaanmu.
                            </p>
                        </div>

                        @if ($errors->any())
                            <div role="alert" class="alert alert-error mb-6 items-start text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mt-0.5 h-5 w-5 shrink-0 stroke-current"
                                    fill="none" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16.333c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                <span>{{ $errors->first() }}</span>
                            </div>
                        @endif

                        @if (session('success'))
                            <div role="status" class="alert alert-success mb-6 items-start text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mt-0.5 h-5 w-5 shrink-0 stroke-current"
                                    fill="none" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="m5 13 4 4L19 7" />
                                </svg>
                                <span>{{ session('success') }}</span>
                            </div>
                        @endif

                        <form action="{{ route('login.process') }}" method="POST" class="space-y-5">
                            @csrf

                            <div class="space-y-1.5">
                                <label for="email" class="text-sm font-semibold text-base-content/80">Alamat Email</label>
                                <div class="relative">
                                    <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-base-content/40">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2">
                                            <rect x="2" y="4" width="20" height="16" rx="2" />
                                            <path d="m22 6-10 7L2 6" />
                                        </svg>
                                    </span>
                                    <input type="email" id="email" name="email" placeholder="nama@email.com"
                                        required value="{{ old('email') }}" autocomplete="email"
                                        aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}"
                                        class="input input-bordered w-full pl-10 focus:border-cyan-700 focus:outline-cyan-700">
                                </div>
                                @error('email')
                                    <p class="text-xs text-error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-1.5">
                                <label for="password" class="text-sm font-semibold text-base-content/80">Kata Sandi</label>
                                <div class="relative">
                                    <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-base-content/40">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2">
                                            <rect x="3" y="11" width="18" height="10" rx="2" />
                                            <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                                        </svg>
                                    </span>
                                    <input type="password" id="password" name="password" placeholder="Masukkan kata sandi"
                                        required autocomplete="current-password"
                                        aria-invalid="{{ $errors->has('password') ? 'true' : 'false' }}"
                                        class="input input-bordered w-full pl-10 pr-10 focus:border-cyan-700 focus:outline-cyan-700">
                                    <button type="button" onclick="togglePassword()"
                                        aria-label="Tampilkan atau sembunyikan kata sandi"
                                        class="absolute inset-y-0 right-3 flex items-center text-cyan-700 transition hover:text-cyan-900">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z" />
                                            <circle cx="12" cy="12" r="3" />
                                        </svg>
                                    </button>
                                </div>
                                @error('password')
                                    <p class="text-xs text-error">{{ $message }}</p>
                                @enderror
                                <div class="pt-1 text-right">
                                    <a href="#" class="text-xs font-medium text-cyan-700 hover:text-cyan-900 hover:underline">
                                        Lupa kata sandi?
                                    </a>
                                </div>
                            </div>

                            <button type="submit"
                                class="btn w-full border-cyan-700 bg-cyan-700 text-white shadow-sm hover:border-cyan-800 hover:bg-cyan-800">
                                Masuk ke Perpustakaan
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-7-7 7 7-7 7" />
                                </svg>
                            </button>

                            <p class="text-center text-sm text-base-content/60">
                                Baru di InsiLib? <a href="{{ route('register') }}"
                                    class="font-semibold text-cyan-700 hover:text-cyan-900 hover:underline">Daftar akun</a>
                            </p>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            input.type = input.type === 'password' ? 'text' : 'password';
        }
    </script>
</x-layout>
