<!-- SYARAT PENDAFTARAN -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-10 scroll-animate">
            <div
                class="inline-block bg-green-700 text-white font-black text-lg sm:text-2xl md:text-2xl px-6 md:px-10 py-2.5 md:py-3 transform -skew-x-12 uppercase shadow-lg mb-2">
                SYARAT PENDAFTARAN
            </div>
        </div>

        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 md:gap-4">
                @php
                    $requirements = [
                        "Mengisi formulir pendaftaran",
                        "Fotocopy Ijazah SD/MI (3 Lembar)",
                        "Fotocopy Kartu Keluarga (3 Lembar)",
                        "Fotocopy KTP Orang Tua (3 Lembar)",
                        "Fotocopy Akte Kelahiran (3 Lembar)",
                        "Fotocopy Kartu NISN (3 Lembar)",
                        "Surat Kelulusan dan SKKB asli",
                        "Fotocopy Kartu KIP 3 lembar (jika punya)",
                        "Surat Keterangan Tidak Mampu (jika ada)",
                        "Pas Foto ukuran 2x3 dan 3x4 (3 lembar)"
                    ];
                @endphp

                @foreach($requirements as $index => $req)
                    <div class="group bg-green-50 p-3.5 md:p-4 rounded-xl shadow-sm flex items-center gap-3 md:gap-4 hover:bg-green-700 transition-all duration-300 scroll-animate"
                        style="animation-delay: {{ ($index % 2) * 0.1 }}s">
                        <div
                            class="shrink-0 w-7 h-7 md:w-8 md:h-8 bg-yellow-400 text-white rounded-lg flex items-center justify-center font-black text-[10px] md:text-sm shadow-sm transition-transform group-hover:scale-110">
                            {{ $index + 1 }}
                        </div>
                        <span
                            class="text-xs md:text-base text-black group-hover:text-white font-medium transition-colors font-inter">{{ $req }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Alert Pendaftaran Offline -->
        <div
            class="max-w-6xl mx-auto mt-8 bg-gray-50 p-5 md:p-6 rounded-2xl shadow-sm flex flex-col sm:flex-row gap-4 items-center sm:items-start border border-gray-200">
            <div class="shrink-0 w-12 h-12 bg-amber-100 text-amber-600 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="text-center sm:text-left">
                <h3 class="font-bold text-gray-900 text-base md:text-lg">Pendaftaran Offline</h3>
                <p class="text-black text-xs md:text-base leading-relaxed font-inter">Saat ini pendaftaran dilakukan
                    secara langsung
                    (offline). Silakan datang ke sekretariat pendaftaran di sekolah dengan membawa persyaratan
                    lengkap di atas.</p>
            </div>
        </div>
    </div>
</section>