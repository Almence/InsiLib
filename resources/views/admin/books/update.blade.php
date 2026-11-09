<x-layout>
    <x-slot:title>
        Edit Buku: {{ $book->title }}
    </x-slot:title>

    <div class="mx-auto max-w-4xl my-8 px-4">
        <div class="card bg-base-100 shadow-xl border border-base-200">
            <div class="card-body p-6 md:p-8">

                <div class="flex justify-between items-center mb-6 border-b border-base-200 pb-4">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold">Edit Informasi Buku</h1>
                        <p class="text-xs text-base-content/70 mt-1">Perbarui detail buku dan kategorinya di bawah ini.
                        </p>
                    </div>
                    <a href="{{ route('catalog') }}" class="btn btn-ghost btn-sm">Kembali</a>
                </div>

                <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('POST')

                    <!-- Judul Buku -->
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text font-semibold">Judul Buku <span class="text-error">*</span></span>
                        </label>
                        <input type="text" name="title" value="{{ old('title', $book->title) }}"
                            class="input input-bordered w-full @error('title') input-error @enderror" required />
                        @error('title')
                            <span class="text-error text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Grid Penulis, Penerbit, Tahun -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Penulis -->
                        <div class="form-control w-full">
                            <label class="label">
                                <span class="label-text font-semibold">Penulis / Pengarang <span
                                        class="text-error">*</span></span>
                            </label>
                            <input type="text" name="author" value="{{ old('author', $book->author) }}"
                                class="input input-bordered w-full @error('author') input-error @enderror" required />
                            @error('author')
                                <span class="text-error text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Penerbit -->
                        <div class="form-control w-full">
                            <label class="label">
                                <span class="label-text font-semibold">Penerbit <span class="text-error">*</span></span>
                            </label>
                            <input type="text" name="publisher" value="{{ old('publisher', $book->publisher) }}"
                                class="input input-bordered w-full @error('publisher') input-error @enderror"
                                required />
                            @error('publisher')
                                <span class="text-error text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Tahun Terbit -->
                        <div class="form-control w-full">
                            <label class="label">
                                <span class="label-text font-semibold">Tahun Terbit <span
                                        class="text-error">*</span></span>
                            </label>
                            <input type="number" name="year" value="{{ old('year', $book->year) }}" min="1900"
                                max="{{ date('Y') }}"
                                class="input input-bordered w-full @error('year') input-error @enderror" required />
                            @error('year')
                                <span class="text-error text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Grid Stok & URL Cover Image -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Stok -->
                        <div class="form-control w-full md:col-span-1">
                            <label class="label">
                                <span class="label-text font-semibold">Jumlah Stok <span
                                        class="text-error">*</span></span>
                            </label>
                            <input type="number" name="stock" value="{{ old('stock', $book->stock) }}"
                                min="0" class="input input-bordered w-full @error('stock') input-error @enderror"
                                required />
                            @error('stock')
                                <span class="text-error text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- URL Gambar Sampul -->
                        <div class="form-control w-full md:col-span-1">
                            <label class="label">
                                <span class="label-text font-semibold">Sampul Buku (Cover Image)</span>
                            </label>
                            <input type="file" name="cover_image" 
                                value="{{ old('cover_image', $book->cover_image) }}"
                                class="input input-file w-full @error('cover_image') input-error @enderror" 
                                accept=".jpg,.jpeg,.png,.gif"/>
                            @error('cover_image')
                                <span class="text-error text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-control w-full md:col-span-1">
                            <label class="label">
                                <span class="label-text font-semibold">Letak Rak</span>
                            </label>
                            <input type="text" name="place" value="{{ old('place', $book->place) }}"
                                class="input input-bordered w-full @error('cover_image') input-error @enderror" />
                            @error('place')
                                <span class="text-error text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Kategori Buku (Checkboxes) -->
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text font-semibold">Pilih Kategori (Bisa Pilih Banyak) <span
                                    class="text-error">*</span></span>
                        </label>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3 mt-1">
                            @foreach ($categories as $category)
                                <label
                                    class="label cursor-pointer justify-start gap-3 bg-base-300 p-3 rounded-xl border border-base-300 hover:bg-base-200 transition">
                                    <input type="checkbox" name="category_ids[]" value="{{ $category->id }}"
                                        class="w-4 h-4 border border-default-medium rounded-xs bg-neutral-medium focus:ring-2 focus:ring-brand-soft"
                                        {{ (is_array(old('category_ids')) && in_array($category->id, old('category_ids'))) ||
                                        (!old('category_ids') && $book->categories->contains($category->id))
                                            ? 'checked'
                                            : '' }} />
                                    <span class="label-text text-xs font-medium">{{ $category->name }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('category_ids')
                            <span class="text-error text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex justify-end gap-3 pt-4 border-t border-base-200">
                        <a href="{{ route('catalog') }}" class="btn btn-ghost">Batal</a>
                        <button type="submit" class="btn bg-cyan-700 hover:bg-cyan-900 text-white"><svg viewBox="0 0 24 24" fill="none" class="size-6"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M19.186 2.09c.521.25 1.136.612 1.625 1.101.49.49.852 1.104 1.1 1.625.313.654.11 1.408-.401 1.92l-7.214 7.213c-.31.31-.688.541-1.105.675l-4.222 1.353a.75.75 0 0 1-.943-.944l1.353-4.221a2.75 2.75 0 0 1 .674-1.105l7.214-7.214c.512-.512 1.266-.714 1.92-.402zm.211 2.516a3.608 3.608 0 0 0-.828-.586l-6.994 6.994a1.002 1.002 0 0 0-.178.241L9.9 14.102l2.846-1.496c.09-.047.171-.107.242-.178l6.994-6.994a3.61 3.61 0 0 0-.586-.828zM4.999 5.5A.5.5 0 0 1 5.47 5l5.53.005a1 1 0 0 0 0-2L5.5 3A2.5 2.5 0 0 0 3 5.5v12.577c0 .76.082 1.185.319 1.627.224.419.558.754.977.978.442.236.866.318 1.627.318h12.154c.76 0 1.185-.082 1.627-.318.42-.224.754-.559.978-.978.236-.442.318-.866.318-1.627V13a1 1 0 1 0-2 0v5.077c0 .459-.021.571-.082.684a.364.364 0 0 1-.157.157c-.113.06-.225.082-.684.082H5.923c-.459 0-.57-.022-.684-.082a.363.363 0 0 1-.157-.157c-.06-.113-.082-.225-.082-.684V5.5z"
                                        fill="currentColor"></path>
                                </g>
                            </svg> Perbarui Data Buku</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-layout>
