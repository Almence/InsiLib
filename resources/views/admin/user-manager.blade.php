<x-layout>
    <x-slot:title>
        User Manager
    </x-slot:title>

    <div class="mx-2 md:mx-8 my-8">
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <div
                    class="mb-8 rounded-2xl bg-gradient-to-br from-cyan-700 to-cyan-900 p-6 text-white shadow-lg md:p-8">
                    <div>
                        <p class="mb-2 text-xs font-bold uppercase tracking-[0.2em] text-cyan-100">INSILIB</p>
                        <h1 class="text-3xl font-bold tracking-tight md:text-4xl">Kelola Akun Pengguna</h1>
                        <p class="mt-2 max-w-2xl text-sm leading-relaxed text-cyan-50 md:text-base">
                            Hapus atau edit semua akun pengguna.
                        </p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="table table-zebra">
                        <thead>
                            <tr>
                                <th class="w-fit"></th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
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
                                                <div class="text-sm opacity-50 badge badge-success badge-outline">{{ $user->role }}</div>
                                                @else
                                                <div class="text-sm opacity-50 badge badge-info badge-outline">{{ $user->role }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-info btn-outline" onclick="modal_change_{{ $user->id }}.showModal()">
                                            Edit Akun
                                        </button>
                                        <dialog id="modal_change_{{ $user->id }}" class="modal">
                                            <div class="modal-box">
                                                <label for="name">Ganti Nama</label>
                                                <input type="text" name="name" id="" class="input input-text" value="{{ old($user->name) }}">
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
