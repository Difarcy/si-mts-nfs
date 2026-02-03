<section class="py-12 md:py-20 bg-gray-50 scroll-mt-20" id="jadwal">
    <div class="container mx-auto px-4">
        <div class="text-center mb-10 md:mb-16 scroll-animate">
            <div
                class="inline-block bg-green-700 text-white font-black text-lg sm:text-2xl md:text-2xl px-6 md:px-10 py-2.5 md:py-3 transform -skew-x-12 uppercase shadow-lg mb-2">
                Alur & Jadwal Pendaftaran
            </div>
            <p class="text-black mt-4 max-w-2xl mx-auto text-xs md:text-base font-normal">Ikuti langkah-langkah berikut
                untuk melakukan pendaftaran siswa baru di
                {{ $globalSchoolProfile?->nama_sekolah ?? 'MTs Nurul Falaah' }}.
            </p>
        </div>

        @php
            $waveConfigs = [
                1 => [
                    'roman' => 'I',
                    'title' => 'Gelombang I',
                    'accent' => 'green',
                    'label' => 'JALUR UNGGULAN & PRESTASI',
                ],
                2 => [
                    'roman' => 'II',
                    'title' => 'Gelombang II',
                    'accent' => 'amber',
                    'label' => 'JALUR REGULER',
                ],
            ];

            $stages = [1, 2, 3, 4, 5];

            $formatDate = function ($date) {
                try {
                    return \Carbon\Carbon::parse($date)->format('d/m/Y');
                } catch (\Throwable $e) {
                    return null;
                }
            };
        @endphp

        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 md:gap-16">
                @foreach($waveConfigs as $wave => $cfg)
                    @php
                        $accent = $cfg['accent'];
                        $timelineLine = $accent === 'green' ? 'before:bg-green-100' : 'before:bg-amber-100';
                        $badgeBg = $accent === 'green' ? 'bg-green-50 text-green-700 border-green-100' : 'bg-amber-50 text-amber-700 border-amber-100';
                        $stepBorder = $accent === 'green' ? 'border-green-600 group-hover:bg-green-600' : 'border-amber-500 group-hover:bg-amber-500';
                        $stepText = $accent === 'green' ? 'text-green-700' : 'text-amber-600';
                        $stepRing = $accent === 'green' ? 'ring-green-100 bg-green-700' : 'ring-amber-100 bg-amber-500';
                    @endphp

                    <div class="{{ $wave === 2 ? 'mt-8 lg:mt-0' : '' }}">
                        <div class="flex items-center gap-3 md:gap-4 mb-8 md:mb-10">
                            <div
                                class="w-10 h-10 md:w-14 md:h-14 {{ $stepRing }} text-white rounded-xl md:rounded-2xl flex items-center justify-center font-black text-lg md:text-2xl shadow-lg md:shadow-xl ring-4">
                                {{ $cfg['roman'] }}
                            </div>
                            <div>
                                <h3 class="text-lg md:text-2xl font-black text-gray-800 uppercase leading-none">{{ $cfg['title'] }}</h3>
                                <p class="{{ $accent === 'green' ? 'text-green-600' : 'text-amber-600' }} text-[9px] md:text-sm font-bold tracking-[0.1em] md:tracking-[0.2em] mt-1">
                                    {{ $cfg['label'] }}
                                </p>
                            </div>
                        </div>

                        <div class="space-y-0 relative before:absolute before:inset-0 before:ml-[19px] md:before:ml-[27px] before:w-0.5 {{ $timelineLine }} before:pointer-events-none">
                            @foreach($stages as $stage)
                                @php
                                    $nmKey = "g{$wave}t{$stage}nm";
                                    $stKey = "g{$wave}t{$stage}st";
                                    $enKey = "g{$wave}t{$stage}en";

                                    $nm = $spmb?->{$nmKey};
                                    $st = $spmb?->{$stKey};
                                    $en = $spmb?->{$enKey};

                                    $nmText = $nm ? $nm : 'Belum ada';
                                    $stText = $st ? $formatDate($st) : null;
                                    $enText = $en ? $formatDate($en) : null;
                                    $dateText = ($stText && $enText)
                                        ? ($stText . ' - ' . $enText)
                                        : (($stText || $enText) ? ($stText ?? $enText) : 'Belum diatur');
                                @endphp

                                <div class="relative flex gap-5 md:gap-8 {{ $stage === 5 ? '' : 'pb-8 md:pb-10' }} group">
                                    <div
                                        class="shrink-0 w-10 h-10 md:w-14 md:h-14 bg-white border-2 {{ $stepBorder }} rounded-xl md:rounded-2xl flex items-center justify-center relative z-10 transition-all group-hover:text-white shadow-sm">
                                        <span class="font-black {{ $accent === 'green' ? 'group-hover:text-white' : 'group-hover:text-white' }} text-sm md:text-lg">{{ $stage }}</span>
                                    </div>
                                    <div class="pt-0.5 md:pt-1">
                                        <p class="text-[9px] md:text-[10px] font-black {{ $stepText }} uppercase tracking-widest mb-1">Tahap {{ $stage }}</p>
                                        <h4 class="text-base md:text-lg font-bold text-gray-900 mb-2 leading-tight">{{ $nmText }}</h4>
                                        <span class="inline-block px-2.5 py-0.5 md:px-3 md:py-1 {{ $badgeBg }} rounded-full text-[10px] md:text-xs font-bold border">
                                            {{ $dateText }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
