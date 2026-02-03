@extends('website.layouts.full')

@section('title', 'Video')

@section('content')
    <div class="space-y-6 pt-4 sm:pt-6">
        <!-- Breadcrumb -->
        <x-website.components.layout.breadcrumb :items="[['label' => 'GALERI'], ['label' => 'VIDEO']]" />

        <!-- Header Section -->
        <div class="flex items-center justify-between gap-4 mb-6">
            <x-website.components.layout.page-title title="Video" margin="mb-0" />
            <x-website.components.ui.pagination-toolbar :items="$videos" class="shrink-0" />
        </div>

        <div class="w-full space-y-4 @if(isset($videos) && $videos->count() > 0) min-h-[600px] lg:min-h-[800px] @endif">
            @if(isset($videos) && $videos->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">
                    @foreach($videos as $video)
                        <div class="bg-white rounded-lg overflow-hidden hover:shadow-md transition-all group relative flex flex-col h-full">
                            <div class="relative aspect-video overflow-hidden shrink-0 cursor-pointer"
                                data-video-preview
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

                            <div class="p-4 flex flex-col flex-grow min-h-[140px]">
                                <div class="flex-grow space-y-1">
                                    <h4 class="text-[14px] sm:text-[16px] font-bold text-black line-clamp-2 leading-tight h-[2.6em] text-justify group-hover:text-green-700 transition-colors">
                                        {{ $video->judul }}
                                    </h4>

                                    <div class="flex items-center gap-2 text-[10px] sm:text-[11px] text-slate-900 font-medium pb-1">
                                        <div class="flex items-center gap-1">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            <span>{{ $video->tanggal_publikasi ? $video->tanggal_publikasi->format('d/m/Y') : '-' }}</span>
                                        </div>
                                    </div>

                                    <p class="text-[11px] sm:text-[12px] text-slate-900 line-clamp-3 leading-relaxed text-justify">
                                        {{ Str::limit(strip_tags($video->deskripsi), 120) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
            @else
                <div class="h-full flex items-center justify-center">
                    <div class="col-span-full flex items-center justify-center py-20 text-center">
                        <p class="text-xs sm:text-base font-semibold text-slate-900 tracking-wider">Belum Ada Video Kegiatan</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
