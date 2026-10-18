<x-layout>
    <x-slot:title>
        Dashboard InsiLib
    </x-slot:title>

    <div class="mx-2 md:mx-8 my-8">
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                
                <!-- TAMPILAN KHUSUS ADMIN -->
                @if(auth()->user()->role === 'admin')
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h1 class="text-3xl font-bold">Dashboard Admin</h1>
                            <p class="text-base-content/70 text-sm">Kelola verifikasi peminjaman dan pengembalian buku fisik perpustakaan.</p>
                        </div>
                        <a href="{{ route('admin.print-qr') }}" class="btn text-white btn-neutral btn-sm">🖨️ Cetak QR Code Buku</a>
                        <a href="{{ route('books.create') }}" class="btn text-white btn-neutral btn-sm">Tambah Buku</a>
                        <a href="{{ route('catalog') }}" class="btn text-white btn-neutral btn-sm">Edit Buku</a>
                    </div>

                    <!-- BAGIAN 1: VERIFIKASI PEMINJAMAN PENDING -->
                    <div class="mb-8">
                        <h2 class="text-xl font-semibold mb-4 text-warning">⏳ Menunggu Verifikasi Peminjaman (Pending)</h2>
                        <div class="space-y-3">
                            @forelse($pendingLoans ?? [] as $loan)
                                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between p-4 bg-warning/10 rounded-box border border-warning/20 gap-4">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ $loan->book->cover_image }}" alt="" class="w-12 h-16 object-cover rounded shadow-xs" />
                                        <div>
                                            <h3 class="font-bold text-sm">{{ $loan->book->title }}</h3>
                                            <p class="text-xs text-base-content/70">Peminjam: <strong class="text-base-content">{{ $loan->user->name }}</strong> ({{ $loan->user->email }})</p>
                                            <p class="text-xs text-warning font-semibold mt-1">Kode 4-Digit Member: [ {{ $loan->verification_code }} ]</p>
                                        </div>
                                    </div>

                                    <!-- Form Input Kode 4 Digit untuk Approve -->
                                    <form action="{{ route('admin.loans.approve', $loan->id) }}" method="POST" class="flex items-center gap-2 w-full sm:w-auto">
                                        @csrf
                                        <input type="text" name="verification_code" maxlength="4" placeholder="Masukkan 4 digit" class="input input-bordered input-sm w-32 font-mono text-center" required />
                                        <button type="submit" class="btn btn-sm btn-success text-white">Approve</button>
                                    </form>
                                </div>
                            @empty
                                <p class="text-xs text-base-content/50 italic">Tidak ada antrean peminjaman baru saat ini.</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- BAGIAN 2: DAFTAR Buku DIPINJAM (UNTUK DI-RETURN) -->
                    <div>
                        <h2 class="text-xl font-semibold mb-4 text-info">📖 Buku Sedang Dipinjam (Menunggu Pengembalian)</h2>
                        <div class="space-y-3">
                            @forelse($borrowedLoans ?? [] as $loan)
                                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between p-4 bg-base-200/50 rounded-box border border-base-200 gap-4">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ $loan->book->cover_image }}" alt="" class="w-12 h-16 object-cover rounded shadow-xs" />
                                        <div>
                                            <h3 class="font-bold text-sm">{{ $loan->book->title }}</h3>
                                            <p class="text-xs text-base-content/70">Peminjam: <strong class="text-base-content">{{ $loan->user->name }}</strong></p>
                                            <p class="text-xs text-base-content/60">Tenggat: <span class="text-error font-medium">{{ $loan->due_date }}</span></p>
                                        </div>
                                    </div>

                                    <!-- Tombol Terima Pengembalian -->
                                    <form action="{{ route('admin.loans.return', $loan->id) }}" method="POST" onsubmit="return confirm('Terima pengembalian buku ini?')">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-primary">📥 Terima Pengembalian</button>
                                    </form>
                                </div>
                            @empty
                                <p class="text-xs text-base-content/50 italic">Tidak ada buku yang sedang dipinjam saat ini.</p>
                            @endforelse
                        </div>
                    </div>

                <!-- TAMPILAN KHUSUS MEMBER / USER BIASA -->
                @else
                    <h1 class="text-3xl font-bold mb-2">Dashboard Saya</h1>
                    <p class="text-base-content/70 mb-6">Halo, {{ auth()->user()->name }}! Berikut adalah riwayat dan status peminjaman buku kamu.</p>

                    <div class="space-y-4">
                        @forelse($loans ?? [] as $loan)
                            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between p-4 bg-base-200/50 rounded-box border border-base-200 gap-4">
                                <div class="flex items-center gap-4">
                                    <img src="{{ $loan->book->cover_image }}" alt="" class="w-16 h-24 object-cover rounded-md shadow-sm" />
                                    <div>
                                        <h2 class="font-bold text-base line-clamp-1">{{ $loan->book->title }}</h2>
                                        <p class="text-xs text-base-content/70 mb-2">Penulis: {{ $loan->book->author }}</p>
                                        
                                        @if($loan->status == 'pending')
                                            <span class="badge badge-warning badge-sm">Menunggu Verifikasi</span>
                                        @elseif($loan->status == 'borrowed')
                                            <span class="badge badge-info badge-sm text-white">Sedang Dipinjam</span>
                                        @elseif($loan->status == 'returned')
                                            <span class="badge badge-success badge-sm text-white">Dikembalikan</span>
                                        @else
                                            <span class="badge badge-error badge-sm text-white">Terlambat / Ditolak</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="flex flex-col sm:items-end text-xs text-base-content/70 space-y-2 w-full sm:w-auto border-t sm:border-t-0 pt-3 sm:pt-0 border-base-300">
                                    <div><span class="font-medium">Tgl Request:</span> {{ $loan->borrow_date }}</div>
                                    
                                    @if($loan->status == 'pending')
                                        <button type="button" onclick="document.getElementById('code_modal_{{ $loan->id }}').showModal()" class="btn btn-warning btn-xs text-white mt-1">
                                            🔑 Tampilkan Kode Verifikasi
                                        </button>

                                        <dialog id="code_modal_{{ $loan->id }}" class="modal">
                                            <div class="modal-box text-center max-w-sm">
                                                <h3 class="font-bold text-lg mb-2">Kode Verifikasi Peminjaman</h3>
                                                <p class="text-xs text-base-content/70 mb-4">Tunjukkan kode 4 digit ini kepada petugas perpustakaan.</p>
                                                
                                                <div class="bg-base-200 py-4 px-6 rounded-xl border-2 border-dashed border-primary mb-4">
                                                    <span class="font-mono text-4xl font-extrabold tracking-widest text-primary">
                                                        {{ $loan->verification_code }}
                                                    </span>
                                                </div>
                                                <p class="text-[11px] text-base-content/50 mb-4">Buku: <strong class="text-base-content">{{ $loan->book->title }}</strong></p>

                                                <form method="dialog"><button class="btn btn-sm btn-block">Tutup</button></form>
                                            </div>
                                            <form method="dialog" class="modal-backdrop"><button>close</button></form>
                                        </dialog>
                                    @elseif($loan->status == 'borrowed')
                                        <div><span class="font-medium">Tenggat:</span> <strong class="text-warning">{{ $loan->due_date }}</strong></div>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-12">
                                <p class="text-base-content/60 mb-2">Kamu belum memiliki riwayat peminjaman buku.</p>
                                <a href="{{ url('/') }}" class="btn btn-primary btn-sm">Jelajahi Katalog Buku</a>
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