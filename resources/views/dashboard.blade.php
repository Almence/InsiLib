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
                            <div class="flex flex-wrap gap-2 items-center">
                                <a href="{{ route('admin.user-manager') }}" class="btn border-cyan-700 hover:bg-cyan-50">
                                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                        stroke="#000000" stroke="currentColor" class="w-6 h-6">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                        </g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path
                                                d="M11 15C10.1183 15 9.28093 14.8098 8.52682 14.4682C8.00429 14.2315 7.74302 14.1131 7.59797 14.0722C7.4472 14.0297 7.35983 14.0143 7.20361 14.0026C7.05331 13.9914 6.94079 14 6.71575 14.0172C6.6237 14.0242 6.5425 14.0341 6.46558 14.048C5.23442 14.2709 4.27087 15.2344 4.04798 16.4656C4 16.7306 4 17.0485 4 17.6841V19.4C4 19.9601 4 20.2401 4.10899 20.454C4.20487 20.6422 4.35785 20.7951 4.54601 20.891C4.75992 21 5.03995 21 5.6 21H8.4M15 7C15 9.20914 13.2091 11 11 11C8.79086 11 7 9.20914 7 7C7 4.79086 8.79086 3 11 3C13.2091 3 15 4.79086 15 7ZM12.5898 21L14.6148 20.595C14.7914 20.5597 14.8797 20.542 14.962 20.5097C15.0351 20.4811 15.1045 20.4439 15.1689 20.399C15.2414 20.3484 15.3051 20.2848 15.4324 20.1574L19.5898 16C20.1421 15.4477 20.1421 14.5523 19.5898 14C19.0376 13.4477 18.1421 13.4477 17.5898 14L13.4324 18.1574C13.3051 18.2848 13.2414 18.3484 13.1908 18.421C13.1459 18.4853 13.1088 18.5548 13.0801 18.6279C13.0478 18.7102 13.0302 18.7985 12.9948 18.975L12.5898 21Z"
                                                stroke="#000000" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </g>
                                    </svg>
                                    <span class="text-cyan-700">Kelola User</span>
                                </a>
                                <div class="dropdown dropdown-hover dropdown-center">
                                    <div tabindex="0" role="button" class="btn m-1">
                                        <svg viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"
                                            class="w-4 h-4">
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
                                        </svg><span class="text-cyan-700">Kelola Buku</span>
                                    </div>
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
                                        <li>
                                            <button
                                                class="btn btn-sm border-white bg-white text-cyan-800 hover:border-cyan-50 hover:ng-cyan-50"
                                                onclick="modal_kategori.showModal()">
                                                Edit Kategori
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if (Session::has('success'))
                        <div class="alert alert-info alert-outline">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                class="h-6 w-6 shrink-0 stroke-current">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ Session::get('success') }}
                        </div>
                    @endif

                    <dialog class="modal" id="modal_kategori">
                        <div class="modal-box max-h-1/2">
                            <h2 class="text-lg font-bold">Kelola Kategori</h2>
                            <ul class="list bg-base-100 rounded-box shadow-md overflow-auto">
                                <li class="p-4 pb-2 text-xs opacity-60 tracking-wide">Daftar Kategori Buku</li>
                                @forelse ($categories as $category)
                                    <li class="list-row">
                                        <div class="badge badge-info badge-outline">{{ $category->name }}</div>
                                        <form action="{{ route('delete.category', $category->id) }}" method="POST"
                                            class="justify-self-end">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-square btn-ghost">
                                                <svg viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg" class="size-6">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <path
                                                            d="M6.99486 7.00636C6.60433 7.39689 6.60433 8.03005 6.99486 8.42058L10.58 12.0057L6.99486 15.5909C6.60433 15.9814 6.60433 16.6146 6.99486 17.0051C7.38538 17.3956 8.01855 17.3956 8.40907 17.0051L11.9942 13.4199L15.5794 17.0051C15.9699 17.3956 16.6031 17.3956 16.9936 17.0051C17.3841 16.6146 17.3841 15.9814 16.9936 15.5909L13.4084 12.0057L16.9936 8.42059C17.3841 8.03007 17.3841 7.3969 16.9936 7.00638C16.603 6.61585 15.9699 6.61585 15.5794 7.00638L11.9942 10.5915L8.40907 7.00636C8.01855 6.61584 7.38538 6.61584 6.99486 7.00636Z"
                                                            fill="currentColor"></path>
                                                    </g>
                                                </svg>
                                            </button>
                                        </form>
                                    </li>
                                @empty
                                    <span class="text-center m-4">Belum ada kategori.</span>
                                @endforelse
                            </ul>
                            <div class="form-control mt-4">
                                <form action="{{ route('admin.add-category') }}" method="POST">
                                    @csrf
                                    
                                    <label for="name" class="label">
                                        <span class="label-text">Tambah Kategori</span>
                                    </label>
                                    <input type="text" name="name" placeholder="Contoh: Novel" class="input input-text w-full">

                                    <button class="btn btn-success btn-outline w-full mt-2">
                                        Tambah Kategori
                                    </button>
                                </form>
                            </div>
                        </div>
                        <form method="dialog" class="modal-backdrop">
                            <button>close</button>
                        </form>
                    </dialog>

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
                                        @if ($loan->book->cover_image)
                                            @if (\Illuminate\Support\Str::startsWith($loan->book->cover_image, ['http://', 'https://']))
                                                <img src="{{ $loan->book->cover_image }}"
                                                    alt="{{ $loan->book->title }}"
                                                    class="h-20 w-14 shrink-0 rounded-lg object-cover shadow-sm" />
                                            @else
                                                <img src="{{ asset('storage/' . $loan->book->cover_image) }}"
                                                    alt="Cover {{ $loan->book->title }}"
                                                    class="h-20 w-14 shrink-0 rounded-lg object-cover shadow-sm">
                                            @endif
                                        @else
                                            <img src="{{ asset('images/NoImage.jpg') }}" alt="Cover tidak tersedia"
                                                class="h-20 w-14 shrink-0 rounded-lg object-cover shadow-sm">
                                        @endif
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
                                        @if ($loan->book->cover_image)
                                            @if (\Illuminate\Support\Str::startsWith($loan->book->cover_image, ['http://', 'https://']))
                                                <img src="{{ $loan->book->cover_image }}"
                                                    alt="{{ $loan->book->title }}"
                                                    class="h-20 w-14 shrink-0 rounded-lg object-cover shadow-sm" />
                                            @else
                                                <img src="{{ asset('storage/' . $loan->book->cover_image) }}"
                                                    alt="Cover {{ $loan->book->title }}"
                                                    class="h-20 w-14 shrink-0 rounded-lg object-cover shadow-sm">
                                            @endif
                                        @else
                                            <img src="{{ asset('images/NoImage.jpg') }}" alt="Cover tidak tersedia"
                                                class="h-20 w-14 shrink-0 rounded-lg object-cover shadow-sm">
                                        @endif
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
                                <div class="lg:flex min-w-0 flex-1 items-start gap-4 grid grid-cols-2">
                                    <div class="w-full lg:h-28 lg:w-20 shrink-0 overflow-hidden rounded-xl bg-base-200 shadow-sm">
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
                                    <div class="lg:hidden"></div>
                                        <div
                                            class="flex shrink-0 items-center border-t border-base-200 pt-3 sm:border-0 sm:pt-0">
                                            <button type="button"
                                                onclick="document.getElementById('code_modal_{{ $loan->id }}').showModal()"
                                                class="btn btn-sm border-cyan-700 bg-cyan-700 text-white hover:border-cyan-800 hover:bg-cyan-800 w-full lg:w-auto">
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
