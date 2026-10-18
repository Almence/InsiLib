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
                        <p class="text-xs text-base-content/70 mt-1">Perbarui detail buku dan kategorinya di bawah ini.</p>
                    </div>
                    <a href="{{ route('dashboard') }}" class="btn btn-ghost btn-sm">← Kembali</a>
                </div>

                <form action="{{ route('books.update', $book->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('POST')

                    <!-- Judul Buku -->
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text font-semibold">Judul Buku <span class="text-error">*</span></span>
                        </label>
                        <input type="text" name="title" value="{{ old('title', $book->title) }}" class="input input-bordered w-full @error('title') input-error @enderror" required />
                        @error('title')
                            <span class="text-error text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Grid Penulis, Penerbit, Tahun -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Penulis -->
                        <div class="form-control w-full">
                            <label class="label">
                                <span class="label-text font-semibold">Penulis / Pengarang <span class="text-error">*</span></span>
                            </label>
                            <input type="text" name="author" value="{{ old('author', $book->author) }}" class="input input-bordered w-full @error('author') input-error @enderror" required />
                            @error('author')
                                <span class="text-error text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Penerbit -->
                        <div class="form-control w-full">
                            <label class="label">
                                <span class="label-text font-semibold">Penerbit <span class="text-error">*</span></span>
                            </label>
                            <input type="text" name="publisher" value="{{ old('publisher', $book->publisher) }}" class="input input-bordered w-full @error('publisher') input-error @enderror" required />
                            @error('publisher')
                                <span class="text-error text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Tahun Terbit -->
                        <div class="form-control w-full">
                            <label class="label">
                                <span class="label-text font-semibold">Tahun Terbit <span class="text-error">*</span></span>
                            </label>
                            <input type="number" name="year" value="{{ old('year', $book->year) }}" min="1900" max="{{ date('Y') }}" class="input input-bordered w-full @error('year') input-error @enderror" required />
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
                                <span class="label-text font-semibold">Jumlah Stok <span class="text-error">*</span></span>
                            </label>
                            <input type="number" name="stock" value="{{ old('stock', $book->stock) }}" min="0" class="input input-bordered w-full @error('stock') input-error @enderror" required />
                            @error('stock')
                                <span class="text-error text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- URL Gambar Sampul -->
                        <div class="form-control w-full md:col-span-2">
                            <label class="label">
                                <span class="label-text font-semibold">URL Sampul Buku (Cover Image)</span>
                            </label>
                            <input type="url" name="cover_image" value="{{ old('cover_image', $book->cover_image) }}" placeholder="https://picsum.photos/400/600" class="input input-bordered w-full @error('cover_image') input-error @enderror" />
                            @error('cover_image')
                                <span class="text-error text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Kategori Buku (Checkboxes) -->
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text font-semibold">Pilih Kategori (Bisa Pilih Banyak) <span class="text-error">*</span></span>
                        </label>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3 mt-1">
                            @foreach($categories as $category)
                                <label class="label cursor-pointer justify-start gap-3 bg-base-200/50 p-3 rounded-xl border border-base-300 hover:bg-base-200 transition">
                                    <input type="checkbox" name="category_ids[]" value="{{ $category->id }}" 
                                        class="checkbox checkbox-primary checkbox-sm"
                                        {{ 
                                            (is_array(old('category_ids')) && in_array($category->id, old('category_ids'))) || 
                                            (!old('category_ids') && $book->categories->contains($category->id)) 
                                            ? 'checked' : '' 
                                        }}
                                    />
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
                        <a href="{{ route('dashboard') }}" class="btn btn-ghost">Batal</a>
                        <button type="submit" class="btn btn-primary">✏️ Perbarui Data Buku</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-layout>