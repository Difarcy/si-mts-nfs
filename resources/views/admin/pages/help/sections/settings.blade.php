<div id="pengaturan" class="scroll-mt-24">
    <x-admin.ui.card>
        <x-slot:header>
            <div class="flex items-center gap-3">
                <div class="p-2 bg-gray-100 text-gray-700 rounded-lg shrink-0">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                        </path>
                    </svg>
                </div>
                <h2 class="text-[13px] sm:text-base font-bold text-black tracking-widest leading-none">Pengaturan</h2>
            </div>
        </x-slot:header>
        <div class="p-6 sm:p-8 space-y-16">
            {{-- Intro --}}
            <div class="max-w-4xl">
                <p
                    class="text-[11px] sm:text-sm text-black leading-relaxed italic border-l-4 border-gray-500 pl-4 py-1">
                    Modul Pengaturan adalah pusat kendali identitas visual dan informasi kontak sekolah. Di sini
                    Administrator dapat mengelola logo, banner, hero section, dan tautan media sosial yang akan
                    ditampilkan di website.
                </p>
            </div>

            {{-- 1. LOGO --}}
            <div class="space-y-6">
                <div class="border-b border-black/10 pb-4">
                    <h3 class="text-[13px] sm:text-base font-bold text-black tracking-tight">Logo Sekolah</h3>
                </div>
                <div class="space-y-6">
                    <div class="space-y-2">
                        <p class="text-[13px] sm:text-base font-bold text-black tracking-tight">Fungsi & Kegunaan</p>
                    <p class="text-[11px] sm:text-sm text-black leading-relaxed">Mengelola logo resmi sekolah yang
                        akan ditampilkan di header dan footer website, serta berbagai elemen visual lainnya.</p>
                    </div>
                    <div class="p-6 bg-gray-100 border border-black/10 rounded-2xl space-y-6">
                        <p class="text-[13px] sm:text-base font-bold text-black">Instruksi Penggunaan</p>
                        <div class="space-y-6 text-[11px] sm:text-sm text-black">
                            <div class="flex gap-4">
                                <span class="w-2 h-2 rounded-full bg-black mt-2 shrink-0"></span>
                                <div>
                                    <p class="font-bold mb-1">Akses Menu:</p>
                                    <p>Buka <strong>Pengaturan > Logo</strong>. Anda akan melihat area upload dan
                                        preview logo saat ini.</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <span class="w-2 h-2 rounded-full bg-black mt-2 shrink-0"></span>
                                <div>
                                    <p class="font-bold mb-1">Upload Logo:</p>
                                    <p>Klik area upload atau seret file logo (format gambar). Disarankan menggunakan
                                        logo dengan background transparan (PNG) agar hasil terlihat rapi.</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <span class="w-2 h-2 rounded-full bg-black mt-2 shrink-0"></span>
                                <div>
                                    <p class="font-bold mb-1">Simpan:</p>
                                    <p>Klik tombol <strong>"Simpan"</strong> untuk menerapkan logo baru. Tombol akan
                                        aktif setelah ada perubahan pada form.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 2. BANNER & HERO --}}
            <div class="space-y-6">
                <div class="border-b border-black/10 pb-4">
                    <h3 class="text-[13px] sm:text-base font-bold text-black tracking-tight">Banner & Hero Section</h3>
                </div>
                <div class="space-y-6">
                    <div class="space-y-2">
                        <p class="text-[13px] sm:text-base font-bold text-black tracking-tight">Fungsi & Kegunaan</p>
                        <p class="text-[11px] sm:text-sm text-black leading-relaxed">Mengelola gambar banner utama
                            halaman depan dan teks hero (tagline, judul, deskripsi, tombol) yang muncul di atas banner.
                        </p>
                    </div>
                    <div class="p-6 bg-gray-100 border border-black/10 rounded-2xl space-y-6">
                        <p class="text-[13px] sm:text-base font-bold text-black">Instruksi Penggunaan</p>
                        <div class="space-y-6 text-[11px] sm:text-sm text-black">
                            <div class="flex gap-4">
                                <span class="w-2 h-2 rounded-full bg-black mt-2 shrink-0"></span>
                                <div>
                                    <p class="font-bold mb-1">Banner Utama:</p>
                                    <p>Buka <strong>Pengaturan > Banner</strong>. Upload hingga <strong>6 gambar</strong>
                                        dan geser gambar untuk mengubah urutan tampilan slider.</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <span class="w-2 h-2 rounded-full bg-black mt-2 shrink-0"></span>
                                <div>
                                    <p class="font-bold mb-1">Hero Section:</p>
                                    <p>Buka <strong>Pengaturan > Hero</strong>. Isi tagline, judul, deskripsi, dan
                                        tombol CTA. Centang elemen yang ingin ditampilkan
                                        (Logo/Tagline/Judul/Deskripsi/Tombol).</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <span class="w-2 h-2 rounded-full bg-black mt-2 shrink-0"></span>
                                <div>
                                    <p class="font-bold mb-1">Banner Promosi:</p>
                                    <p>Untuk banner khusus PPDB atau event, gunakan menu <strong>Pengaturan > Banner
                                            Promosi</strong>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 3. KONTAK --}}
            <div class="space-y-6">
                <div class="border-b border-black/10 pb-4">
                    <h3 class="text-[13px] sm:text-base font-bold text-black tracking-tight">Kontak Sekolah</h3>
                </div>
                <div class="space-y-6">
                    <div class="space-y-2">
                        <p class="text-[13px] sm:text-base font-bold text-black tracking-tight">Fungsi & Kegunaan</p>
                        <p class="text-[11px] sm:text-sm text-black leading-relaxed">Mengelola informasi kontak sekolah
                            termasuk nomor WhatsApp, nomor telepon, email, koordinat Maps, dan alamat lengkap.</p>
                    </div>
                    <div class="p-6 bg-gray-100 border border-black/10 rounded-2xl space-y-6">
                        <p class="text-[13px] sm:text-base font-bold text-black">Instruksi Penggunaan</p>
                        <div class="space-y-6 text-[11px] sm:text-sm text-black">
                            <div class="flex gap-4">
                                <span class="w-2 h-2 rounded-full bg-black mt-2 shrink-0"></span>
                                <div>
                                    <p class="font-bold mb-1">Akses Menu:</p>
                                    <p>Buka <strong>Pengaturan > Kontak</strong>. Isi informasi yang ingin ditampilkan
                                        pada website (WhatsApp, Email, Telepon, Koordinat Maps, Alamat, dan Deskripsi
                                        Footer).</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <span class="w-2 h-2 rounded-full bg-black mt-2 shrink-0"></span>
                                <div>
                                    <p class="font-bold mb-1">WhatsApp & Telepon:</p>
                                    <p>Masukkan nomor WhatsApp untuk kontak cepat dan nomor telepon kantor. Format:
                                        0812-xxxx-xxxx</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <span class="w-2 h-2 rounded-full bg-black mt-2 shrink-0"></span>
                                <div>
                                    <p class="font-bold mb-1">Koordinat Maps:</p>
                                    <p>Isi koordinat lokasi sekolah dalam format Latitude, Longitude (contoh: -7.025253,
                                        107.519760) untuk integrasi Google Maps.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 4. SOCIAL MEDIA --}}
            <div class="space-y-6">
                <div class="border-b border-black/10 pb-4">
                    <h3 class="text-[13px] sm:text-base font-bold text-black tracking-tight">Social Media</h3>
                </div>
                <div class="space-y-6">
                    <div class="space-y-2">
                        <p class="text-[13px] sm:text-base font-bold text-black tracking-tight">Fungsi & Kegunaan</p>
                        <p class="text-[11px] sm:text-sm text-black leading-relaxed">Menghubungkan website dengan akun
                            media sosial resmi sekolah (Facebook, Instagram, YouTube, Twitter/X, TikTok).</p>
                    </div>
                    <div class="p-6 bg-gray-100 border border-black/10 rounded-2xl space-y-6">
                        <p class="text-[13px] sm:text-base font-bold text-black">Instruksi Penggunaan</p>
                        <div class="space-y-6 text-[11px] sm:text-sm text-black">
                            <div class="flex gap-4">
                                <span class="w-2 h-2 rounded-full bg-black mt-2 shrink-0"></span>
                                <div>
                                    <p class="font-bold mb-1">Akses Menu:</p>
                                    <p>Buka <strong>Pengaturan > Social Media</strong>. Anda akan melihat 5 field input
                                        dengan icon platform masing-masing.</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <span class="w-2 h-2 rounded-full bg-black mt-2 shrink-0"></span>
                                <div>
                                    <p class="font-bold mb-1">Input Link:</p>
                                    <p>Masukkan URL lengkap profil media sosial (contoh:
                                        https://instagram.com/namasekolah). Pastikan menggunakan
                                        <strong>"https://"</strong> di awal URL.</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <span class="w-2 h-2 rounded-full bg-black mt-2 shrink-0"></span>
                                <div>
                                    <p class="font-bold mb-1">Simpan:</p>
                                    <p>Klik tombol <strong>"Simpan"</strong> untuk menerapkan tautan. Jika sebuah
                                        field dibiarkan kosong, ikon/link terkait tidak akan ditampilkan pada website.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-admin.ui.card>
</div>
