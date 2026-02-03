<div id="tips" class="scroll-mt-24">
    <x-admin.ui.card>
        <x-slot:header>
            <div class="flex items-center gap-3">
                <div class="p-2 bg-amber-100 text-amber-700 rounded-lg shrink-0">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z">
                        </path>
                    </svg>
                </div>
                <h2 class="text-[13px] sm:text-base font-bold text-black tracking-widest leading-none">Tips & Trik Cerdas
                </h2>
            </div>
        </x-slot:header>
        <div class="p-6 sm:p-8 space-y-16">
            {{-- Intro --}}
            <div class="max-w-4xl">
                <p class="text-[11px] sm:text-sm text-black leading-relaxed italic border-l-4 border-amber-500 pl-4 py-1">
                    Bagian ini merangkum teknik-teknik khusus untuk memaksimalkan performa website dan efisiensi kerja
                    administrator dalam pengelolaan harian.
                </p>
            </div>

            {{-- 1. MENULIS --}}
            <div class="space-y-6">
                <div class="border-b border-black/10 pb-4">
                    <h3 class="text-[13px] sm:text-base font-bold text-black tracking-tight">Kualitas Penulisan Publikasi
                    </h3>
                </div>
                <div class="p-6 bg-gray-100 border border-black/10 rounded-2xl space-y-6">
                    <div class="space-y-6 text-[11px] sm:text-sm text-black">
                        <div class="flex gap-4">
                            <span class="w-2 h-2 rounded-full bg-amber-600 mt-2 shrink-0"></span>
                            <div>
                                <p class="font-bold mb-1">Teknik Judul:</p>
                                <p>Gunakan judul yang ringkas namun informatif (click-worthy). Hindari judul yang
                                    terlalu panjang agar tidak terpotong saat dibagikan ke media sosial.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <span class="w-2 h-2 rounded-full bg-amber-600 mt-2 shrink-0"></span>
                            <div>
                                <p class="font-bold mb-1">Struktur Konten:</p>
                                <p>Sematkan minimal satu gambar pendukung di tengah tulisan artikel untuk menjaga minat
                                    baca pengunjung dan membuat tampilan halaman lebih hidup.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 2. MEDIA --}}
            <div class="space-y-6">
                <div class="border-b border-black/10 pb-4">
                    <h3 class="text-[13px] sm:text-base font-bold text-black tracking-tight">Optimalisasi Penyimpanan Media
                    </h3>
                </div>
                <div class="p-6 bg-gray-100 border border-black/10 rounded-2xl space-y-6">
                    <div class="space-y-6 text-[11px] sm:text-sm text-black">
                        <div class="flex gap-4">
                            <span class="w-2 h-2 rounded-full bg-amber-600 mt-2 shrink-0"></span>
                            <div>
                                <p class="font-bold mb-1">Ukuran File:</p>
                                <p>Gunakan gambar dengan ukuran wajar agar proses unggah lancar. Umumnya gambar di bawah
                                    <strong>10MB</strong> per file sudah ideal. Jika file terlalu besar, kompres terlebih
                                    dahulu sebelum diunggah.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <span class="w-2 h-2 rounded-full bg-amber-600 mt-2 shrink-0"></span>
                            <div>
                                <p class="font-bold mb-1">Format Video:</p>
                                <p>Selalu prioritaskan penggunaan link YouTube dibanding mengunggah file video mentah.
                                    Ini akan menjaga website tetap ringan dan hemat biaya penyimpanan data (hosting).
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 3. KEAMANAN --}}
            <div class="space-y-6">
                <div class="border-b border-black/10 pb-4">
                    <h3 class="text-[13px] sm:text-base font-bold text-black tracking-tight">Prosedur Keamanan Sistem</h3>
                </div>
                <div class="p-6 bg-gray-100 border border-black/10 rounded-2xl space-y-6">
                    <div class="space-y-6 text-[11px] sm:text-sm text-black">
                        <div class="flex gap-4">
                            <span class="w-2 h-2 rounded-full bg-amber-600 mt-2 shrink-0"></span>
                            <div>
                                <p class="font-bold mb-1">Manajemen Kata Sandi:</p>
                                <p>Jaga akun admin dengan kata sandi yang kuat dan tidak dibagikan. Gunakan kombinasi
                                    huruf besar-kecil, angka, dan simbol.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <span class="w-2 h-2 rounded-full bg-amber-600 mt-2 shrink-0"></span>
                            <div>
                                <p class="font-bold mb-1">Kendala Teknis:</p>
                                <p>Jika menemukan error sistem yang tidak bisa diselesaikan melalui panduan operasional
                                    ini, segera laporkan detail permasalahan kepada Support Tim IT sekolah untuk
                                    penanganan lebih lanjut.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-admin.ui.card>
</div>
