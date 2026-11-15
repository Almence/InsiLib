<x-layout>
    <x-slot:title>
        User Manager
    </x-slot:title>

    <div class="mx-2 md:mx-8 my-8">
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <div
                    class="mb-8 rounded-2xl bg-gradient-to-br from-cyan-700 to-cyan-900 p-6 text-white shadow-lg md:p-8 lg:grid lg:grid-cols-2">
                    <div>
                        <p class="mb-2 text-xs font-bold uppercase tracking-[0.2em] text-cyan-100">INSILIB</p>
                        <h1 class="text-3xl font-bold tracking-tight md:text-4xl">Kelola Akun Pengguna</h1>
                        <p class="mt-2 max-w-2xl text-sm leading-relaxed text-cyan-50 md:text-base">
                            Hapus atau edit semua akun pengguna.
                        </p>
                    </div>
                    <div class="mt-4 justify-self-end lg:my-auto">
                        <a href="{{ route('add-account') }}">
                            <button class="btn border-cyan-700 text-base-content hover:bg-base-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-6" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2m16 0v-2a4 4 0 0 0-3-3.87M10 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm7-7v6m3-3h-6" />
                                </svg>
                                <span>Tambah Akun</span>
                            </button>
                        </a>
                    </div>
                </div>

                @if (Session::has('success'))
                    <div class="alert alert-info">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            class="h-6 w-6 shrink-0 stroke-current">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ Session::get('success') }}
                    </div>
                @endif

                <div>
                    <table class="table table-zebra bg-base-200 block w-full md:table">
                        <thead class="hidden md:table-header-group">
                            <tr>
                                <th class="w-5"></th>
                                <th>Nama</th>
                                <th>NIS</th>
                                <th>Kelas</th>
                                <th>Email</th>
                                <th>Edit Kredensial</th>
                            </tr>
                        </thead>
                        <tbody class="block md:table-row-group">
                            @forelse($users as $user)
                                <tr
                                    class="mb-4 block rounded-xl border border-base-300 bg-base-100 p-3 shadow-sm last:mb-0 md:mb-0 md:table-row md:rounded-none md:border-0 md:bg-transparent md:p-0 md:shadow-none hover:bg-base-100">
                                    <td class="hidden md:table-cell">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="block border-b border-base-200 py-3 md:table-cell md:border-0 md:py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="avatar">
                                                <div class="mask mask-squircle h-12 w-12">
                                                    @if (auth()->user()->profile_image)
                                                        <img src="{{ asset('storage/' . auth()->user()->profile_image) }}"
                                                            alt="Foto profil">
                                                    @else
                                                        <img src="{{ asset('images/default-avatar.png') }}"
                                                            alt="Default">
                                                    @endif
                                                </div>
                                            </div>
                                            <div>
                                                <div class="font-bold">{{ $user->name }}</div>
                                                @if ($user->role == 'admin')
                                                    <div class="text-sm opacity-50 badge badge-success badge-outline">
                                                        {{ $user->role }}</div>
                                                @else
                                                    <div class="text-sm opacity-50 badge badge-info badge-outline">
                                                        {{ $user->role }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="block border-b border-base-200 py-3 md:table-cell md:border-0 md:py-4">
                                        <div
                                            class="mb-1 text-xs font-semibold uppercase tracking-wide opacity-60 md:hidden">
                                            NIS</div>
                                        {{ $user->nis ?? '-' }}
                                    </td>
                                    <td class="block border-b border-base-200 py-3 md:table-cell md:border-0 md:py-4">
                                        <div
                                            class="mb-1 text-xs font-semibold uppercase tracking-wide opacity-60 md:hidden">
                                            Kelas</div>
                                        {{ $user->kelas }}
                                    </td>
                                    <td class="block border-b border-base-200 py-3 md:table-cell md:border-0 md:py-4">
                                        <div
                                            class="mb-1 text-xs font-semibold uppercase tracking-wide opacity-60 md:hidden">
                                            Email</div>
                                        {{ $user->email }}
                                    </td>
                                    <td class="block py-3 md:table-cell md:py-4">
                                        <div
                                            class="mb-2 text-xs font-semibold uppercase tracking-wide opacity-60 md:hidden">
                                            Edit Kredensial</div>
                                        <div class="grid grid-cols-2 gap-4">
                                            <button class="btn btn-sm btn-info btn-outline h-full"
                                                onclick="modal_change_{{ $user->id }}.showModal()">
                                                Edit Akun
                                            </button>
                                            <button class="btn btn-error btn-outline h-full"
                                                onclick="modal_deletion_{{ $user->id }}.showModal()">
                                                Hapus Akun
                                            </button>
                                        </div>
                                        <dialog id="modal_change_{{ $user->id }}" class="modal">
                                            <div class="modal-box">
                                                <div class="form-control mb-3">
                                                    <h3 class="text-lg font-bold">Edit Pengguna {{ $user->name }}
                                                    </h3>
                                                    <form action="{{ route('update.cred', $user->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <div class="form-control mb-3">
                                                            <label for="nis" class="label"><span
                                                                    class="label-text">Ubah NIS</span></label>
                                                            <input type="text" name="nis"
                                                                value="{{ old('nis', $user->nis) }}"
                                                                class="input input-bordered w-full" maxlength="20">

                                                            <label for="name" class="label"><span
                                                                    class="label-text">Ubah
                                                                    Nama</span></label>
                                                            <input type="text" name="name"
                                                                value="{{ old('name', $user->name) }}"
                                                                class="input input-bordered w-full" required>

                                                            <label for="kelas" class="label"><span
                                                                    class="label-text">Ubah
                                                                    Kelas</span></label>
                                                            <input type="text" name="kelas"
                                                                value="{{ old('kelas', $user->kelas) }}"
                                                                class="input input-bordered w-full" required>

                                                            <label for="password" class="label"><span
                                                                    class="label-text">Ubah
                                                                    Password</span></label>
                                                            <input type="password" name="password" placeholder="******"
                                                                class="input input-bordered w-full">

                                                            <div class="modal-action">
                                                                <button type="submit" class="btn btn-success">Simpan
                                                                    Perubahan</button>
                                                                <button type="button" class="btn"
                                                                    onclick="modal_change_{{ $user->id }}.close()">Batal</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </dialog>

                                        <dialog id="modal_deletion_{{ $user->id }}" class="modal">
                                            <div class="modal-box">
                                                <div class="form-control mb-3 text-center">
                                                    <h3>Yakin Ingin Menghapus Akun</h3>
                                                    <form action="{{ route('delete.account', $user->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-close" type="submit">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </dialog>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layout>
