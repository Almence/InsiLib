<x-layout>
    <x-slot:title>
        Profil
    </x-slot:title>

    <div class="mx-auto max-w-5xl md:mx-auto my-8">
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <div class="flex flex-col lg:flex-row px-8">
                    <div class="aura text-cyan-700 cursor-pointer hover:-translate-y-1 transition duration-600" onclick="modal_avatar.showModal()">
                        <div
                            class="card-xl text-base-content h-full w-full bg-base-200 shadow-sm items-center justify-center outline-cyan-800 rounded-xl text-center">
                            <div class="card-body items-center justify-center">
                                @if (auth()->user()->profile_image)
                                    <img src="{{ asset('storage/' . auth()->user()->profile_image) }}" alt="Foto profil"
                                        class="w-20 h-20 rounded-full object-cover">
                                @else
                                    <img src="{{ asset('images/default-avatar.png') }}" alt="Default"
                                        class="w-20 h-20 rounded-full object-cover">
                                @endif

                                <h3 class="card-title">{{ auth()->user()->name }}</h3>
                                <p class="text-xs text-base-content/70">{{ auth()->user()->email }}</p>
                                <div class="badge badge-soft badge-primary">{{ auth()->user()->role }}</div>
                            </div>
                        </div>
                    </div>

                    <dialog id="modal_avatar" class="modal">
                        <div class="modal-box w-auto">
                            <img src="{{ asset('storage/' . auth()->user()->profile_image) }}" alt="Foto profil"
                                class="w-auto h-auto object-cover">
                        </div>
                        <form method="dialog" class="modal-backdrop">
                            <button>close</button>
                        </form>
                    </dialog>

                    <div class="divider divider-horizontal"></div>

                    <div class="card-body justify-center">
                        <ul class="list bg-base-100 rounded-box shadow-md">

                            <li class="p-4 pb-2 text-xl opacity-60 tracking-wide">Edit Profil Anda</li>

                            <div class="lg:flex flex-row w-auto">
                                <button onclick="modal_change_name.showModal()"
                                    class="btn h-auto list-row w-full lg:w-1/2">
                                    <div><img class="size-10 rounded-box" alt="Tailwind CSS list item"
                                            src="https://www.svgrepo.com/show/505801/user-1.svg" /></div>
                                    <div class="text-start">
                                        <div>Ganti Nama & Kelas</div>
                                        <div class="text-xs font-semibold opacity-30">Sesuaikan nama dan kelas tampilan
                                            profil Anda
                                        </div>
                                    </div>
                                </button>
                                <dialog id="modal_change_name" class="modal">
                                    <div class="modal-box">
                                        <h3 class="text-lg font-bold">Ganti Nama & Kelas</h3>
                                        <form action="{{ route('update.nama') }}" method="POST">
                                            @csrf
                                            @method('PATCH')

                                            <div class="form-control mb-3">
                                                <label for="name" class="label"><span class="label-text">Ubah
                                                        Nama</span></label>
                                                <input type="text" name="name"
                                                    value="{{ old('name', auth()->user()->name) }}"
                                                    class="input input-bordered w-full" required>
                                            </div>

                                            <div class="form-control mb-3">
                                                <label for="kelas" class="label"><span class="label-text">Ubah
                                                        Kelas</span></label>
                                                <input type="text" name="kelas"
                                                    value="{{ old('name', auth()->user()->kelas) }}"
                                                    class="input input-bordered w-full" required>
                                            </div>

                                            <div class="modal-action">
                                                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                                                <button type="button" class="btn"
                                                    onclick="modal_change_name.close()">Batal</button>
                                            </div>
                                        </form>
                                    </div>
                                </dialog>

                                <button onclick="modal_change_password.showModal()"
                                    class="btn list-row h-auto w-full lg:w-1/2" disabled="disabled">
                                    <div><img class="size-10 rounded-box" alt="Tailwind CSS list item"
                                            src="https://www.svgrepo.com/show/532324/lock-slash.svg" /></div>
                                    <div class="text-start">
                                        <div>Ganti Kata Sandi</div>
                                        <div class="text-xs font-semibold opacity-30">Perbarui sandi secara berkala demi
                                            keamanan
                                        </div>
                                    </div>
                                </button>
                                <dialog id="modal_change_password" class="modal">
                                    <div class="modal-box">
                                        <h3 class="text-lg font-bold">Ganti Password</h3>
                                        <form action="{{ route('update.password') }}" method="POST">
                                            @csrf
                                            @method('PATCH')

                                            <div class="form-control mb-3">
                                                <label for="password" class="label"><span class="label-text">Ubah
                                                        Password</span></label>
                                                <input type="password" name="password" placeholder="******"
                                                    class="input input-bordered w-full" required>
                                            </div>

                                            <div class="form-control mb-3">
                                                <label for="confirm" class="label"><span class="label-text">Konfirmasi
                                                        Password</span></label>
                                                <input type="password" name="confirm" placeholder="******"
                                                    class="input input-bordered w-full" required>
                                            </div>

                                            <div class="modal-action">
                                                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                                                <button type="button" class="btn"
                                                    onclick="modal_change_password.close()">Batal</button>
                                            </div>
                                        </form>
                                    </div>
                                </dialog>
                            </div>

                            <div role="warning" class="alert alert-warning ">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    class="h-6 w-6 shrink-0 stroke-current">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Hubungi Admin/Petugas perpustakaan untuk mengganti password akun.</span>
                            </div>


                            <form action="{{ route('update.avatar') }}"
                                class="lg:grid lg:grid-cols-2 flex flex-col w-auto" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="list-row w-full">
                                    <div><img class="size-10 rounded-box" alt="Tailwind CSS list item"
                                            src="https://www.svgrepo.com/show/522628/photo-upload.svg" />
                                    </div>
                                    <div>
                                        <div>Ganti Foto Profil</div>
                                        <div class="text-xs font-semibold opacity-30">Unggah foto berformat JPG atau
                                            PNG
                                            terbaru
                                        </div>
                                    </div>
                                </div>

                                <div class="flex flex-col">
                                    <input type="file" name="profile_image" value="{{ old('profile_image') }}"
                                        class="file-input @error('profile_image') input-error @enderror hover:bg-base-300 w-full h-full"
                                        accept=".jpg,.jpeg,.png,.gif" required />
                                    @error('profile_image')
                                        <span class="text-error text-xs m-1">{{ $message }}</span>
                                    @enderror

                                    <button type="submit"
                                        class="btn bg-cyan-700 text-white h-auto w-full lg:w-auto ">Simpan
                                        Gambar</button>
                                </div>
                            </form>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
