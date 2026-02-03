<div id="media" class="scroll-mt-24">
    <x-admin.ui.card>
        <x-slot:header>
            <div class="flex items-center gap-3">
                <div class="p-2 bg-pink-100 text-pink-600 rounded-lg shrink-0">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                </div>
                <h2 class="text-[13px] sm:text-base font-bold text-black tracking-widest leading-none">Media</h2>
            </div>
        </x-slot:header>
        <div class="p-6 sm:p-8 space-y-16">
            {{-- Intro --}}
            <div class="max-w-4xl">
                <p
                    class="text-[11px] sm:text-sm text-black leading-relaxed italic border-l-4 border-pink-500 pl-4 py-1">
                    Modul Media digunakan untuk mengelola aset visual berupa foto dan video kegiatan. Seluruh konten
                    media yang diunggah akan otomatis tersaji dalam format Galeri pada website utama.
                </p>
            </div>

            {{-- 1. FOTO --}}
            <div class="space-y-6">
                <div class="border-b border-black/10 pb-4">
                    <h3 class="text-[13px] sm:text-base font-bold text-black tracking-tight">Foto</h3>
                </div>
                <div class="space-y-6">
                    <div class="space-y-2">
                        <p class="text-[13px] sm:text-base font-bold text-black tracking-tight">Fungsi & Kegunaan</p>
                        <p class="text-[11px] sm:text-sm text-black leading-relaxed">Berfungsi untuk menyimpan
                            dokumentasi visual sekolah. Digunakan untuk memperlihatkan fasilitas sekolah, kemeriahan
                            lomba, atau suasana belajar mengajar kepada publik.</p>
                    </div>
                    <div class="p-6 bg-gray-100 border border-black/10 rounded-2xl space-y-6">
                        <p class="text-[13px] sm:text-base font-bold text-black">Instruksi Penggunaan (Upload & Kelola)
                        </p>
                        <div class="space-y-6 text-[11px] sm:text-sm text-black">
                            <div class="flex gap-4">
                                <span class="w-2 h-2 rounded-full bg-pink-600 mt-2 shrink-0"></span>
                                <div>
                                    <p class="font-bold mb-1">Mulai Upload:</p>
                                    <p>Masuk ke menu sidebar <strong>Media > Foto</strong>, lalu pilih tombol
                                        <strong>"Tambah"</strong> untuk membuka modal upload. Anda dapat mengunggah
                                        hingga <strong>16 foto</strong> sekaligus.
                                    </p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <span class="w-2 h-2 rounded-full bg-pink-600 mt-2 shrink-0"></span>
                                <div>
                                    <p class="font-bold mb-1">Mengatur Urutan:</p>
                                    <p>Anda dapat mengatur urutan foto yang tampil di website dengan cara
                                        <strong>menarik (drag)</strong> foto langsung pada grid galeri. Posisi yang Anda
                                        tentukan akan otomatis tersimpan.
                                    </p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <span class="w-2 h-2 rounded-full bg-pink-600 mt-2 shrink-0"></span>
                                <div>
                                    <p class="font-bold mb-1">Penghapusan:</p>
                                    <p>Gunakan tombol hapus pada foto untuk menghapus dokumentasi yang sudah tidak
                                        diperlukan.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 2. VIDEO --}}
            <div class="space-y-6">
                <div class="border-b border-black/10 pb-4">
                    <h3 class="text-[13px] sm:text-base font-bold text-black tracking-tight">Video</h3>
                </div>
                <div class="space-y-6">
                    <div class="space-y-2">
                        <p class="text-[13px] sm:text-base font-bold text-black tracking-tight">Fungsi & Kegunaan</p>
                        <p class="text-[11px] sm:text-sm text-black leading-relaxed">Modul ini bertugas menampilkan
                            video sinematik
                            atau profil sekolah. Sistem menggunakan integrasi YouTube agar performa load website tetap
                            ringan dan cepat tanpa menghabiskan ruang penyimpanan hosting.</p>
                    </div>
                    <div class="p-6 bg-gray-100 border border-black/10 rounded-2xl space-y-6">
                        <p class="text-[13px] sm:text-base font-bold text-black">Instruksi Penggunaan (Mulai Sampai
                            Selesai)
                        </p>
                        <div class="space-y-6 text-[11px] sm:text-sm text-black">
                            <div class="flex gap-4">
                                <span class="w-2 h-2 rounded-full bg-pink-600 mt-2 shrink-0"></span>
                                <div>
                                    <p class="font-bold mb-1">Mulai Pakai:</p>
                                    <p>Buka menu <strong>Media > Video</strong>, klik tombol <strong>"Tambah"</strong>.</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <span class="w-2 h-2 rounded-full bg-pink-600 mt-2 shrink-0"></span>
                                <div>
                                    <p class="font-bold mb-1">Input Link YouTube:</p>
                                    <p>Isi <strong>Judul</strong>, lalu salin URL/Link video dari YouTube dan masukkan ke
                                        kolom <strong>Link</strong>.</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <span class="w-2 h-2 rounded-full bg-pink-600 mt-2 shrink-0"></span>
                                <div>
                                    <p class="font-bold mb-1">Publikasi Akhir:</p>
                                    <p>Pilih status <strong>"Publish"</strong> atau <strong>"Draft"</strong>, lalu
                                        klik tombol <strong>Publish</strong>. Video yang sudah tersimpan dapat
                                        dinonaktifkan lewat halaman edit (status <strong>"Nonaktif"</strong>).
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-admin.ui.card>
</div>
