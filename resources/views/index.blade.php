<x-layout>
    <x-slot:title>
        Welcome
    </x-slot:title>

    <div class="mx-2 md:mx-8 my-8">
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <h1 class="text-3xl font-bold mb-6">Welcome to InsiLib</h1>
                <form action="POST" class="flex flex-col sm:flex-row gap-4 mb-6 items-center">
                    <label class="form-label">Search Books</label>
                    <input type="text" name="search" placeholder="Enter book title..." class="input input-bordered border-base-300 p-2" />
                </form>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                    @forelse($books as $book)
                        <div class="card bg-base-100 shadow-md border border-base-200">
                            <figure class="px-4 pt-4">
                                <img src="{{ $book->cover_image }}" alt="{{ $book->title }}" class="w-full h-full object-cover rounded-xl" />
                            </figure>
                            <div class="card-body p-4 flex flex-row justify-between">
                                <div>
                                    <h2 class="card-title text-base font-bold line-clamp-1">{{ $book->title }}</h2>
                                    <p class="text-xs text-base-content/70">{{ $book->author }}</p>
                                </div>
                                <div class="card-actions items-center">
                                    <a class="btn text-white btn-primary btn-sm">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <!-- col-span-full agar pesan kosong memenuhi seluruh lebar grid -->
                        <div class="col-span-full text-center py-8">
                            <p class="text-base-content/60">No books available.</p>
                        </div>
                    @endforelse
                </div>

                <p class="mt-8 text-xs text-base-content/60">
                    This is your brand new Laravel application.
                </p>
            </div>
        </div>
    </div>
</x-layout>