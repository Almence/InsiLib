<x-layout>
    <x-slot:title>
        Cetak QR Code Buku
    </x-slot:title>

    <div class="my-8 space-y-6 md:my-10">
        <section class="no-print overflow-hidden rounded-2xl bg-gradient-to-br from-cyan-700 to-cyan-900 p-6 text-white shadow-lg md:p-8">
            <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="mb-2 text-xs font-bold uppercase tracking-[0.2em] text-cyan-100">Pengelolaan koleksi InsiLib</p>
                    <h1 class="text-3xl font-bold tracking-tight md:text-4xl">Cetak QR Code Buku</h1>
                    <p class="mt-2 max-w-2xl text-sm leading-relaxed text-cyan-50 md:text-base">
                        Pilih buku dan jumlah label yang dibutuhkan, lalu cetak QR untuk akses peminjaman.
                    </p>
                </div>
                <button onclick="window.print()"
                    class="btn border-white bg-white text-cyan-800 hover:border-cyan-50 hover:bg-cyan-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6 9V2h12v7M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2M6 14h12v8H6z" />
                    </svg>
                    Cetak QR
                </button>
            </div>
        </section>

        <section class="no-print rounded-2xl border border-base-200 bg-base-100 p-5 shadow-sm md:p-6">
            <div class="mb-5">
                <p class="text-xs font-bold uppercase tracking-[0.16em] text-cyan-700">Langkah 1</p>
                <h2 class="mt-1 text-xl font-bold">Atur Daftar Cetak</h2>
                <p class="mt-1 text-sm text-base-content/60">Tambahkan satu buku atau masukkan semua buku sekaligus.</p>
            </div>
            <div class="grid grid-cols-1 items-end gap-3 sm:grid-cols-[minmax(0,1fr)_8rem_auto]">
                <div class="space-y-1">
                    <label for="book-select" class="text-xs font-semibold uppercase tracking-wide text-base-content/60">Pilih buku</label>
                    <input id="book-select" class="input input-bordered w-full focus:border-cyan-700"
                        list="list-book-select" placeholder="Cari judul buku">
                    <datalist id="list-book-select">
                        @foreach($books as $book)
                            <option value="{{ $book->title }}"></option>
                        @endforeach
                    </datalist>
                </div>
                <div class="space-y-1">
                    <label for="book-qty" class="text-xs font-semibold uppercase tracking-wide text-base-content/60">Jumlah</label>
                    <input type="number" id="book-qty" value="1" min="1" max="20"
                        class="input input-bordered w-full focus:border-cyan-700" placeholder="Qty">
                </div>
                <button type="button" onclick="addBook()"
                    class="btn border-cyan-700 bg-cyan-700 text-white hover:border-cyan-800 hover:bg-cyan-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" d="M12 5v14m-7-7h14" />
                    </svg>
                    Tambah Buku
                </button>
            </div>
            <div class="mt-5 flex flex-wrap gap-2 border-t border-base-200 pt-4">
                <button type="button" onclick="addAllBooks()"
                    class="btn btn-sm border-cyan-700 text-cyan-700 hover:bg-cyan-50">Tambah Semua Buku</button>
                <button type="button" onclick="clearAllBooks()"
                    class="btn btn-sm border-base-300 text-base-content/70 hover:border-error hover:bg-error/5 hover:text-error">Hapus Semua</button>
            </div>
        </section>

        <section id="qr-print-area" class="rounded-2xl border border-base-200 bg-base-100 p-5 shadow-sm md:p-6">
            <div class="print-only mb-4 hidden">
                <h1 class="text-xl font-bold">InsiLib · Label QR Buku</h1>
            </div>
            <div class="no-print mb-5 flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.16em] text-cyan-700">Langkah 2</p>
                    <h2 class="mt-1 text-xl font-bold">Pratinjau Label QR</h2>
                    <p class="mt-1 text-sm text-base-content/60">Label akan dicetak sesuai susunan di bawah ini.</p>
                </div>
                <span id="total-badge" class="badge border-cyan-200 bg-cyan-50 px-3 py-3 font-semibold text-cyan-800">
                    Total: 0 QR Code
                </span>
            </div>
            <div id="qr-grid-container" class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                <div class="empty-state col-span-full rounded-2xl border-2 border-dashed border-base-300 px-4 py-12 text-center">
                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-cyan-50 text-cyan-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 3h7v7H3zM14 3h7v7h-7zM3 14h7v7H3zM14 14h3v3h-3zM19 14h2M14 19v2M19 19h2v2h-2z" />
                        </svg>
                    </div>
                    <p class="mt-4 font-semibold">Belum ada buku yang dipilih</p>
                    <p class="mt-1 text-sm text-base-content/60">Tambahkan buku melalui panel di atas untuk melihat label QR.</p>
                </div>
            </div>
        </section>
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
                    <div class="empty-state col-span-full rounded-2xl border-2 border-dashed border-base-300 px-4 py-12 text-center">
                        <p class="font-semibold">Belum ada buku yang dipilih</p>
                        <p class="mt-1 text-sm text-base-content/60">Tambahkan buku melalui panel di atas untuk melihat label QR.</p>
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
                        <article class="qr-label relative flex flex-col items-center rounded-xl border border-base-200 bg-base-100 p-4 text-center shadow-sm">
                            <button onclick="removeItem(${index})"
                                class="no-print btn btn-xs btn-circle btn-ghost absolute right-2 top-2 text-error"
                                title="Hapus item ini" aria-label="Hapus ${item.title} dari daftar cetak">✕</button>
                            <h3 class="mb-1 line-clamp-2 min-h-10 w-full px-5 text-sm font-bold leading-snug" title="${item.title}">${item.title}</h3>
                            <div class="qr-slot my-2 flex justify-center" data-book-id="${item.id}">
                            </div>
                            <div class="mt-1 flex w-full items-center justify-between border-t border-base-200 pt-2 text-[10px] text-base-content/60">
                                <span>Kode buku #${item.id}</span>
                                <span class="no-print">${i + 1} dari ${item.qty}</span>
                            </div>
                        </article>
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

    <style>
        .qr-slot svg {
            display: block;
            width: 100px;
            height: 100px;
        }

        @media print {
            @page {
                size: A4;
                margin: 10mm;
            }

            .no-print {
                display: none !important;
            }

            html,
            body {
                background: white !important;
                color: black !important;
            }

            body > .drawer,
            .drawer-content {
                display: block !important;
            }

            .navbar,
            .drawer-side,
            .fab,
            footer {
                display: none !important;
            }

            .drawer-content > main {
                display: block !important;
                width: 100% !important;
                max-width: none !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            #qr-print-area {
                display: block !important;
                margin: 0 !important;
                padding: 0 !important;
                border: 0 !important;
                border-radius: 0 !important;
                box-shadow: none !important;
            }

            .print-only {
                display: block !important;
                margin-bottom: 12px !important;
            }

            .empty-state {
                display: none !important;
            }

            .qr-label {
                break-inside: avoid;
                border: 1px solid #bbb !important;
                border-radius: 4px !important;
                box-shadow: none !important;
                padding: 8px !important;
            }

            .qr-slot svg {
                width: 90px;
                height: 90px;
            }

            #qr-grid-container {
                display: grid !important;
                grid-template-columns: repeat(4, minmax(0, 1fr)) !important;
                gap: 6px !important;
            }
        }
    </style>
</x-layout>