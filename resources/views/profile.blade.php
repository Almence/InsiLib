<x-layout>
    <x-slot:title>
        Profil
    </x-slot:title>

    <div class="mx-auto max-w-5xl md:mx-auto my-8">
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <div class="flex flex-col lg:flex-row px-8">
                    <div class="text-cyan-700 cursor-pointer hover:-translate-y-1 transition duration-600"
                        onclick="modal_avatar.showModal()">
                        <div
                            class="card-xl text-base-content h-full w-full bg-base-200 shadow-sm items-center justify-center outline-cyan-800 rounded-xl text-center">
                            <div class="card-body items-center justify-center">
                                @if (auth()->user()->profile_image)
                                    <img src="{{ asset('storage/' . auth()->user()->profile_image) }}" alt="Foto profil"
                                        class="w-20 h-20 rounded-full object-cover aura">
                                @else
                                    <img src="{{ asset('images/default-avatar.png') }}" alt="Default"
                                        class="w-20 h-20 rounded-full object-cover aura">
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

                    <div class="lg:card-body justify-center">
                        <ul class="list bg-base-100 rounded-box shadow-md">

                            <li class="p-4 pb-2 text-xl opacity-60 tracking-wide">Edit Profil Anda</li>

                            <div class="lg:flex flex-row w-auto">
                                <button onclick="modal_change_name.showModal()"
                                    class="btn h-auto list-row w-full lg:w-1/2">
                                    <div>
                                        <svg fill="#000000" viewBox="0 0 32 32" id="icon" class="size-10"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <defs>
                                                    <style>
                                                        .cls-1 {
                                                            fill: none;
                                                        }
                                                    </style>
                                                </defs>
                                                <path
                                                    d="M7,12H4a2.0023,2.0023,0,0,1-2-2V6A2.0023,2.0023,0,0,1,4,4H7V6H4v4H7Z">
                                                </path>
                                                <rect x="9" y="10" width="6" height="2"></rect>
                                                <rect x="17" y="10" width="6" height="2"></rect>
                                                <path
                                                    d="M28,12H25V10h3V6H25V4h3a2.0023,2.0023,0,0,1,2,2v4A2.0023,2.0023,0,0,1,28,12Z">
                                                </path>
                                                <rect x="17" y="4" width="6" height="2"></rect>
                                                <rect x="9" y="4" width="6" height="2"></rect>
                                                <path
                                                    d="M28,28H4a2.0023,2.0023,0,0,1-2-2V22a2.0023,2.0023,0,0,1,2-2H28a2.0023,2.0023,0,0,1,2,2v4A2.0023,2.0023,0,0,1,28,28ZM4,22v4H28V22Z">
                                                </path>
                                                <rect x="2" y="15" width="28" height="2"></rect>
                                                <rect id="_Transparent_Rectangle_"
                                                    data-name="&lt;Transparent Rectangle&gt;" class="cls-1"
                                                    width="32" height="32"></rect>
                                            </g>
                                        </svg>
                                    </div>
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
                                                    class="input input-bordered w-full">
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
                                    <div>
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                            class="size-10">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path
                                                    d="M3 3L21 21M17 10V8C17 5.23858 14.7614 3 12 3C11.0283 3 10.1213 3.27719 9.35386 3.75681M7.08383 7.08338C7.02878 7.38053 7 7.6869 7 8V10.0288M19.5614 19.5618C19.273 20.0348 18.8583 20.4201 18.362 20.673C17.7202 21 16.8802 21 15.2 21H8.8C7.11984 21 6.27976 21 5.63803 20.673C5.07354 20.3854 4.6146 19.9265 4.32698 19.362C4 18.7202 4 17.8802 4 16.2V14.8C4 13.1198 4 12.2798 4.32698 11.638C4.6146 11.0735 5.07354 10.6146 5.63803 10.327C5.99429 10.1455 6.41168 10.0647 7 10.0288M19.9998 14.4023C19.9978 12.9831 19.9731 12.227 19.673 11.638C19.3854 11.0735 18.9265 10.6146 18.362 10.327C17.773 10.0269 17.0169 10.0022 15.5977 10.0002M10 10H8.8C8.05259 10 7.47142 10 7 10.0288"
                                                    stroke="#000000" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="text-start">
                                        <div>Ganti Kata Sandi</div>
                                        <div class="text-xs font-semibold opacity-30">Perbarui sandi secara berkala
                                            demi
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
                                                <label for="confirm" class="label"><span
                                                        class="label-text">Konfirmasi
                                                        Password</span></label>
                                                <input type="password" name="confirm" placeholder="******"
                                                    class="input input-bordered w-full" required>
                                            </div>

                                            <div class="modal-action">
                                                <button type="submit" class="btn btn-success">Simpan
                                                    Perubahan</button>
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
                                    <div>
                                        <svg fill="#000000" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                            class="size-10">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path
                                                    d="M19,13a1,1,0,0,0-1,1v.38L16.52,12.9a2.79,2.79,0,0,0-3.93,0l-.7.7L9.41,11.12a2.85,2.85,0,0,0-3.93,0L4,12.6V7A1,1,0,0,1,5,6h7a1,1,0,0,0,0-2H5A3,3,0,0,0,2,7V19a3,3,0,0,0,3,3H17a3,3,0,0,0,3-3V14A1,1,0,0,0,19,13ZM5,20a1,1,0,0,1-1-1V15.43l2.9-2.9a.79.79,0,0,1,1.09,0l3.17,3.17,0,0L15.46,20Zm13-1a.89.89,0,0,1-.18.53L13.31,15l.7-.7a.77.77,0,0,1,1.1,0L18,17.21ZM22.71,4.29l-3-3a1,1,0,0,0-.33-.21,1,1,0,0,0-.76,0,1,1,0,0,0-.33.21l-3,3a1,1,0,0,0,1.42,1.42L18,4.41V10a1,1,0,0,0,2,0V4.41l1.29,1.3a1,1,0,0,0,1.42,0A1,1,0,0,0,22.71,4.29Z">
                                                </path>
                                            </g>
                                        </svg>
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
                        <ul>
                            @if (Session::has('success'))
                                <div class="alert alert-info alert-outline">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        class="h-6 w-6 shrink-0 stroke-current">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ Session::get('success') }}
                                </div>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
