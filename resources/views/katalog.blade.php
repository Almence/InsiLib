@use('Illuminate\Support\Str')
<x-layout>
    <x-slot:title>
        Katalog Buku
    </x-slot:title>

    <div class="my-8 md:my-10">
        <div class="card overflow-hidden border border-base-200 bg-base-100 shadow-xl">
            <div class="card-body gap-6 p-5 md:p-8">
                <div class="rounded-2xl border border-base-200 bg-base-200/50 p-4 md:p-5">
                    <form method="GET" action="{{ route('catalog') }}">

                        <!-- Kolom Search (Menggunakan DaisyUI Join) -->
                        <div class="space-y-2 flex flex-col lg:flex-row w-full justify-between">
                            <div>
                                <p class="text-xs font-bold uppercase tracking-[0.2em] text-cyan-700">Perpustakaan
                                    Digital InsiLib
                                </p>
                                <h1 class="text-3xl font-bold tracking-tight md:text-4xl">Jelajahi Koleksi Buku</h1>
                                <p class="max-w-2xl text-sm leading-relaxed text-base-content/70 md:text-base">
                                    Temukan bacaan berikutnya dengan mencari judul, penulis, atau kategori favoritmu.
                                </p>
                            </div>
                            <div class="space-y-1 lg:col-span-2 lg:items-end">
                                <label for="search"
                                    class="text-xs font-semibold uppercase tracking-wide text-base-content/60">
                                    Cari koleksi
                                </label>
                                <div class="join w-full">
                                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                                        placeholder="Cari judul atau pengarang..."
                                        class="input input-bordered join-item min-w-0 flex-1 bg-base-100 focus:border-cyan-700" />
                                    <button type="submit"
                                        class="btn join-item border-cyan-700 bg-cyan-700 px-4 text-white hover:border-cyan-800 hover:bg-cyan-800">
                                        <svg viewBox="0 0 24 24" fill="none" class="h-4 w-4"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path
                                                    d="M14.9536 14.9458L21 21M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                                                    stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                            </g>
                                        </svg>
                                    </button>
                                    @if (request('search'))
                                        <a href="{{ route('catalog') }}"
                                            class="btn join-item border border-cyan-700 bg-base-100 px-4 text-cyan-700 hover:bg-cyan-50">
                                            <svg fill="#000000" viewBox="0 0 1920 1920"
                                                xmlns="http://www.w3.org/2000/svg" class="w-4 h-4">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path
                                                        d="M960 0v112.941c467.125 0 847.059 379.934 847.059 847.059 0 467.125-379.934 847.059-847.059 847.059-467.125 0-847.059-379.934-847.059-847.059 0-267.106 126.607-515.915 338.824-675.727v393.374h112.94V112.941H0v112.941h342.89C127.058 407.38 0 674.711 0 960c0 529.355 430.645 960 960 960s960-430.645 960-960S1489.355 0 960 0"
                                                        fill-rule="evenodd"></path>
                                                </g>
                                            </svg>
                                        </a>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="grid grid-cols-1 items-end gap-4 sm:grid-cols-2 lg:grid-cols-4 lg:mt-4">

                            <div class="space-y-1">
                                <label for="sort_by"
                                    class="text-xs font-semibold uppercase tracking-wide text-base-content/60">Urutkan</label>
                                <select name="sort_by" id="sort_by" onchange="this.form.submit()"
                                    class="select select-bordered select-sm w-full bg-base-100 focus:border-cyan-700">
                                    <option value="title"
                                        {{ request('sort_by', 'title') == 'title' ? 'selected' : '' }}>
                                        Judul
                                    </option>
                                    <option value="author" {{ request('sort_by') == 'author' ? 'selected' : '' }}>
                                        Pengarang
                                    </option>
                                    <option value="year" {{ request('sort_by') == 'year' ? 'selected' : '' }}>Tahun
                                        Terbit
                                    </option>
                                    <option value="stock" {{ request('sort_by') == 'stock' ? 'selected' : '' }}>Stok
                                    </option>
                                    <option value="created_at"
                                        {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>
                                        Tanggal ditambahkan
                                    </option>
                                </select>
                            </div>

                            <div class="space-y-1">
                                <label for="sortDirection"
                                    class="text-xs font-semibold uppercase tracking-wide text-base-content/60">Arah
                                    Urutan</label>
                                <select name="sortDirection" id="sortDirection" onchange="this.form.submit()"
                                    class="select select-bordered select-sm w-full bg-base-100 focus:border-cyan-700">
                                    <option value="asc"
                                        {{ request('sortDirection', 'asc') == 'asc' ? 'selected' : '' }}>
                                        Menaik
                                    </option>
                                    <option value="desc" {{ request('sortDirection') == 'desc' ? 'selected' : '' }}>
                                        Menurun
                                    </option>
                                </select>
                            </div>

                            <div class="space-y-1">
                                <label for="filter_by"
                                    class="text-xs font-semibold uppercase tracking-wide text-base-content/60">Kategori</label>
                                <select name="filter_by" id="filter_by" onchange="this.form.submit()"
                                    class="select select-bordered select-sm w-full bg-base-100 focus:border-cyan-700">
                                    <option value="all"
                                        {{ request('filter_by', 'all') == 'all' ? 'selected' : '' }}>
                                        Semua
                                    </option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ request('filter_by') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Dropdown Per Page -->
                            <div class="space-y-1">
                                <label for="per_page"
                                    class="text-xs font-semibold uppercase tracking-wide text-base-content/60">Buku per
                                    halaman</label>
                                <select name="per_page" id="per_page" onchange="this.form.submit()"
                                    class="select select-bordered select-sm w-full bg-base-100 focus:border-cyan-700">
                                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10 buku
                                    </option>
                                    <option value="20" {{ request('per_page', 20) == 20 ? 'selected' : '' }}>20
                                        buku
                                    </option>
                                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 buku
                                    </option>
                                    <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100 buku
                                    </option>
                                </select>
                            </div>
                        </div>

                    </form>
                    <div class="flex w-full flex-col lg:flex-row mt-2 gap-4">
                        <div role="alert" class="alert alert-info lg:w-1/2 alert-outline">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                class="h-6 w-6 shrink-0 stroke-current">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Jika ingin meminjam buku, datangi perpustakaan dan scan QR Code yang tertera pada
                                buku. Jika belum ada QR Code, hubungi pihak Petugas/Admin.</span>
                        </div>
                        <div role="alert" class="alert alert-warning lg:w-1/2 alert-outline">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                class="h-6 w-6 shrink-0 stroke-current">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Klik pada card buku untuk membuka detail buku.</span>
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

                <div class="divider my-0 border-solid md:border-dotted">
                    @if (request('search'))
                        <p class="text-sm text-base-content/70">Hasil pencarian untuk:
                            <span class="font-semibold text-cyan-700">{{ request('search') }}</span>
                        </p>
                    @endif
                </div>

                <div class="grid grid-cols-2 gap-5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    @forelse($books as $book)

                        <div
                            class="card cursor-pointer border border-base-200 bg-base-100 shadow-sm transition duration-200 hover:-translate-y-1 hover:border-cyan-700/30 hover:shadow-lg">
                            @if (Auth::user()->role === 'admin')
                            <button class="btn btn-sm btn-circle btn-error absolute -right-4 -top-4 z-100"
                                onclick="modal_deletion_{{ $book->id }}.showModal()"><svg viewBox="0 0 24 24"
                                    fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M3 3L21 21M18 6L17.6 12M17.2498 17.2527L17.1991 18.0129C17.129 19.065 17.0939 19.5911 16.8667 19.99C16.6666 20.3412 16.3648 20.6235 16.0011 20.7998C15.588 21 15.0607 21 14.0062 21H9.99377C8.93927 21 8.41202 21 7.99889 20.7998C7.63517 20.6235 7.33339 20.3412 7.13332 19.99C6.90607 19.5911 6.871 19.065 6.80086 18.0129L6 6H4M16 6L15.4559 4.36754C15.1837 3.55086 14.4194 3 13.5585 3H10.4416C9.94243 3 9.47576 3.18519 9.11865 3.5M11.6133 6H20M14 14V17M10 10V17"
                                            stroke="#000000" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </g>
                                </svg>
                            </button>
                            <dialog class="modal" id="modal_deletion_{{ $book->id }}">
                                <div class="modal-box">
                                    <h3 class="text-center">Apakah anda yakin ingin menghapus buku ini?</h3>
                                    <div class="flex lg:flex-row mt-3 gap-2">
                                        <form action="{{ route('delete.book', $book->id) }}" class="grow"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-error btn-outline w-full">
                                                Hapus
                                            </button>
                                        </form>
                                        <form method="dialog" class="grow">
                                            <button class="btn btn-ghost w-full">Batal</button>
                                        </form>
                                    </div>
                                </div>
                                <form method="dialog" class="modal-backdrop">
                                    <button>close</button>
                                </form>
                            </dialog>
                            @endif
                            <div onclick="document.getElementById('book_modal_{{ $book->id }}').showModal()">
                                <figure class="aspect-[3/4] overflow-hidden bg-base-200 px-4 pt-4">
                                    @if ($book->cover_image)
                                        @if (\Illuminate\Support\Str::startsWith($book->cover_image, ['http://', 'https://']))
                                            <img src="{{ $book->cover_image }}" alt="{{ $book->title }}"
                                                class="h-full w-full rounded-xl object-cover" />
                                        @else
                                            <img src="{{ asset('storage/' . $book->cover_image) }}"
                                                alt="Cover {{ $book->title }}"
                                                class="h-full w-full rounded-xl object-cover">
                                        @endif
                                    @else
                                        <img src="{{ asset('images/NoImage.jpg') }}" alt="Cover tidak tersedia"
                                            class="h-full w-full rounded-xl object-cover">
                                    @endif
                                </figure>
                                <div class="card-body flex flex-col lg:flex-row justify-between gap-3 p-4">
                                    <div>
                                        <h2 class="card-title text-base font-bold leading-snug text-sm">
                                            {{ $book->title }}</h2>
                                        <p class="text-xs text-base-content/70">{{ $book->author }}</p>
                                        <p class="mt-2 text-xs text-base-content/60">Stok: {{ $book->stock }}</p>
                                    </div>
                                    <div class="card-actions flex flex-row lg:flex-col lg:justify-end lg:items-end">
                                        @if (Auth::user()->role === 'admin')
                                            <a href="{{ route('books.edit', $book->id) }}"
                                                class="btn border-cyan-700 bg-cyan-700 px-4 py-1 text-sm text-white hover:border-cyan-800 hover:bg-cyan-800">
                                                Edit
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <dialog id="book_modal_{{ $book->id }}" class="modal">
                                <div
                                    class="modal-box max-h-[calc(100dvh-1rem)] w-[calc(100%-1rem)] max-w-2xl overflow-y-auto overscroll-contain p-4 sm:max-h-[calc(100dvh-2rem)] sm:w-[calc(100%-2rem)] sm:p-6">
                                    <div class="flex items-start justify-between gap-3">
                                        <h3 class="mb-4 min-w-0 flex-1 break-words text-lg font-bold sm:text-xl">
                                            {{ $book->title }}
                                        </h3>

                                        <div class="card-actions justify-end">
                                            <form method="dialog">
                                                <button class="btn btn-square btn-sm shrink-0">
                                                    <svg aria-label="Close" xmlns="http://www.w3.org/2000/svg"
                                                        class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 items-start gap-4 md:grid-cols-2 md:gap-6">
                                        <!-- Cover Buku di Modal -->
                                        @if ($book->cover_image)
                                            @if (Str::startsWith($book->cover_image, ['http://', 'https://']))
                                                <img src="{{ $book->cover_image }}" alt="{{ $book->title }}"
                                                    class="h-[30vh] min-h-32 max-h-56 w-full rounded-lg object-contain shadow-md md:aspect-[3/4] md:h-auto md:max-h-96 md:object-cover" />
                                            @else
                                                <img src="{{ asset('storage/' . $book->cover_image) }}"
                                                    alt="{{ $book->title }}"
                                                    class="h-[30vh] min-h-32 max-h-56 w-full rounded-lg object-contain shadow-md md:aspect-[3/4] md:h-auto md:max-h-96 md:object-cover" />
                                            @endif
                                        @else
                                            <img src="{{ asset('images/NoImage.jpg') }}" alt="Cover tidak tersedia"
                                                class="h-[30vh] min-h-32 max-h-56 w-full rounded-lg object-contain shadow-md md:aspect-[3/4] md:h-auto md:max-h-96 md:object-cover" />
                                        @endif

                                        <!-- Informasi Detail Buku -->
                                        <div class="flex min-w-0 flex-col justify-between">

                                            <div class="space-y-3 text-sm">
                                                <div>
                                                    <span class="text-base-content/60 block">Penulis</span>
                                                    <span class="font-semibold text-base">{{ $book->author }}</span>
                                                </div>
                                                <div class="divider"></div>
                                                <div>
                                                    <span class="text-base-content/60 block">Penerbit</span>
                                                    <span class="font-semibold">{{ $book->publisher }}
                                                        ({{ $book->year }})
                                                    </span>
                                                </div>
                                                <div class="divider"></div>
                                                <div>
                                                    <span class="text-base-content/60 block">Kategori</span>
                                                    <!-- Mengambil nama kategori dari relasi database -->
                                                    @forelse ($book->categories as $category)
                                                        <span
                                                            class="badge badge-sm border-cyan-200 bg-cyan-50 text-cyan-800">{{ $category->name ?? 'Umum' }}</span>
                                                    @empty
                                                        <span class="text-xs text-base-content/50 italic">Tanpa
                                                            Kategori</span>
                                                    @endforelse
                                                </div>
                                                <div class="divider"></div>
                                                <div>
                                                    <span class="text-base-content/60 block">Status Stok</span>
                                                    @if ($book->stock > 0)
                                                        <span class="badge badge-success text-white">Tersedia
                                                            ({{ $book->stock }}
                                                            eksemplar)</span>
                                                    @else
                                                        <span class="badge badge-error text-white">Stok Habis</span>
                                                    @endif
                                                </div>
                                                <div class="divider"></div>
                                                <div>
                                                    <span class="text-base-content/60 block">Letak Rak</span>
                                                    <span class="font-semibold text-base">{{ $book->place }}</span>
                                                </div>
                                                <div class="divider"></div>
                                            </div>

                                            <div class="modal-action flex flex-col items-end mt-6 justify-end">
                                                @if ($book->stock > 0)
                                                    <div class="alert alert-success alert-dash w-full">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="h-6 w-6 shrink-0 stroke-current" fill="none"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        <span>Stok buku tersedia. Datangi Perpustakaan untuk
                                                            meminjam.</span>
                                                    </div>
                                                @else
                                                    <div class="alert alert-error alert-dash w-full">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="h-6 w-6 shrink-0 stroke-current" fill="none"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        <span>Maaf, stok buku habis. Silakan datang ke perpustakaan saat
                                                            stok
                                                            tersedia.</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Backdrop: Klik di luar kotak modal untuk menutup -->
                                <form method="dialog" class="modal-backdrop">
                                    <button>close</button>
                                </form>
                            </dialog>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-8">
                            <p class="text-base-content/60">Belum ada buku yang tersedia.</p>
                        </div>
                    @endforelse
                </div>

                <div class="mt-8">
                    {{ $books->links() }}
                </div>

            </div>
        </div>
    </div>
</x-layout>
