  <x-layout>
      <x-slot:title>
          Register
      </x-slot:title>

      <div class="flex flex-col md:flex-row min-h-[calc(100vh-65px)] rounded-full">

          <!-- Left panel -->
          <div
              class="relative w-full md:w-1/2 min-h-[320px] md:min-h-full flex flex-col justify-between p-8 md:p-12 overflow-hidden">
              <!-- background image + overlay -->
              <div class="absolute inset-0 bg-cover bg-center"
                  style="background-image: url('https://images.unsplash.com/photo-1521587760476-6c12a4b040da?auto=format&fit=crop&w=1200&q=80');">
              </div>
              <div class="absolute inset-0 bg-cyan-800/80"></div>

              <div class="relative z-10">
                  <span class="inline-block border border-white/40 text-white text-xs px-3 py-1 rounded-full mb-6">
                      Gerbang Pengetahuan
                  </span>
                  <h1 class="font-serif-italic text-white text-4xl md:text-5xl mb-2">InsiLib</h1>
              </div>

              <div class="relative z-10 text-white max-w-md">
                  <h2 class="text-2xl md:text-3xl font-semibold mb-3">Perpustakaan Wawasan Anda</h2>
                  <p class="text-white/80 text-sm mb-5 leading-relaxed">
                      Temukan koleksi pustaka digital, arsip pengetahuan, dan literatur pilihan dari
                      seluruh dunia untuk menunjang pencapaian akademis dan riset terbaik Anda.
                  </p>
                  <ul class="space-y-2 text-sm">
                      <li class="flex items-center gap-2">
                          <span class="text-cyan-300">✦</span> Akses 24/7 Tanpa Batas
                      </li>
                      <li class="flex items-center gap-2">
                          <span class="text-cyan-300">✦</span> Ribuan Jurnal Terakreditasi
                      </li>
                      <li class="flex items-center gap-2">
                          <span class="text-cyan-300">✦</span> Rekomendasi Cerdas Berbasis AI
                      </li>
                  </ul>
              </div>
          </div>

          <!-- Right panel -->
          <div class="w-full md:w-1/2 flex items-center justify-center bg-[#F3F1EC] p-8 md:p-12">
              <div class="w-full max-w-sm">
                  <h2 class="text-2xl font-bold text-gray-900 mb-1">Buat Akun Baru</h2>
                  <p class="text-sm text-gray-500 mb-8">Daftar untuk mulai mengakses layanan perpustakaan digital
                      lengkap</p>

                  <form action="{{ route('register.process') }}" method="POST" class="space-y-5">
                      @csrf
                      <div>
                          <label for="name" class="block text-sm font-medium text-gray-700 mb-1.5">Nama
                              Lengkap</label>
                          <div class="relative">
                              <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24"
                                      fill="none" stroke="currentColor" stroke-width="2">
                                      <circle cx="12" cy="8" r="4" />
                                      <path d="M4 21v-1a7 7 0 0 1 14 0v1" />
                                  </svg>
                              </span>
                              <input type="text" id="name" name="name" placeholder="Sarah Chen"
                                  class="w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-md text-sm bg-white focus:outline-none focus:ring-2 focus:ring-cyan-600 focus:border-transparent">
                          </div>
                      </div>

                      <div>
                          <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">Alamat
                              Email</label>
                          <div class="relative">
                              <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24"
                                      fill="none" stroke="currentColor" stroke-width="2">
                                      <rect x="2" y="4" width="20" height="16" rx="2" />
                                      <path d="m22 6-10 7L2 6" />
                                  </svg>
                              </span>
                              <input type="email" id="email" name="email" placeholder="sarah.chen@insilib.org"
                                  class="w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-md text-sm bg-white focus:outline-none focus:ring-2 focus:ring-cyan-600 focus:border-transparent">
                          </div>
                      </div>

                      <div>
                          <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5">Kata
                              Sandi</label>
                          <div class="relative">
                              <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24"
                                      fill="none" stroke="currentColor" stroke-width="2">
                                      <rect x="3" y="11" width="18" height="10" rx="2" />
                                      <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                                  </svg>
                              </span>
                              <input type="password" id="password" name="password" placeholder="••••••••••"
                                  class="w-full pl-10 pr-10 py-2.5 border border-gray-300 rounded-md text-sm bg-white focus:outline-none focus:ring-2 focus:ring-cyan-600 focus:border-transparent">
                              <button type="button" onclick="togglePassword('password')"
                                  class="absolute inset-y-0 right-3 flex items-center text-cyan-700">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24"
                                      fill="none" stroke="currentColor" stroke-width="2">
                                      <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z" />
                                      <circle cx="12" cy="12" r="3" />
                                  </svg>
                              </button>
                          </div>
                      </div>

                      <div>
                          <label for="password_confirmation"
                              class="block text-sm font-medium text-gray-700 mb-1.5">Konfirmasi Kata Sandi</label>
                          <div class="relative">
                              <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24"
                                      fill="none" stroke="currentColor" stroke-width="2">
                                      <rect x="3" y="11" width="18" height="10" rx="2" />
                                      <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                                  </svg>
                              </span>
                              <input type="password" id="password_confirmation" name="password_confirmation"
                                  placeholder="••••••••••"
                                  class="w-full pl-10 pr-10 py-2.5 border border-gray-300 rounded-md text-sm bg-white focus:outline-none focus:ring-2 focus:ring-cyan-600 focus:border-transparent">
                              <button type="button" onclick="togglePassword('password_confirmation')"
                                  class="absolute inset-y-0 right-3 flex items-center text-cyan-700">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24"
                                      fill="none" stroke="currentColor" stroke-width="2">
                                      <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z" />
                                      <circle cx="12" cy="12" r="3" />
                                  </svg>
                              </button>
                          </div>
                      </div>

                      <button type="submit"
                          class="w-full bg-cyan-800 hover:bg-cyan-900 text-white font-medium py-2.5 rounded-md text-sm transition-colors">
                          Daftar Akun Baru
                      </button>

                      <p class="text-center text-sm text-gray-500">
                          Sudah punya akun? <a href="{{ route('login') }}"
                              class="text-cyan-700 font-medium hover:underline">Masuk</a>
                      </p>
                  </form>
              </div>
          </div>

      </div>

      <script>
          function togglePassword(id) {
              const input = document.getElementById(id);
              input.type = input.type === 'password' ? 'text' : 'password';
          }
      </script>
  </x-layout>
