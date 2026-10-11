<x-layout>
    <x-slot:title>
        Index Book
    </x-slot:title>

    <div class="mx-2 md:mx-8 my-8">
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <h1 class="text-3xl font-bold mb-6">Welcome to InsiLib</h1>

                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <h1 class="text-3xl font-bold">Katalog InsiLib</h1>

                    <form method="GET" action="{{ route('dashboard') }}"
                        class="flex flex-col md:flex-row justify-between items-center gap-6 mb-6">

                        <!-- Kolom Search (Menggunakan DaisyUI Join) -->
                        <div class="join w-full md:w-auto gap-1">
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari judul atau pengarang..."
                                class="input input-bordered join-item w-full md:w-80" />
                            <button type="submit"
                                class="btn btn-primary join-item bg-gray-800 text-white px-4">Cari</button>
                            @if(request('search'))
                                <a href="{{ route('dashboard') }}"
                                    class="btn btn-ghost join-item bg-gray-800 text-white px-4">Reset</a>
                            @endif
                        </div>

                        <!-- Dropdown Per Page -->
                        <div class="flex items-center gap-2 self-end md:self-center">
                            <label for="per_page" class="text-sm font-medium">Tampilkan:</label>
                            <select name="per_page" id="per_page" onchange="this.form.submit()"
                                class="select select-bordered select-sm">
                                <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                <option value="20" {{ request('per_page', 20) == 20 ? 'selected' : '' }}>20</option>
                                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                            </select>
                            <span class="text-sm">buku</span>
                        </div>
                    </form>
                </div>

                <div class="divider border-solid md:border-dotted">
                    @if (request('search'))
                        <p class="text-sm text-gray-600">Hasil pencarian untuk: <u><span class="font-semibold">{{ request('search') }}</span></u></p>
                    @endif
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                    @forelse($books as $book)
                        <div class="card bg-base-100 shadow-md border border-base-200">
                            <figure class="px-4 pt-4">
                                <img src="{{ $book->cover_image }}" alt="{{ $book->title }}"
                                    class="w-full h-full object-cover rounded-xl" />
                            </figure>
                            <div class="card-body p-4 flex flex-row justify-between">
                                <div>
                                    <h2 class="card-title text-base font-bold line-clamp-1">{{ $book->title }}</h2>
                                    <p class="text-xs text-base-content/70">{{ $book->author }}</p>
                                    <p class="text-sm text-base-content/60">Stok: {{ $book->stock }}</p>
                                </div>
                                <div class="card-actions justify-end mt-4">
                                    <button type="button"
                                        onclick="document.getElementById('book_modal_{{ $book->id }}').showModal()"
                                        class="btn btn-primary bg-gray-800 text-white px-4 py-1 text-sm focus:outline">
                                        Detail
                                    </button>
                                </div>
                            </div>
                        </div>

                        <dialog id="book_modal_{{ $book->id }}" class="modal">
                            <div class="modal-box max-w-2xl">
                                <h3 class="font-bold text-xl mb-4">{{ $book->title }}</h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-stretch">
                                    <!-- Cover Buku di Modal -->
                                    <div>
                                        <img src="{{ $book->cover_image }}" alt="{{ $book->title }}"
                                            class="w-full h-full object-cover rounded-lg shadow-md" />
                                    </div>

                                    <!-- Informasi Detail Buku -->
                                    <div class="flex flex-col justify-between">

                                        <div class="space-y-3 text-sm">
                                            <div>
                                                <span class="text-base-content/60 block">Penulis</span>
                                                <span class="font-semibold text-base">{{ $book->author }}</span>
                                            </div>
                                            <div>
                                                <span class="text-base-content/60 block">Penerbit</span>
                                                <span class="font-semibold">{{ $book->publisher }}
                                                    ({{ $book->year }})</span>
                                            </div>
                                            <div>
                                                <span class="text-base-content/60 block">Kategori</span>
                                                <!-- Mengambil nama kategori dari relasi database -->
                                                <span
                                                    class="badge badge-outline badge-sm bg-gray-200">{{ $book->category->name ?? 'Umum' }}</span>
                                            </div>
                                            <div>
                                                <span class="text-base-content/60 block">Status Stok</span>
                                                @if($book->stock > 0)
                                                    <span class="badge badge-success text-white">Tersedia ({{ $book->stock }}
                                                        eksemplar)</span>
                                                @else
                                                    <span class="badge badge-error text-white">Stok Habis</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="modal-action mt-6 justify-end">
                                            @if($book->stock > 0)
                                                <!-- Tombol Peminjaman (Persiapan fitur loan berikutnya) -->
                                                <button type="button" class="btn btn-success text-white">Pinjam Buku
                                                    Ini</button>
                                            @endif

                                            <form method="dialog">
                                                <button class="btn">Tutup</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Backdrop: Klik di luar kotak modal untuk menutup -->
                            <form method="dialog" class="modal-backdrop">
                                <button>close</button>
                            </form>
                        </dialog>
                    @empty
                        <div class="col-span-full text-center py-8">
                            <p class="text-base-content/60">No books available.</p>
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