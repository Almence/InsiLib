<x-layout>
    <x-slot:title>
        Konfirmasi Peminjaman Buku
    </x-slot:title>

    <div class="mx-auto max-w-2xl my-8 px-4">
        <div class="card bg-base-100 shadow-2xl border border-base-200">
            <div class="card-body p-6 md:p-8">
                
                <!-- Badge Indikator Scan -->
                <div class="flex items-center gap-2 mb-2">
                    <span class="badge badge-primary badge-sm">QR Code Scanned</span>
                    <span class="text-xs text-base-content/60">Perpustakaan InsiLib</span>
                </div>

                <h1 class="text-2xl md:text-3xl font-bold mb-6">Konfirmasi Peminjaman</h1>

                <!-- Kartu Informasi Buku -->
                <div class="flex flex-col sm:flex-row gap-6 bg-base-200/50 p-4 rounded-xl border border-base-200 mb-6">
                    <img src="{{ $book->cover_image }}" alt="{{ $book->title }}" class="w-full sm:w-32 h-48 object-cover rounded-lg shadow-md self-center sm:self-start" />
                    
                    <div class="space-y-2 text-sm flex-1">
                        <h2 class="text-xl font-bold line-clamp-2">{{ $book->title }}</h2>
                        <p class="text-base-content/70"><span class="font-semibold">Penulis:</span> {{ $book->author }}</p>
                        <p class="text-base-content/70"><span class="font-semibold">Penerbit:</span> {{ $book->publisher }} ({{ $book->year }})</p>
                        
                        <div class="pt-2">
                            <span class="text-xs text-base-content/60 block mb-1">Status Ketersediaan:</span>
                            @if($book->stock > 0)
                                <span class="badge badge-success text-white">Stok Tersedia ({{ $book->stock }} eksemplar)</span>
                            @else
                                <span class="badge badge-error text-white">Stok Habis</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Petunjuk Alur Hybrid -->
                <div class="alert alert-info text-xs mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>Setelah mengklik **Konfirmasi Pinjam**, kamu akan mendapatkan **4-digit kode verifikasi**. Tunjukkan kode tersebut kepada petugas perpustakaan untuk mengambil buku fisik.</span>
                </div>

                <!-- Form POST untuk Memproses Peminjaman -->
                <form action="{{ route('borrow.store', $book->id) }}" method="POST" class="flex flex-col sm:flex-row justify-end gap-3">
                    @csrf
                    
                    <a href="{{ url('/dashboard') }}" class="btn btn-ghost order-2 sm:order-1">Batal</a>
                    
                    @if($book->stock > 0)
                        <button type="submit" class="btn btn-primary order-1 sm:order-2">
                            📖 Konfirmasi Pinjam Buku
                        </button>
                    @else
                        <button type="button" disabled class="btn btn-disabled order-1 sm:order-2">
                            Stok Buku Habis
                        </button>
                    @endif
                </form>

            </div>
        </div>
    </div>
</x-layout>