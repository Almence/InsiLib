<x-layout>
    <x-slot:title>
        Rekap Peminjaman Sisa
    </x-slot:title>

    <div class="my-8 space-y-6">
        <section class="no-print rounded-2xl bg-gradient-to-br from-cyan-700 to-cyan-900 p-6 text-white shadow-lg md:p-8">
            <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="mb-2 text-xs font-bold uppercase tracking-[0.2em] text-cyan-100">Laporan InsiLib</p>
                    <h1 class="text-3xl font-bold tracking-tight md:text-4xl">Rekap Peminjaman Sisa</h1>
                    <p class="mt-2 text-sm text-cyan-50 md:text-base">
                        Daftar buku yang masih dipinjam dan belum dikembalikan.
                    </p>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('dashboard') }}" class="btn border-white bg-transparent text-white hover:bg-cyan-800">
                        Kembali
                    </a>
                    <button type="button" onclick="window.print()"
                        class="btn border-white bg-white text-cyan-800 hover:border-cyan-50 hover:bg-cyan-50">
                        Cetak Laporan
                    </button>
                </div>
            </div>
        </section>

        <section id="report-print-area" class="rounded-2xl border border-base-200 bg-base-100 p-5 shadow-sm md:p-6">
            <div class="print-only mb-5 hidden">
                <h1 class="text-2xl font-bold">InsiLib — Rekap Peminjaman Sisa</h1>
                <p class="mt-1 text-sm">Dicetak pada {{ $reportDate->format('d/m/Y H:i') }}</p>
            </div>

            <div class="no-print mb-5 flex flex-wrap items-end justify-between gap-3">
                <div>
                    <h2 class="text-xl font-bold">Daftar Buku Belum Dikembalikan</h2>
                    <p class="mt-1 text-sm text-base-content/60">Per {{ $reportDate->format('d/m/Y') }}</p>
                </div>
                <span class="badge border-cyan-200 bg-cyan-50 px-3 py-3 font-semibold text-cyan-800">
                    {{ $loans->count() }} peminjaman aktif
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="table w-full">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Peminjam</th>
                            <th>NIS / Kelas</th>
                            <th>Judul Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Batas Pengembalian</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($loans as $loan)
                            @php
                                $isOverdue = \Illuminate\Support\Carbon::parse($loan->due_date)->lt(today());
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $loan->user->name }}</td>
                                <td>
                                    {{ $loan->user->nis ?? '-' }}
                                    <span class="text-base-content/60">/ {{ $loan->user->kelas ?? '-' }}</span>
                                </td>
                                <td>{{ $loan->book->title }}</td>
                                <td>{{ \Illuminate\Support\Carbon::parse($loan->borrow_date)->format('d/m/Y') }}</td>
                                <td>{{ \Illuminate\Support\Carbon::parse($loan->due_date)->format('d/m/Y') }}</td>
                                <td>{{ $isOverdue || $loan->status === 'late' ? 'Terlambat' : 'Dipinjam' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-10 text-center text-base-content/60">
                                    Tidak ada peminjaman aktif saat ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    <style>
        @media print {
            @page {
                size: A4 landscape;
                margin: 12mm;
            }

            .no-print,
            .navbar,
            .drawer-side,
            .fab,
            footer {
                display: none !important;
            }

            body,
            html {
                background: white !important;
                color: black !important;
            }

            .drawer-content,
            .drawer-content > main {
                display: block !important;
                width: 100% !important;
                max-width: none !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            #report-print-area {
                border: 0 !important;
                border-radius: 0 !important;
                box-shadow: none !important;
                padding: 0 !important;
            }

            .print-only {
                display: block !important;
            }

            table {
                width: 100% !important;
                border-collapse: collapse !important;
            }

            th,
            td {
                border: 1px solid #999 !important;
                padding: 6px !important;
                color: black !important;
            }

            tr {
                break-inside: avoid;
            }
        }
    </style>
</x-layout>
