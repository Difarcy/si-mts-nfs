<div class="animate-on-scroll">
    <x-website.components.layout.page-title title="Prestasi Siswa" margin="mb-6" />
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        @if(isset($prestasiSiswa) && $prestasiSiswa->count() > 0)
            @foreach($prestasiSiswa->take(4) as $item)
                <a href="{{ route('web.achievement.detail', $item) }}"
                    class="group relative block w-full aspect-square overflow-hidden bg-gray-900">
                    <img src="{{ $item->foto_siswa ? asset('storage/' . $item->foto_siswa) : asset('images/background/default-backgrounds.png') }}"
                        alt="{{ $item->nama_lomba }}" class="absolute inset-0 w-full h-full object-cover" loading="lazy">
                    <div
                        class="absolute inset-0 bg-linear-to-t from-black/90 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>
                    <div
                        class="absolute inset-0 flex flex-col justify-end p-5 z-10 opacity-0 translate-y-8 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 ease-out">
                        <div class="mb-2">
                            <x-website.components.ui.badge :variant="strtolower($item->peringkat)">
                                {{ $item->peringkat ?? 'Prestasi' }}
                            </x-website.components.ui.badge>
                        </div>
                        <h3
                            class="text-sm sm:text-lg font-bold leading-tight mb-1 line-clamp-2 drop-shadow-md text-white group-hover:text-green-400 transition-colors">
                            {{ $item->nama_lomba }}
                        </h3>
                        <p class="text-[10px] sm:text-sm font-medium text-gray-200 truncate drop-shadow-sm">
                            {{ $item->nama_siswa }} {{ $item->kelas ? '(' . $item->kelas . ')' : '' }}
                        </p>
                    </div>
                </a>
            @endforeach
        @else
            <div class="col-span-full flex items-center justify-center py-12">
                <p class="text-[11px] sm:text-base font-semibold text-slate-900 text-center tracking-wider">Belum Ada
                    Prestasi</p>
            </div>
        @endif
    </div>
    <div class="mt-6 text-center">
        <a href="{{ route('web.achievement') }}"
            class="inline-flex items-center gap-2 text-green-700 hover:text-green-800 font-semibold text-[10px] sm:text-sm transition-colors duration-300 group">
            Lihat Semua Prestasi
            <svg xmlns="http://www.w3.org/2000/svg"
                class="h-3 w-3 sm:h-4 sm:w-4 group-hover:translate-x-1 transition-transform duration-300" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </a>
    </div>
</div>