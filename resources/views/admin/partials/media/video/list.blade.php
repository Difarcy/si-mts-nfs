@if($videos->count() > 0)
    <div class="p-4 sm:p-6">
        <x-admin.ui.grid cols="grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($videos as $video)
                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition-all group relative flex flex-col h-full"
                    data-admin-item="grid" data-id="{{ $video->id }}" data-status="{{ $video->status }}"
                    data-title="{{ $video->judul }}" data-search="{{ $video->judul }} {{ strip_tags($video->deskripsi) }}">
                    <div class="relative aspect-video overflow-hidden shrink-0" style="margin: -1px; width: calc(100% + 2px);">
                        <div class="absolute inset-0" data-video-preview
                            data-video-youtube-id="{{ $video->youtube_id }}"
                            data-video-thumb="{{ $video->youtube_thumbnail_url }}"
                            data-video-link="{{ $video->link }}">
                            <div class="absolute inset-0" data-video-preview-media>
                                @if($video->youtube_thumbnail_url)
                                    <img src="{{ $video->youtube_thumbnail_url }}" alt="Thumbnail" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                                        <svg class="w-12 h-12 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif

                                {{-- Play Button Overlay --}}
                                <div class="absolute inset-0 flex items-center justify-center pointer-events-none z-10 transition-opacity duration-300" data-play-button>
                                    <svg class="w-12 h-12 sm:w-16 sm:h-16 drop-shadow-lg transition-transform duration-300 group-hover:scale-110" viewBox="0 0 68 48" version="1.1">
                                        <path class="text-[#FF0000] opacity-90 group-hover:opacity-100 transition-opacity duration-300" fill="currentColor" d="M66.52,7.74c-0.78-2.93-2.49-5.41-5.42-6.19C55.79,.13,34,0,34,0S12.21,.13,6.9,1.55 C3.97,2.33,2.27,4.81,1.48,7.74C0.06,13.05,0,24,0,24s0.06,10.95,1.48,16.26c0.78,2.93,2.49,5.41,5.42,6.19 C12.21,47.87,34,48,34,48s21.79-0.13,27.1-1.55c2.93-0.78,4.64-3.26,5.42-6.19C67.94,34.95,68,24,68,24S67.94,13.05,66.52,7.74z"></path>
                                        <path fill="#FFFFFF" d="M 45,24 27,14 27,34"></path>
                                    </svg>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="p-5 flex flex-col flex-grow min-h-[180px]">
                        <div class="mb-3 flex flex-wrap gap-1.5">
                            <x-admin.ui.badge :variant="$video->status" class="!px-2 !py-0.5 text-[9px] font-bold">
                                {{ ucfirst($video->status) }}
                            </x-admin.ui.badge>
                        </div>

                        <div class="flex-grow space-y-1.5">
                            <h4
                                class="text-[12px] sm:text-[15px] font-bold text-black line-clamp-2 leading-tight h-[2.6em] text-justify">
                                {{ $video->judul }}
                            </h4>
                            <p class="text-[10px] sm:text-[11px] text-slate-900 line-clamp-3 leading-relaxed mt-2 text-justify">
                                {{ Str::limit(strip_tags($video->deskripsi), 150) }}
                            </p>
                        </div>

                        <div class="mt-4 flex items-center justify-between gap-2">
                            <div class="flex items-center gap-2 text-[9px] sm:text-[11px] text-black font-medium">
                                <div class="flex items-center gap-1">
                                    <svg class="w-2.5 h-2.5 sm:w-3.5 sm:h-3.5 text-black" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <span>{{ $video->tanggal_publikasi ? $video->tanggal_publikasi->format('m/d/Y') : '-' }}</span>
                                </div>
                                <div class="w-[1px] h-2.5 bg-black"></div>
                                <div class="flex items-center gap-1">
                                    <svg class="w-2.5 h-2.5 sm:w-3.5 sm:h-3.5 text-black" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>{{ $video->status === 'draft' ? '-' : ($video->tanggal_publikasi ? $video->tanggal_publikasi->format('H:i') : '-') }}</span>
                                </div>
                            </div>

                            <div class="flex gap-1 sm:gap-1.5">
                                <x-admin.form.button variant="edit" href="{{ route('admin.media.video.edit', $video->id) }}"
                                    class="!p-1.5 sm:!p-2" title="Ubah">
                                    <x-slot:icon>
                                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </x-slot:icon>
                                </x-admin.form.button>

                                <x-admin.form.button variant="delete" class="!p-1.5 sm:!p-2" title="Hapus" data-video-delete
                                    data-video-id="{{ $video->id }}" data-video-title="{{ $video->judul }}">
                                    <x-slot:icon>
                                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </x-slot:icon>
                                </x-admin.form.button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </x-admin.ui.grid>
    </div>
@else
    @php
        $hasSearch = request()->filled('search');
        $hasFilter = request()->filled('status') || request()->filled('sort');
    @endphp

    @if($hasSearch && $hasFilter)
        <div class="min-h-[300px] sm:min-h-[360px] flex flex-col items-center justify-center text-center">
            <svg class="w-24 h-24 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
            </svg>
            <p class="text-sm font-semibold text-black mb-1">Data tidak ditemukan.</p>
            <p class="text-sm text-black mb-6 max-w-xs">Tidak ada video yang cocok dengan pencarian
                "{{ request('search') }}" dan filter yang dipilih.</p>
        </div>
    @elseif($hasSearch)
        <div class="min-h-[300px] sm:min-h-[360px] flex flex-col items-center justify-center text-center">
            <svg class="w-24 h-24 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
            </svg>
            <p class="text-sm font-semibold text-black mb-1">Hasil pencarian tidak ditemukan.</p>
            <p class="text-sm text-black/60 mb-6 max-w-xs">Tidak ada video yang sesuai dengan pencarian
                "{{ request('search') }}".</p>
        </div>
    @elseif($hasFilter)
        <div class="min-h-[300px] sm:min-h-[360px] flex flex-col items-center justify-center text-center">
            <svg class="w-24 h-24 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
            </svg>
            <p class="text-sm text-black/60 mb-1">Tidak ada video yang sesuai filter.</p>
            <p class="text-xs text-black/50">Coba ubah kata kunci atau reset filter.</p>
        </div>
    @else
        <div class="min-h-[300px] sm:min-h-[360px] flex flex-col items-center justify-center text-center">
            <svg class="w-24 h-24 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
            </svg>
            <p class="text-sm text-black mb-6 max-w-xs">Mulai kelola koleksi video dokumentasi sekolah Anda dengan
                menambahkan video pertama.</p>

            <x-admin.form.button variant="add" href="{{ route('admin.media.video.create') }}" data-action="add-video">
                <x-slot:icon>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </x-slot:icon>
                Tambah Video Pertama
            </x-admin.form.button>
        </div>
    @endif
@endif
