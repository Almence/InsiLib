<x-layout>
    <x-slot:title>
        Cetak QR Code Buku
    </x-slot:title>

    <div class="mx-2 md:mx-8 my-8">
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">

                <!-- Header & Tombol Aksi Utama (Disembunyikan saat diprint) -->
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4 no-print">
                    <div>
                        <h1 class="text-3xl font-bold">Cetak QR Code Buku</h1>
                        <p class="text-base-content/70 text-sm">Pilih buku dan atur jumlah cetak stiker QR code sesuai
                            kebutuhan.</p>
                    </div>
                    <div class="flex gap-2">
                        <button onclick="window.print()" class="btn btn-primary">
                            🖨️ Cetak Halaman
                        </button>
                    </div>
                </div>

                <!-- Panel Kontrol Interaktif (No Print) -->
                <div class="card bg-base-200/60 p-4 mb-8 no-print border border-base-300">
                    <h2 class="font-bold text-base mb-3">Atur Daftar Cetak</h2>

                    <div class="flex flex-col sm:flex-row gap-3 mb-4">
                        <!-- Dropdown Pilih Buku -->
                        <div class="flex-1 relative">
                            <input id="book-select" class="input input-bordered w-full" list="list-book-select"
                                placeholder="Cari Buku">
                            <datalist id="list-book-select">
                                @foreach($books as $book)
                                    <option value="{{ $book->title }}"></option>
                                @endforeach
                            </datalist>

                        </div>

                        <!-- Input Jumlah / Quantity -->
                        <input type="number" id="book-qty" value="1" min="1" max="20" class="input input-bordered w-24"
                            placeholder="Qty" />

                        <!-- Tombol Tambah -->
                        <button type="button" onclick="addBook()" class="btn btn-neutral">➕ Tambah</button>
                    </div>

                    <!-- Tombol Aksi Massal -->
                    <div class="flex flex-wrap gap-2 pt-2 border-t border-base-300">
                        <button type="button" onclick="addAllBooks()" class="btn btn-sm btn-outline btn-primary">Tambah
                            Semua Buku</button>
                        <button type="button" onclick="clearAllBooks()" class="btn btn-sm btn-outline btn-error">Hapus
                            Semua</button>
                    </div>
                </div>

                <!-- PREVIEW GRID QR CODE (Bagian yang akan dicetak) -->
                <div class="mb-4 no-print flex justify-between items-center">
                    <h3 class="font-bold text-lg">Pratinjau Hasil Cetak Stiker</h3>
                    <span id="total-badge" class="badge badge-primary">Total: 0 QR Code</span>
                </div>

                <!-- Tempat Grid QR akan dirender secara dinamis oleh JavaScript -->
                <div id="qr-grid-container" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                    <div
                        class="col-span-full text-center py-12 text-base-content/50 border-2 border-dashed border-base-300 rounded-xl">
                        Belum ada buku yang dipilih. Silakan tambahkan buku di panel atas.
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- SUMBER QR CODE TERSEMBUNYI (Dirender server-side agar bisa dikloning JS) -->
    <div id="qr-sources" class="hidden">
        @foreach($books as $book)
            <div id="qr-svg-{{ $book->id }}">
                {!! QrCode::size(90)->generate(url('/request-borrow/' . $book->id)) !!}
            </div>
        @endforeach
    </div>

    <!-- SCRIPT JAVASCRIPT MURNI (Vanilla JS) -->
    <script>
        // 1. Data seluruh buku dari Laravel diubah jadi JSON
        const allBooks = @json($books);

        // Array state penampung daftar cetak: [{ id, title, qty }]
        let printList = [];

        // 2. Fungsi Tambah Satu Buku dari Dropdown
        function addBook() {
            const inputField = document.getElementById('book-select');
            const qtyInput = document.getElementById('book-qty');

            const typedTitle = inputField.value.trim();
            const qty = parseInt(qtyInput.value) || 1;

            if (!typedTitle) {
                alert('Silakan pilih atau ketik judul buku terlebih dahulu!');
                return;
            }

            // Cari data buku berdasarkan ID
            const bookData = allBooks.find(b => b.title.toLowerCase() === typedTitle.toLowerCase());
            if (!bookData) {
                alert("Buku tidak ditemukan di daftar! Pastikan memilih dari opsi yang tersedia.")
                return
            };

            const bookId = bookData.id;

            // Cek apakah buku sudah ada di daftar cetak
            const existing = printList.find(item => item.id === bookId);
            if (existing) {
                existing.qty += qty; // Jika sudah ada, tambahkan jumlahnya
            } else {
                printList.push({
                    id: bookData.id,
                    title: bookData.title,
                    qty: qty
                });
            }

            renderPreview();

            inputField.value = "";
        }

        // 3. Fungsi Tambah Semua Buku
        function addAllBooks() {
            printList = allBooks.map(book => ({
                id: book.id,
                title: book.title,
                qty: 1
            }));
            renderPreview();
        }

        // 4. Fungsi Hapus Semua
        function clearAllBooks() {
            printList = [];
            renderPreview();
        }

        // 5. Fungsi Hapus Berdasarkan Index di List
        function removeItem(index) {
            printList.splice(index, 1);
            renderPreview();
        }

        // 6. Fungsi Utama: Render Tampilan Grid QR Code Ke Layar
        function renderPreview() {
            const container = document.getElementById('qr-grid-container');
            const totalBadge = document.getElementById('total-badge');

            if (printList.length === 0) {
                container.innerHTML = `
                    <div class="col-span-full text-center py-12 text-base-content/50 border-2 border-dashed border-base-300 rounded-xl">
                        Belum ada buku yang dipilih. Silakan tambahkan buku di panel atas.
                    </div>
                `;
                totalBadge.innerText = 'Total: 0 QR Code';
                return;
            }

            let htmlContent = '';
            let totalQrCount = 0;

            printList.forEach((item, index) => {
                // Perulangan sebanyak quantity (qty) yang diminta
                for (let i = 0; i < item.qty; i++) {
                    totalQrCount++;
                    htmlContent += `
                        <div class="card bg-base-100 border border-base-300 p-3 text-center shadow-sm break-inside-avoid relative group">
                            <!-- Tombol hapus kecil di pojok kartu (hilang saat diprint) -->
                            <button onclick="removeItem(${index})" class="absolute top-1 right-1 btn btn-xs btn-circle btn-ghost text-error no-print" title="Hapus item ini">✕</button>
                            
                            <h3 class="font-bold text-xs mb-1 line-clamp-1" title="${item.title}">${item.title}</h3>
                            
                            <!-- Tempat QR Code disalin dari elemen tersembunyi -->
                            <div class="flex justify-center my-1 qr-slot" data-book-id="${item.id}">
                                <!-- SVG akan dimasukkan lewat JS di bawah -->
                            </div>
                            
                            <div class="flex justify-between items-center text-[10px] text-base-content/60 mt-1 px-1">
                                <span>ID: ${item.id}</span>
                                <span class="no-print">(${i + 1}/${item.qty})</span>
                            </div>
                        </div>
                    `;
                }
            });

            container.innerHTML = htmlContent;
            totalBadge.innerText = `Total: ${totalQrCount} QR Code`;

            // Salin (clone) SVG QR Code dari sumber tersembunyi ke dalam slot grid
            document.querySelectorAll('.qr-slot').forEach(slot => {
                const bookId = slot.getAttribute('data-book-id');
                const sourceSvg = document.getElementById(`qr-svg-${bookId}`);
                if (sourceSvg) {
                    slot.innerHTML = sourceSvg.innerHTML;
                }
            });
        }
    </script>

    <!-- CSS Khusus Mode Cetak (Print) -->
    <style>
        @media print {
            .no-print {
                display: none !important;
            }

            body {
                background: white !important;
            }

            .card {
                box-shadow: none !important;
                border: 1px solid #ddd !important;
            }

            .break-inside-avoid {
                break-inside: avoid;
            }

            #qr-grid-container {
                display: grid !important;
                grid-template-columns: repeat(4, minmax(0, 1fr)) !important;
                gap: 8px !important;
            }
        }
    </style>
</x-layout>