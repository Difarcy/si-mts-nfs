<div id="konten" class="space-y-4 scroll-mt-24">
    <x-admin.ui.card>
        <x-slot:header>
            <div class="flex items-center gap-3">
                <div class="p-2 bg-green-100 text-green-700 rounded-lg shrink-0">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                        </path>
                    </svg>
                </div>
                <h2 class="text-[13px] sm:text-base font-bold text-black tracking-widest leading-none">Konten</h2>
            </div>
        </x-slot:header>
        <div class="p-6 sm:p-8 space-y-16">
            {{-- Intro --}}
            <div class="max-w-4xl">
                <p
                    class="text-[11px] sm:text-sm text-black leading-relaxed italic border-l-4 border-green-500 pl-4 py-1">
                    Modul Konten adalah instrumen utama untuk mempublikasikan informasi di website sekolah. Ikuti alur
                    kerja dari pembukaan menu hingga publikasi akhir di bawah ini.
                </p>
            </div>

            {{-- 1. BERITA --}}
            <div class="space-y-6">
                <div class="border-b border-black/10 pb-4">
                    <h3 class="text-[13px] sm:text-base font-bold text-black tracking-tight">Berita</h3>
                </div>
                <div class="space-y-6">
                    <div class="space-y-2">
                        <p class="text-[13px] sm:text-base font-bold text-black tracking-tight">Fungsi & Kegunaan</p>
                        <p class="text-[11px] sm:text-sm text-black leading-relaxed">Berfungsi sebagai laporan
                            jurnalistik kegiatan sekolah. Digunakan untuk mendokumentasikan setiap acara resmi agar wali
                            murid mengetahui aktivitas terkini putra-putrinya.</p>
                    </div>
                    <div class="p-6 bg-gray-100 border border-black/10 rounded-2xl space-y-6">
                        <p class="text-[13px] sm:text-base font-bold text-black">Instruksi Penggunaan (Sampai Selesai)
                        </p>
                        <div class="space-y-6 text-[11px] sm:text-sm text-black">
                            <div class="flex gap-4">
                                <span class="w-2 h-2 rounded-full bg-green-600 mt-2 shrink-0"></span>
                                <div>
                                    <p class="font-bold mb-1">Mulai Pakai:</p>
                                    <p>Masuk ke menu sidebar <strong>Konten > Berita</strong>, lalu klik tombol hijau
                                        besar <strong>"Tambah Berita"</strong>.</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <span class="w-2 h-2 rounded-full bg-green-600 mt-2 shrink-0"></span>
                                <div>
                                    <p class="font-bold mb-1">Input Data & Gambar:</p>
                                    <p>Isi Judul, Status, Penulis, dan narasi berita. Pada bagian media, unggah
                                        <strong>Thumbnail</strong> (wajib) dan <strong>Gambar</strong> (opsional).
                                        Anda dapat mengunggah hingga <strong>6 gambar</strong> sekaligus dan menggeser
                                        gambar untuk mengubah urutan.</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <span class="w-2 h-2 rounded-full bg-green-600 mt-2 shrink-0"></span>
                                <div>
                                    <p class="font-bold mb-1">Publikasi Akhir:</p>
                                    <p>Pilih status <strong>"Publish"</strong> atau <strong>"Draft"</strong>, lalu
                                        klik tombol <strong>Publish</strong> di bagian atas halaman.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 2. ARTIKEL --}}
            <div class="space-y-6">
                <div class="border-b border-black/10 pb-4">
                    <h3 class="text-[13px] sm:text-base font-bold text-black tracking-tight">Artikel</h3>
                </div>
                <div class="space-y-6">
                    <div class="space-y-2">
                        <p class="text-[13px] sm:text-base font-bold text-black tracking-tight">Fungsi & Kegunaan</p>
                        <p class="text-[11px] sm:text-sm text-black leading-relaxed">Digunakan sebagai sumber literasi
                            edukasi. Artikel lebih fokus pada tips belajar, opini guru, atau pembahasan materi
                            pendidikan yang bersifat informatif.</p>
                    </div>
                    <div class="p-6 bg-gray-100 border border-black/10 rounded-2xl space-y-6">
                        <p class="text-[13px] sm:text-base font-bold text-black">Instruksi Penggunaan (Sampai Selesai)
                        </p>
                        <div class="space-y-6 text-[11px] sm:text-sm text-black">
                            <div class="flex gap-4">
                                <span class="w-2 h-2 rounded-full bg-green-600 mt-2 shrink-0"></span>
                                <div>
                                    <p class="font-bold mb-1">Mulai Pakai:</p>
                                    <p>Pilih menu sidebar <strong>Konten > Artikel</strong>, lalu klik tombol
                                        <strong>"Tambah Artikel"</strong> di bagian atas tabel.
                                    </p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <span class="w-2 h-2 rounded-full bg-green-600 mt-2 shrink-0"></span>
                                <div>
                                    <p class="font-bold mb-1">Input Data & Gambar:</p>
                                    <p>Masukkan Judul, Status, Penulis, dan isi pembahasan. Pada bagian media, unggah
                                        <strong>Thumbnail</strong> (wajib) dan <strong>Gambar</strong> (opsional, maksimal
                                        <strong>6 gambar</strong>), lalu geser gambar untuk mengubah urutan.</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <span class="w-2 h-2 rounded-full bg-green-600 mt-2 shrink-0"></span>
                                <div>
                                    <p class="font-bold mb-1">Publikasi Akhir:</p>
                                    <p>Periksa kembali isi tulisan, lalu klik tombol <strong>Publish</strong> untuk
                                        menyimpan dan menerbitkan (atau simpan sebagai <strong>Draft</strong>).</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 3. PENGUMUMAN --}}
            <div class="space-y-6">
                <div class="border-b border-black/10 pb-4">
                    <h3 class="text-[13px] sm:text-base font-bold text-black tracking-tight">Pengumuman</h3>
                </div>
                <div class="space-y-6">
                    <div class="space-y-2">
                        <p class="text-[13px] sm:text-base font-bold text-black tracking-tight">Fungsi & Kegunaan</p>
                        <p class="text-[11px] sm:text-sm text-black leading-relaxed">Fitur khusus untuk pesan
                            administratif yang sangat penting, seperti info beasiswa, pengumuman libur, atau jadwal
                            ujian sekolah yang wajib diketahui segera.</p>
                    </div>
                    <div class="p-6 bg-gray-100 border border-black/10 rounded-2xl space-y-6">
                        <p class="text-[13px] sm:text-base font-bold text-black">Instruksi Penggunaan (Sampai Selesai)
                        </p>
                        <div class="space-y-6 text-[11px] sm:text-sm text-black">
                            <div class="flex gap-4">
                                <span class="w-2 h-2 rounded-full bg-green-600 mt-2 shrink-0"></span>
                                <div>
                                    <p class="font-bold mb-1">Mulai Pakai:</p>
                                    <p>Klik menu sidebar <strong>Konten > Pengumuman</strong>, lalu tekan tombol
                                        <strong>"Tambah Pengumuman"</strong>.
                                    </p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <span class="w-2 h-2 rounded-full bg-green-600 mt-2 shrink-0"></span>
                                <div>
                                    <p class="font-bold mb-1">Input Data & Media:</p>
                                    <p>Tuliskan Judul dan isi pesan. Anda bisa menambahkan <strong>Gambar</strong>
                                        (maksimal 6) dan <strong>Lampiran</strong> (opsional) untuk melengkapi informasi.</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <span class="w-2 h-2 rounded-full bg-green-600 mt-2 shrink-0"></span>
                                <div>
                                    <p class="font-bold mb-1">Publikasi Akhir:</p>
                                    <p>Tentukan status <strong>"Publish"</strong> atau <strong>"Draft"</strong>, lalu
                                        klik tombol <strong>Publish</strong> untuk menyimpan.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 4. AGENDA --}}
            <div class="space-y-6">
                <div class="border-b border-black/10 pb-4">
                    <h3 class="text-[13px] sm:text-base font-bold text-black tracking-tight">Agenda</h3>
                </div>
                <div class="space-y-6">
                    <div class="space-y-2">
                        <p class="text-[13px] sm:text-base font-bold text-black tracking-tight">Fungsi & Kegunaan</p>
                        <p class="text-[11px] sm:text-sm text-black leading-relaxed">Instrumen kalender sekolah untuk
                            publik. Berfungsi menginformasikan jadwal rapat orang tua, kegiatan ekskul, atau event
                            sekolah mendatang.</p>
                    </div>
                    <div class="p-6 bg-gray-100 border border-black/10 rounded-2xl space-y-6">
                        <p class="text-[13px] sm:text-base font-bold text-black">Instruksi Penggunaan (Sampai Selesai)
                        </p>
                        <div class="space-y-6 text-[11px] sm:text-sm text-black">
                            <div class="flex gap-4">
                                <span class="w-2 h-2 rounded-full bg-green-600 mt-2 shrink-0"></span>
                                <div>
                                    <p class="font-bold mb-1">Mulai Pakai:</p>
                                    <p>Pilih menu sidebar <strong>Konten > Agenda</strong>, klik tombol <strong>"Tambah
                                            Agenda"</strong>.</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <span class="w-2 h-2 rounded-full bg-green-600 mt-2 shrink-0"></span>
                                <div>
                                    <p class="font-bold mb-1">Input Data & Dokumentasi:</p>
                                    <p>Tulis Nama Kegiatan, Lokasi, dan Tanggal. Anda dapat menambahkan <strong>Foto
                                            Kegiatan</strong> (maksimal 6 gambar) serta <strong>Lampiran</strong>
                                        (opsional) sebagai dokumentasi agenda.</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <span class="w-2 h-2 rounded-full bg-green-600 mt-2 shrink-0"></span>
                                <div>
                                    <p class="font-bold mb-1">Publikasi Akhir:</p>
                                    <p>Periksa kembali akurasi tanggal agar tidak terjadi kesalahan jadwal, lalu klik
                                        tombol <strong>Simpan</strong>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 5. PRESTASI --}}
            <div class="space-y-6">
                <div class="border-b border-black/10 pb-4">
                    <h3 class="text-[13px] sm:text-base font-bold text-black tracking-tight">Prestasi Siswa</h3>
                </div>
                <div class="space-y-6">
                    <div class="space-y-2">
                        <p class="text-[13px] sm:text-base font-bold text-black tracking-tight">Fungsi & Kegunaan</p>
                        <p class="text-[11px] sm:text-sm text-black leading-relaxed">Modul portofolio keunggulan
                            sekolah. Digunakan untuk mendokumentasikan piala, medali, atau penghargaan yang diraih siswa
                            di berbagai tingkatan lomba.</p>
                    </div>
                    <div class="p-6 bg-gray-100 border border-black/10 rounded-2xl space-y-6">
                        <p class="text-[13px] sm:text-base font-bold text-black">Instruksi Penggunaan (Sampai Selesai)
                        </p>
                        <div class="space-y-6 text-[11px] sm:text-sm text-black">
                            <div class="flex gap-4">
                                <span class="w-2 h-2 rounded-full bg-green-600 mt-2 shrink-0"></span>
                                <div>
                                    <p class="font-bold mb-1">Mulai Pakai:</p>
                                    <p>Akses menu sidebar <strong>Konten > Prestasi Siswa</strong>, kemudian klik tombol
                                        <strong>"Tambah Prestasi"</strong>.</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <span class="w-2 h-2 rounded-full bg-green-600 mt-2 shrink-0"></span>
                                <div>
                                    <p class="font-bold mb-1">Input Data:</p>
                                    <p>Masukkan detail prestasi (Nama Lomba, Nama Siswa, Deskripsi, Kelas, Tingkat,
                                        Jenis, Peringkat, dan Tanggal). Upload <strong>Foto Siswa</strong> dan
                                        <strong>Sertifikat</strong> sesuai kolom yang tersedia.</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <span class="w-2 h-2 rounded-full bg-green-600 mt-2 shrink-0"></span>
                                <div>
                                    <p class="font-bold mb-1">Publikasi Akhir:</p>
                                    <p>Pilih status <strong>"Publish"</strong> atau <strong>"Draft"</strong>, lalu
                                        klik tombol <strong>Simpan</strong>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-admin.ui.card>
</div>
