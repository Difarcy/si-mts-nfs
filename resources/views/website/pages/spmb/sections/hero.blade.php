<!-- Hero Section (Updated to match Home Hero Height & Mobile Style) -->
<section
    class="relative w-full h-64 sm:h-112 md:h-128 lg:h-144 bg-linear-to-br from-green-900 via-green-800 to-green-700 overflow-hidden shadow-2xl flex items-end sm:items-center justify-start sm:justify-center pb-8 sm:pb-0">
    <!-- Pattern Overlay -->
    <div class="absolute inset-0 opacity-10"
        style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');">
    </div>

    <div class="container mx-auto px-6 sm:px-4 relative z-10 text-left sm:text-center">
        @php
            $defaultYear = now()->year . '/' . (now()->year + 1);
            $year = $spmb?->tahun ?: $defaultYear;
        @endphp
        <div
            class="inline-block py-1 px-4 sm:py-2 sm:px-6 rounded-full bg-green-600 text-white font-black text-[10px] sm:text-lg mb-3 sm:mb-6 shadow-xl transform -rotate-1">
            Sistem Penerimaan Murid Baru {{ $year }}
        </div>
        <h1
            class="text-xl sm:text-5xl lg:text-6xl font-black text-white mb-2 sm:mb-6 tracking-tight leading-tight drop-shadow-md">
            {{ $globalSchoolProfile?->nama_sekolah ?? 'MTs Nurul Falaah Soreang' }}
        </h1>
        <p class="text-xs sm:text-xl text-white max-w-2xl sm:mx-auto font-medium leading-relaxed mb-6 sm:mb-0">
            {{ $setting?->hero_slogan ?? 'Wujudkan masa depan gemilang bersama kami. Mari bergabung dalam ekosistem pendidikan terbaik untuk mencetak generasi cerdas, religius, dan berkarakter unggul!' }}
        </p>

        <div class="mt-4 sm:mt-10 flex justify-start sm:justify-center gap-3 sm:gap-4">
            <a href="#jadwal"
                class="px-3.5 py-1 sm:px-8 sm:py-2 rounded-md bg-white text-green-700 font-bold shadow-lg hover:shadow-xl hover:-translate-y-0.5 transform transition-all duration-300 text-[10px] sm:text-base">
                Lihat Jadwal
            </a>
            @php
                $waCandidate = $kontak?->whatsapp ?: ((isset($setting) && $setting?->contact_wa) ? $setting->contact_wa : null);
                $waRaw = preg_replace('/[^0-9]/', '', (string) $waCandidate);
                $waBase = preg_replace('/^62|^0/', '', $waRaw);
                $waLink = $waBase ? ('62' . $waBase) : null;
            @endphp
            @if($waLink)
                <a href="https://wa.me/{{ $waLink }}" target="_blank" title="Chat on WhatsApp"
                    class="px-3.5 py-1 sm:px-8 sm:py-2 rounded-md bg-green-700 hover:bg-green-800 text-white font-bold shadow-lg hover:shadow-xl hover:-translate-y-0.5 transform transition-all duration-300 flex items-center gap-2 text-[10px] sm:text-base">
                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                </svg>
                Hubungi Kami
                </a>
            @else
                <button type="button" disabled title="Nomor WhatsApp belum tersedia"
                    class="px-3.5 py-1 sm:px-8 sm:py-2 rounded-md bg-gray-400 text-white font-bold shadow-lg flex items-center gap-2 text-[10px] sm:text-base cursor-not-allowed opacity-80">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                    </svg>
                    Hubungi Kami
                </button>
            @endif
        </div>
    </div>
</section>
