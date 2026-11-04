<x-layout>
    <x-slot:title>
        Dashboard InsiLib
    </x-slot:title>

    <div class="mx-2 md:mx-8 my-8">
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">

                <!-- TAMPILAN KHUSUS ADMIN -->
                @if (auth()->user()->role === 'admin')
                    <div
                        class="mb-8 rounded-2xl bg-gradient-to-br from-cyan-700 to-cyan-900 p-6 text-white shadow-lg md:p-8">
                        <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                            <div>
                                <p class="mb-2 text-xs font-bold uppercase tracking-[0.2em] text-cyan-100">Pusat
                                    Pengelolaan InsiLib</p>
                                <h1 class="text-3xl font-bold tracking-tight md:text-4xl">Dashboard Admin</h1>
                                <p class="mt-2 max-w-2xl text-sm leading-relaxed text-cyan-50 md:text-base">
                                    Pantau permintaan peminjaman dan kelola buku yang sedang dipinjam.
                                </p>
                            </div>
                            <div class="flex flex-wrap gap-2">
                                <div class="dropdown dropdown-hover dropdown-center">
                                    <div tabindex="0" role="button" class="btn m-1"><svg viewBox="0 0 16 16"
                                            fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path d="M0 11H3L3 0H5L5 11H8V12L4 16L0 12V11Z"
                                                    fill="oklch(52% 0.105 223.128)"></path>
                                                <path d="M16 0H10V2H16V0Z" fill="oklch(52% 0.105 223.128)"></path>
                                                <path d="M10 4H14V6H10V4Z" fill="oklch(52% 0.105 223.128)"></path>
                                                <path d="M12 8H10V10H12V8Z" fill="oklch(52% 0.105 223.128)"></path>
                                            </g>
                                        </svg><span class="text-cyan-700">Kelola Buku</span></div>
                                    <ul tabindex="-1"
                                        class="dropdown-content menu bg-base-100 rounded-box z-1 w-40 p-2 shadow-sm">
                                        <li> <a href="{{ route('admin.print-qr') }}"
                                                class="btn btn-sm border-white bg-white text-cyan-800 hover:border-cyan-50 hover:bg-cyan-50">
                                                Cetak QR Buku
                                            </a></li>
                                        <li> <a href="{{ route('books.create') }}"
                                                class="btn btn-sm border-white bg-white text-cyan-800 hover:border-cyan-50 hover:bg-cyan-50">
                                                Tambah Buku
                                            </a></li>
                                        <li> <a href="{{ route('catalog') }}"
                                                class="btn btn-sm border-white bg-white text-cyan-800 hover:border-cyan-50 hover:bg-cyan-50">
                                                Edit Buku
                                            </a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-8 grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div class="flex items-center gap-4 rounded-2xl border border-amber-200 bg-amber-50 p-5">
                            <div
                                class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-amber-100 text-amber-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <circle cx="12" cy="12" r="9" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 7v5l3 2" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-amber-800">Menunggu Verifikasi</p>
                                <p class="mt-1 text-3xl font-bold leading-none text-amber-950">
                                    {{ $pendingLoans->count() }}</p>
                                <p class="mt-1 text-xs text-amber-800/80">permintaan peminjaman</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 rounded-2xl border border-cyan-200 bg-cyan-50 p-5">
                            <div
                                class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-cyan-100 text-cyan-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2Z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-cyan-800">Sedang Dipinjam</p>
                                <p class="mt-1 text-3xl font-bold leading-none text-cyan-950">
                                    {{ $borrowedLoans->count() }}</p>
                                <p class="mt-1 text-xs text-cyan-800/80">buku menunggu pengembalian</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-8">
                        <div class="mb-4 flex flex-wrap items-center justify-between gap-2">
                            <div>
                                <p class="text-xs font-bold uppercase tracking-[0.16em] text-amber-700">Perlu
                                    ditindaklanjuti</p>
                                <h2 class="mt-1 text-xl font-bold">Verifikasi Peminjaman</h2>
                            </div>
                            <span class="badge border-amber-200 bg-amber-50 text-amber-800">
                                {{ $pendingLoans->count() }} permintaan
                            </span>
                        </div>
                        <div class="space-y-3">
                            @forelse($pendingLoans ?? [] as $loan)
                                <div
                                    class="flex flex-col gap-4 rounded-2xl border border-base-200 bg-base-100 p-4 shadow-sm sm:flex-row sm:items-center sm:justify-between md:p-5">
                                    <div class="flex min-w-0 items-center gap-4">
                                        <img src="{{ $loan->book->cover_image }}" alt="Sampul {{ $loan->book->title }}"
                                            class="h-20 w-14 shrink-0 rounded-lg object-cover shadow-sm" />
                                        <div class="min-w-0">
                                            <span
                                                class="badge badge-sm border-amber-200 bg-amber-50 text-amber-800">Menunggu
                                                verifikasi</span>
                                            <h3 class="mt-2 line-clamp-1 font-bold">{{ $loan->book->title }}</h3>
                                            <p class="mt-1 text-sm text-base-content/70">
                                                {{ $loan->user->name }} <span class="text-base-content/40">·</span>
                                                {{ $loan->user->email }}
                                            </p>
                                            <p class="mt-2 text-xs text-base-content/60">
                                                Kode anggota:
                                                <span
                                                    class="font-mono font-bold tracking-widest text-cyan-700">{{ $loan->verification_code }}</span>
                                            </p>
                                        </div>
                                    </div>

                                    <form action="{{ route('admin.loans.approve', $loan->id) }}" method="POST"
                                        class="flex w-full gap-2 sm:w-auto">
                                        @csrf
                                        <input type="text" name="verification_code" maxlength="4"
                                            inputmode="numeric" pattern="[0-9]{4}" placeholder="Kode 4 digit"
                                            class="input input-bordered input-sm min-w-0 flex-1 font-mono text-center sm:w-32 sm:flex-none"
                                            aria-label="Masukkan kode verifikasi 4 digit" required />
                                        <button type="submit"
                                            class="btn btn-sm border-cyan-700 bg-cyan-700 text-white hover:border-cyan-800 hover:bg-cyan-800">
                                            Verifikasi
                                        </button>
                                    </form>
                                </div>
                            @empty
                                <div
                                    class="rounded-2xl border border-dashed border-base-300 bg-base-200/40 px-4 py-8 text-center">
                                    <p class="font-medium">Semua permintaan sudah ditangani</p>
                                    <p class="mt-1 text-sm text-base-content/60">Belum ada peminjaman yang menunggu
                                        verifikasi.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <div>
                        <div class="mb-4 flex flex-wrap items-center justify-between gap-2">
                            <div>
                                <p class="text-xs font-bold uppercase tracking-[0.16em] text-cyan-700">Transaksi aktif
                                </p>
                                <h2 class="mt-1 text-xl font-bold">Buku Menunggu Pengembalian</h2>
                            </div>
                            <span class="badge border-cyan-200 bg-cyan-50 text-cyan-800">
                                {{ $borrowedLoans->count() }} buku
                            </span>
                        </div>
                        <div class="space-y-3">
                            @forelse($borrowedLoans ?? [] as $loan)
                                <div
                                    class="flex flex-col gap-4 rounded-2xl border border-base-200 bg-base-100 p-4 shadow-sm sm:flex-row sm:items-center sm:justify-between md:p-5">
                                    <div class="flex min-w-0 items-center gap-4">
                                        <img src="{{ $loan->book->cover_image }}"
                                            alt="Sampul {{ $loan->book->title }}"
                                            class="h-20 w-14 shrink-0 rounded-lg object-cover shadow-sm" />
                                        <div class="min-w-0">
                                            <span
                                                class="badge badge-sm border-cyan-200 bg-cyan-50 text-cyan-800">Sedang
                                                dipinjam</span>
                                            <h3 class="mt-2 line-clamp-1 font-bold">{{ $loan->book->title }}</h3>
                                            <p class="mt-1 text-sm text-base-content/70">
                                                Dipinjam oleh <span
                                                    class="font-medium text-base-content">{{ $loan->user->name }}</span>
                                            </p>
                                            <p class="mt-1 text-xs text-base-content/60">
                                                Tenggat pengembalian:
                                                <span class="font-semibold text-cyan-700">{{ $loan->due_date }}</span>
                                            </p>
                                        </div>
                                    </div>

                                    <form action="{{ route('admin.loans.return', $loan->id) }}" method="POST"
                                        onsubmit="return confirm('Terima pengembalian buku ini?')">
                                        @csrf
                                        <button type="submit"
                                            class="btn btn-sm border-cyan-700 bg-cyan-700 text-white hover:border-cyan-800 hover:bg-cyan-800">
                                            Terima Pengembalian
                                        </button>
                                    </form>
                                </div>
                            @empty
                                <div
                                    class="rounded-2xl border border-dashed border-base-300 bg-base-200/40 px-4 py-8 text-center">
                                    <p class="font-medium">Tidak ada buku yang sedang dipinjam</p>
                                    <p class="mt-1 text-sm text-base-content/60">Daftar ini akan terisi setelah
                                        peminjaman diverifikasi.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- TAMPILAN KHUSUS MEMBER / USER BIASA -->
                @else
                    <div
                        class="mb-8 overflow-hidden rounded-2xl bg-gradient-to-br from-cyan-700 to-cyan-900 p-6 text-white shadow-lg md:p-8">
                        <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
                            <div>
                                <p class="mb-2 text-xs font-bold uppercase tracking-[0.2em] text-cyan-100">Ruang baca
                                    InsiLib</p>
                                <h1 class="text-3xl font-bold tracking-tight md:text-4xl">Riwayat Peminjaman</h1>
                                <p class="mt-2 max-w-2xl text-sm leading-relaxed text-cyan-50 md:text-base">
                                    Halo, {{ auth()->user()->name }}. Pantau status dan riwayat buku yang pernah kamu
                                    pinjam.
                                </p>
                            </div>
                            <div class="rounded-xl border border-white/20 bg-white/10 px-5 py-3 sm:text-right">
                                <p class="text-xs font-medium text-cyan-100">Total peminjaman</p>
                                <p class="mt-1 text-3xl font-bold leading-none">{{ $loans->total() }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4 flex flex-wrap items-end justify-between gap-2">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-[0.16em] text-cyan-700">Aktivitas akun</p>
                            <h2 class="mt-1 text-xl font-bold">Buku yang Dipinjam</h2>
                        </div>
                        <a href="{{ route('catalog') }}"
                            class="btn btn-sm border-cyan-700 bg-cyan-700 text-white hover:border-cyan-800 hover:bg-cyan-800">
                            Jelajahi Katalog
                        </a>
                    </div>

                    <div class="space-y-3">
                        @forelse($loans ?? [] as $loan)
                            <article
                                class="flex flex-col gap-4 rounded-2xl border border-base-200 bg-base-100 p-4 shadow-sm transition hover:border-cyan-700/30 hover:shadow-md sm:flex-row md:gap-6 md:p-5">
                                <div class="flex min-w-0 flex-1 items-start gap-4">
                                    <div class="h-28 w-20 shrink-0 overflow-hidden rounded-xl bg-base-200 shadow-sm">
                                        @if ($loan->book->cover_image)
                                            @if (\Illuminate\Support\Str::startsWith($loan->book->cover_image, ['http://', 'https://']))
                                                <img src="{{ $loan->book->cover_image }}"
                                                    alt="Sampul {{ $loan->book->title }}"
                                                    class="h-full w-full object-cover" />
                                            @else
                                                <img src="{{ asset('storage/' . $loan->book->cover_image) }}"
                                                    alt="Sampul {{ $loan->book->title }}"
                                                    class="h-full w-full object-cover" />
                                            @endif
                                        @else
                                            <img src="{{ asset('images/NoImage.jpg') }}" alt="Sampul tidak tersedia"
                                                class="h-full w-full object-cover" />
                                        @endif
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <div class="flex flex-wrap items-center gap-2">
                                            @if ($loan->status == 'pending')
                                                <span
                                                    class="badge badge-sm border-amber-200 bg-amber-50 text-amber-800">Menunggu
                                                    Verifikasi</span>
                                            @elseif($loan->status == 'borrowed')
                                                <span
                                                    class="badge badge-sm border-cyan-200 bg-cyan-50 text-cyan-800">Sedang
                                                    Dipinjam</span>
                                            @elseif($loan->status == 'returned')
                                                <span
                                                    class="badge badge-sm border-emerald-200 bg-emerald-50 text-emerald-800">Dikembalikan</span>
                                            @else
                                                <span
                                                    class="badge badge-sm border-base-300 bg-base-200 text-base-content/70">{{ ucfirst($loan->status) }}</span>
                                            @endif
                                        </div>
                                        <h3 class="mt-2 line-clamp-2 text-lg font-bold leading-snug">
                                            {{ $loan->book->title }}</h3>
                                        <p class="mt-1 text-sm text-base-content/70">Penulis:
                                            {{ $loan->book->author }}</p>

                                        <div
                                            class="mt-4 grid grid-cols-1 gap-2 text-xs text-base-content/70 sm:grid-cols-2">
                                            <p>
                                                <span class="font-semibold text-base-content/80">Tanggal
                                                    pinjam</span><br>
                                                {{ $loan->borrow_date }}
                                            </p>
                                            @if ($loan->status == 'borrowed')
                                                <p>
                                                    <span class="font-semibold text-base-content/80">Tenggat
                                                        pengembalian</span><br>
                                                    <span
                                                        class="font-semibold text-cyan-700">{{ $loan->due_date }}</span>
                                                </p>
                                            @elseif($loan->status == 'returned')
                                                <p>
                                                    <span class="font-semibold text-base-content/80">Tanggal
                                                        dikembalikan</span><br>
                                                    {{ $loan->return_date }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>

                                    @if ($loan->status == 'pending')
                                        <div
                                            class="flex shrink-0 items-center border-t border-base-200 pt-3 sm:border-0 sm:pt-0">
                                            <button type="button"
                                                onclick="document.getElementById('code_modal_{{ $loan->id }}').showModal()"
                                                class="btn btn-sm border-cyan-700 bg-cyan-700 text-white hover:border-cyan-800 hover:bg-cyan-800">
                                                Tampilkan Kode
                                            </button>

                                            <dialog id="code_modal_{{ $loan->id }}" class="modal">
                                                <div class="modal-box max-w-sm text-center">
                                                    <p
                                                        class="text-xs font-bold uppercase tracking-[0.16em] text-cyan-700">
                                                        Verifikasi Peminjaman</p>
                                                    <h3 class="mb-2 mt-1 text-lg font-bold">Kode Anggota</h3>
                                                    <p class="mb-4 text-sm text-base-content/70">
                                                        Tunjukkan kode ini kepada petugas perpustakaan.
                                                    </p>
                                                    <div
                                                        class="mb-4 rounded-xl border-2 border-dashed border-cyan-300 bg-cyan-50 px-6 py-4">
                                                        <span
                                                            class="font-mono text-4xl font-extrabold tracking-widest text-cyan-700">
                                                            {{ $loan->verification_code }}
                                                        </span>
                                                    </div>
                                                    <p class="mb-4 text-xs text-base-content/60">
                                                        Buku: <strong
                                                            class="text-base-content">{{ $loan->book->title }}</strong>
                                                    </p>
                                                    <form method="dialog">
                                                        <button class="btn btn-sm w-full">Tutup</button>
                                                    </form>
                                                </div>
                                                <form method="dialog" class="modal-backdrop"><button>close</button>
                                                </form>
                                            </dialog>
                                        </div>
                                    @endif
                                </div>
                            </article>
                        @empty
                            <div
                                class="rounded-2xl border border-dashed border-base-300 bg-base-100 px-6 py-12 text-center">
                                <div
                                    class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-cyan-50 text-cyan-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2Z" />
                                    </svg>
                                </div>
                                <h3 class="mt-4 font-bold">Belum ada riwayat peminjaman</h3>
                                <p class="mt-1 text-sm text-base-content/60">Buku yang kamu pinjam akan muncul di sini.
                                </p>
                                <a href="{{ route('catalog') }}"
                                    class="btn btn-sm mt-4 border-cyan-700 bg-cyan-700 text-white hover:border-cyan-800 hover:bg-cyan-800">
                                    Jelajahi Katalog
                                </a>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-8 flex justify-center">
                        {{ $loans->links() ?? '' }}
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-layout>
