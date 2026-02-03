<div id="interaksi" class="scroll-mt-24">
    <x-admin.ui.card>
        <x-slot:header>
            <div class="flex items-center gap-3">
                <div class="p-2 bg-purple-100 text-purple-600 rounded-lg shrink-0">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                        </path>
                    </svg>
                </div>
                <h2 class="text-[13px] sm:text-base font-bold text-black tracking-widest leading-none">Interaksi</h2>
            </div>
        </x-slot:header>
        <div class="p-6 sm:p-8 space-y-16">
            {{-- Intro --}}
            <div class="max-w-4xl">
                <p class="text-[11px] sm:text-sm text-black leading-relaxed italic border-l-4 border-purple-500 pl-4 py-1">
                    Modul Interaksi adalah akses untuk mendengarkan suara pengunjung. Di sini Administrator mengelola
                    feedback berupa pesan langsung maupun tanggapan pada tulisan di website.
                </p>
            </div>

            {{-- 1. PESAN MASUK --}}
            <div class="space-y-6">
                <div class="border-b border-black/10 pb-4">
                    <h3 class="text-[13px] sm:text-base font-bold text-black tracking-tight">Pesan Masuk (Inbox)</h3>
                </div>
                <div class="space-y-6">
                    <div class="space-y-2">
                        <p class="text-[13px] sm:text-base font-bold text-black tracking-tight">Fungsi & Kegunaan</p>
                        <p class="text-[11px] sm:text-sm text-black leading-relaxed">Pintu utama bagi calon siswa atau wali murid untuk
                            bertanya melalui formulir kontak. Digunakan untuk merespon pertanyaan umum seputar sekolah
                            tanpa harus bertatap muka langsung.</p>
                    </div>
                    <div class="p-6 bg-gray-100 border border-black/10 rounded-2xl space-y-6">
                        <p class="text-[13px] sm:text-base font-bold text-black">Instruksi Penggunaan (Mulai Sampai Selesai)
                        </p>
                        <div class="space-y-6 text-[11px] sm:text-sm text-black">
                            <div class="flex gap-4">
                                <span class="w-2 h-2 rounded-full bg-purple-600 mt-2 shrink-0"></span>
                                <div>
                                    <p class="font-bold mb-1">Mulai Pakai:</p>
                                    <p>Masuk ke menu <strong>Interaksi > Pesan Masuk</strong>. Pesan yang belum dibaca
                                        akan memiliki tanda indikator Bold atau Warna yang berbeda.</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <span class="w-2 h-2 rounded-full bg-purple-600 mt-2 shrink-0"></span>
                                <div>
                                    <p class="font-bold mb-1">Membaca Pesan:</p>
                                    <p>Klik pada baris pesan untuk membuka detail lengkap. Teliti Nama pengirim, Nomor
                                        WA/Email yang bisa dihubungi, dan inti permasalahannya.</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <span class="w-2 h-2 rounded-full bg-purple-600 mt-2 shrink-0"></span>
                                <div>
                                    <p class="font-bold mb-1">Tindak Lanjut:</p>
                                    <p>Setelah pesan dibaca, Administrator dapat memberikan catatan atau langsung
                                        menghubungi pengirim melalui kanal yang dicantumkan untuk penyelesaian masalah.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 2. KOMENTAR --}}
            <div class="space-y-6">
                <div class="border-b border-black/10 pb-4">
                    <h3 class="text-[13px] sm:text-base font-bold text-black tracking-tight">Moderasi Komentar</h3>
                </div>
                <div class="space-y-6">
                    <div class="space-y-2">
                        <p class="text-[13px] sm:text-base font-bold text-black tracking-tight">Fungsi & Kegunaan</p>
                        <p class="text-[11px] sm:text-sm text-black leading-relaxed">Alat untuk menyaring diskusi pada berita atau
                            artikel. Seluruh komentar pengunjung tidak akan langsung tayang melainkan masuk ke antrean
                            filter (moderasi) demi menghindari spam atau kata-kata yang tidak pantas.</p>
                    </div>
                    <div class="p-6 bg-gray-100 border border-black/10 rounded-2xl space-y-6">
                        <p class="text-[13px] sm:text-base font-bold text-black">Instruksi Penggunaan (Mulai Sampai Selesai)
                        </p>
                        <div class="space-y-6 text-[11px] sm:text-sm text-black">
                            <div class="flex gap-4">
                                <span class="w-2 h-2 rounded-full bg-purple-600 mt-2 shrink-0"></span>
                                <div>
                                    <p class="font-bold mb-1">Mulai Pakai:</p>
                                    <p>Pilih menu <strong>Interaksi > Komentar</strong>. Lihat kolom status, pastikan
                                        fokus pada status <strong>"Pending"</strong> (menunggu persetujuan).
                                    </p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <span class="w-2 h-2 rounded-full bg-purple-600 mt-2 shrink-0"></span>
                                <div>
                                    <p class="font-bold mb-1">Aksi Persetujuan:</p>
                                    <p>Baca isi komentar. Jika layak, tekan tombol <strong>"Setujui"</strong>. Jika
                                        berisi iklan atau kata-kata tidak pantas, gunakan tombol <strong>Hapus</strong>.
                                        Anda juga dapat menandai komentar <strong>Dibaca</strong> atau <strong>Belum
                                            Dibaca</strong> sesuai kebutuhan.</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <span class="w-2 h-2 rounded-full bg-purple-600 mt-2 shrink-0"></span>
                                <div>
                                    <p class="font-bold mb-1">Finalisasi:</p>
                                    <p>Komentar yang disetujui akan langsung muncul pada area diskusi di bawah berita
                                        terkait secara publik di website utama.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-admin.ui.card>
</div>
