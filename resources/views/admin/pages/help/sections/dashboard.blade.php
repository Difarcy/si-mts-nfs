<div id="dashboard" class="scroll-mt-24">
    <x-admin.ui.card>
        <x-slot:header>
            <div class="flex items-center gap-3">
                <div class="p-2 bg-blue-100 text-blue-600 rounded-lg shrink-0">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                </div>
                <h2 class="text-[13px] sm:text-base font-bold text-black tracking-widest leading-none">Dashboard</h2>
            </div>
        </x-slot:header>
        <div class="p-6 sm:p-8 space-y-12">
            {{-- Pengantar --}}
            <div class="space-y-3">
                <h3 class="text-[13px] sm:text-base font-bold text-black tracking-wide">Ringkasan Sistem</h3>
                <p class="text-[11px] sm:text-sm text-black leading-relaxed">
                    Halaman Dashboard adalah titik awal setelah Administrator melakukan login. Halaman ini memberikan
                    ringkasan data singkat (statistik konten dan interaksi) serta pintasan untuk membuat konten dan
                    mengelola media.
                </p>
            </div>

            {{-- Cara Menggunakan Widget --}}
            <div class="space-y-4">
                <h3 class="text-[13px] sm:text-base font-bold text-black tracking-wide">Panduan Penggunaan Widget Statistik
                </h3>
                <div class="space-y-4">
                    <p class="text-[11px] sm:text-sm text-black leading-relaxed">
                        Di bagian atas, terdapat empat kartu statistik utama (Berita, Artikel, Komentar, Pesan). Cara
                        mengoperasikannya adalah sebagai berikut:
                    </p>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="p-4 border border-black/10 bg-gray-50/50 rounded-xl">
                            <p class="text-[11px] font-bold text-black mb-2 underline">Akses Cepat</p>
                            <p class="text-[11px] sm:text-sm text-black leading-relaxed">Klik kartu untuk membuka halaman data
                                lengkap sesuai kategorinya.</p>
                        </div>
                        <div class="p-4 border border-black/10 bg-gray-50/50 rounded-xl">
                            <p class="text-[11px] font-bold text-black mb-2 underline">Audit Draft</p>
                            <p class="text-[11px] sm:text-sm text-black leading-relaxed">Periksa teks kecil di kiri bawah kartu (footer
                                kartu) untuk melihat berapa banyak konten yang masih bersatus draft dan belum tampil di
                                website.</p>
                        </div>
                        <div class="p-4 border border-black/10 bg-gray-50/50 rounded-xl">
                            <p class="text-[11px] font-bold text-black mb-2 underline">Respon Cepat</p>
                            <p class="text-[11px] sm:text-sm text-black leading-relaxed">Gunakan kartu Komentar dan Pesan Masuk untuk
                                memantau item yang perlu ditindaklanjuti.</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Cara Menggunakan Aksi Cepat --}}
            <div class="space-y-4">
                <h3 class="text-[13px] sm:text-base font-bold text-black tracking-wide">Panduan Menggunakan Panel Aksi Cepat
                </h3>
                <div class="bg-gray-50 border border-black/10 p-6 rounded-2xl">
                    <p class="text-sm font-bold text-black leading-relaxed mb-4 italic">Fungsi ini digunakan untuk
                        memangkas waktu navigasi tanpa harus membuka sidebar menu:</p>
                    <ul class="space-y-4 text-[11px] sm:text-sm text-black">
                        <li class="flex gap-3">
                            <span class="font-bold text-blue-600">01.</span>
                            <span><strong>Pilih Tombol:</strong> Tentukan konten apa yang akan diunggah (misal: Tulis
                                Berita). Ikon tombol dibuat mencolok untuk memudahkan identifikasi visual.</span>
                        </li>
                        <li class="flex gap-3">
                            <span class="font-bold text-blue-600">02.</span>
                            <span><strong>Klik & Isi Form:</strong> Setelah diklik, sistem membuka halaman/fitur terkait.
                                Isi data yang diperlukan, lalu simpan/publish sesuai kebutuhan.</span>
                        </li>
                        <li class="flex gap-3">
                            <span class="font-bold text-blue-600">03.</span>
                            <span><strong>Efisiensi:</strong> Gunakan pintasan ini untuk mempercepat pembuatan Berita,
                                Artikel, Pengumuman, Agenda, serta akses cepat ke Media (Foto/Video).</span>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Cara Menggunakan Tabel Monitoring --}}
            <div class="space-y-4">
                <h3 class="text-[13px] sm:text-base font-bold text-black tracking-wide">Panduan Pemantauan Tabel Aktivitas
                </h3>
                <p class="text-[11px] sm:text-sm text-black leading-relaxed">
                    Bagian bawah berisi tiga tabel: Komentar Terbaru, Pesan Masuk, dan Agenda Terdekat. Cara pakainya
                    adalah:
                </p>
                <div class="space-y-3">
                    <div class="p-4 border border-black/10 bg-white rounded-xl shadow-sm">
                        <p class="text-[13px] sm:text-base font-bold text-black mb-1">Operasional Interaksi (Komentar & Pesan)</p>
                        <p class="text-[11px] sm:text-sm text-black leading-relaxed italic">Baca inti pesan/komentar pada tabel. Jika
                            butuh tindakan seperti membalas pesan atau menyetujui komentar, klik link <strong>"Lihat
                                Semua"</strong> untuk masuk ke kontrol panel yang lebih lengkap.</p>
                    </div>
                    <div class="p-4 border border-black/10 bg-white rounded-xl shadow-sm">
                        <p class="text-[13px] sm:text-base font-bold text-black mb-1">Operasional Penjadwalan (Agenda)</p>
                        <p class="text-[11px] sm:text-sm text-black leading-relaxed italic">Tabel Agenda Terdekat berfungsi
                            menginformasikan kegiatan harian. Periksa secara berkala untuk memastikan tidak ada kegiatan
                            yang salah jadwal di kalender website.</p>
                    </div>
                </div>
            </div>
        </div>
    </x-admin.ui.card>
</div>
