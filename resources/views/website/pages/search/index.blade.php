@extends('website.layouts.main')

@section('title', 'Pencarian')

@section('content')
    <div class="space-y-6 pt-4 sm:pt-6">
        <x-website.components.layout.breadcrumb :items="[['label' => 'PENCARIAN']]" />

        <x-website.components.layout.page-title title="Hasil Pencarian" />

        <div class="w-full space-y-4">
            <x-website.components.ui.search-bar :action="route('web.search')" placeholder="Cari informasi..." />

            @if(($q ?? '') !== '')
                <p class="text-xs sm:text-sm text-slate-900 font-lato">
                    Kata kunci: <span class="font-bold text-black">{{ $q }}</span>
                </p>
            @endif

            @if(($q ?? '') === '')
                <div class="flex flex-col items-center justify-center min-h-[240px] text-center w-full">
                    <p class="text-[11px] sm:text-base font-semibold text-gray-400 tracking-wider">Belum ada</p>
                </div>
            @else
                @php
                    $hasAny = (isset($newsResults) && $newsResults->count() > 0)
                        || (isset($articleResults) && $articleResults->count() > 0)
                        || (isset($announcementResults) && $announcementResults->count() > 0)
                        || (isset($agendaResults) && $agendaResults->count() > 0);
                    $fallbackImages = ['img/banner1.jpg', 'img/banner2.jpg', 'img/banner3.jpg'];
                @endphp

                @if(!$hasAny)
                    <div class="flex flex-col items-center justify-center min-h-[240px] text-center w-full">
                        <p class="text-[11px] sm:text-base font-semibold text-gray-400 tracking-wider">Hasil tidak ditemukan</p>
                        <p class="text-[10px] sm:text-sm text-slate-900 mt-2">Coba gunakan kata kunci yang berbeda.</p>
                    </div>
                @else
                    <div class="space-y-8">
                        <div class="space-y-4">
                            <h3 class="text-sm sm:text-base font-bold text-gray-900 font-roboto-slab">Berita</h3>

                            @if(isset($newsResults) && $newsResults->count() > 0)
                                <div class="space-y-4 sm:space-y-5">
                                    @foreach($newsResults as $index => $post)
                                        @php
                                            $image = $post->thumbnail
                                                ? asset('storage/' . $post->thumbnail)
                                                : asset($fallbackImages[$index % count($fallbackImages)]);
                                            $dateObj = $post->tanggal_publikasi ?? now();
                                            $date = \Carbon\Carbon::parse($dateObj)->translatedFormat('d F Y');
                                            $time = \Carbon\Carbon::parse($dateObj)->format('H:i');
                                            $excerpt = Str::limit(strip_tags((string) $post->deskripsi), 150);
                                        @endphp
                                        <article class="bg-white shadow-sm overflow-hidden border border-gray-100 hover:shadow-lg transition-all duration-300 flex flex-col sm:flex-row group">
                                            <a href="{{ route('web.news.detail', $post->id) }}" class="relative w-full sm:w-[38%] shrink-0">
                                                <div class="w-full aspect-video bg-gray-50 overflow-hidden">
                                                    <img src="{{ $image }}" alt="{{ $post->judul ?? 'Berita' }}"
                                                        class="w-full h-full object-cover js-img-fallback" loading="lazy"
                                                        data-fallback-src="{{ asset('images/background/default-backgrounds.png') }}">
                                                </div>
                                            </a>
                                            <div class="w-full sm:w-[62%] p-2 sm:p-2.5 flex flex-col justify-between">
                                                <div>
                                                    <h3 class="text-sm sm:text-xl font-bold text-black mb-0.5 line-clamp-2 hover:text-green-700 transition-colors font-roboto-slab">
                                                        <a href="{{ route('web.news.detail', $post->id) }}" class="hover:text-green-700 transition-colors">
                                                            {{ $post->judul ?? 'Judul Berita' }}
                                                        </a>
                                                    </h3>
                                                    <a href="{{ route('web.news.detail', $post->id) }}"
                                                        class="text-xs sm:text-base text-slate-900 line-clamp-2 mb-1 text-justify font-lato hover:text-black transition-colors block">
                                                        {{ $excerpt }}
                                                    </a>
                                                </div>
                                                <div class="flex items-center justify-between mt-auto">
                                                    <p class="text-xs sm:text-sm text-slate-900 font-lato">
                                                        <span class="inline-flex items-center gap-2">
                                                            <span>{{ $date }}</span>
                                                            <span aria-hidden="true" style="display:inline-block;width:1px;height:10px;background:rgba(0,0,0,1);vertical-align:middle;"></span>
                                                            <span>{{ $time }}</span>
                                                        </span>
                                                    </p>
                                                    <a href="{{ route('web.news.detail', $post->id) }}"
                                                        class="inline-flex items-center gap-1.5 text-green-700 hover:text-green-800 font-bold text-xs sm:text-sm transition-colors duration-300 group">
                                                        Baca Berita
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 sm:h-4 sm:w-4 group-hover:translate-x-1 transition-transform duration-300"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </article>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-xs sm:text-sm text-slate-900">Tidak ada berita yang sesuai.</p>
                            @endif
                        </div>

                        <div class="space-y-4">
                            <h3 class="text-sm sm:text-base font-bold text-gray-900 font-roboto-slab">Artikel</h3>

                            @if(isset($articleResults) && $articleResults->count() > 0)
                                <div class="space-y-4 sm:space-y-5">
                                    @foreach($articleResults as $index => $post)
                                        @php
                                            $image = ($post->thumbnail ?? null)
                                                ? asset('storage/' . $post->thumbnail)
                                                : asset($fallbackImages[$index % count($fallbackImages)]);
                                            $dateObj = $post->tanggal_publikasi ?? $post->created_at ?? now();
                                            $date = \Carbon\Carbon::parse($dateObj)->translatedFormat('d F Y');
                                            $time = \Carbon\Carbon::parse($dateObj)->format('H:i');
                                            $excerpt = Str::limit(strip_tags((string) $post->deskripsi), 150);
                                        @endphp
                                        <article class="bg-white shadow-sm overflow-hidden border border-gray-100 hover:shadow-lg transition-all duration-300 flex flex-col sm:flex-row group">
                                            <a href="{{ route('web.article.detail', $post->id) }}" class="relative w-full sm:w-[38%] shrink-0">
                                                <div class="w-full aspect-video bg-gray-50 overflow-hidden">
                                                    <img src="{{ $image }}" alt="{{ $post->judul ?? 'Artikel' }}"
                                                        class="w-full h-full object-cover js-img-fallback" loading="lazy"
                                                        data-fallback-src="{{ asset('images/background/default-backgrounds.png') }}">
                                                </div>
                                            </a>
                                            <div class="w-full sm:w-[62%] p-2 sm:p-2.5 flex flex-col justify-between">
                                                <div>
                                                    <h3 class="text-sm sm:text-xl font-bold text-black mb-0.5 line-clamp-2 hover:text-green-700 transition-colors font-roboto-slab">
                                                        <a href="{{ route('web.article.detail', $post->id) }}" class="hover:text-green-700 transition-colors">
                                                            {{ $post->judul ?? 'Judul Artikel' }}
                                                        </a>
                                                    </h3>
                                                    <a href="{{ route('web.article.detail', $post->id) }}"
                                                        class="text-xs sm:text-base text-slate-900 line-clamp-2 mb-1 text-justify font-lato hover:text-black transition-colors block">
                                                        {{ $excerpt }}
                                                    </a>
                                                </div>
                                                <div class="flex items-center justify-between mt-auto">
                                                    <p class="text-xs sm:text-sm text-slate-900 font-lato">
                                                        <span class="inline-flex items-center gap-2">
                                                            <span>{{ $date }}</span>
                                                            <span aria-hidden="true" style="display:inline-block;width:1px;height:10px;background:rgba(0,0,0,1);vertical-align:middle;"></span>
                                                            <span>{{ $time }}</span>
                                                        </span>
                                                    </p>
                                                    <a href="{{ route('web.article.detail', $post->id) }}"
                                                        class="inline-flex items-center gap-1.5 text-green-700 hover:text-green-800 font-bold text-xs sm:text-sm transition-colors duration-300 group">
                                                        Baca Artikel
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 sm:h-4 sm:w-4 group-hover:translate-x-1 transition-transform duration-300"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </article>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-xs sm:text-sm text-slate-900">Tidak ada artikel yang sesuai.</p>
                            @endif
                        </div>

                        <div class="space-y-4">
                            <h3 class="text-sm sm:text-base font-bold text-gray-900 font-roboto-slab">Pengumuman</h3>

                            @if(isset($announcementResults) && $announcementResults->count() > 0)
                                <div class="space-y-4 sm:space-y-5">
                                    @foreach($announcementResults as $item)
                                        @php
                                            $dateObj = $item->tanggal_publikasi ?? $item->created_at ?? now();
                                            $date = \Carbon\Carbon::parse($dateObj)->translatedFormat('d F Y');
                                            $time = \Carbon\Carbon::parse($dateObj)->format('H:i');
                                            $excerpt = Str::limit(strip_tags((string) $item->deskripsi), 250);
                                        @endphp
                                        <article class="bg-white shadow-sm overflow-hidden border border-gray-100 hover:shadow-lg transition-all duration-300 flex flex-col group p-4 sm:p-5 min-h-[180px]">
                                            <div class="flex flex-col justify-between h-full">
                                                <div>
                                                    <h3 class="text-sm sm:text-xl font-bold text-black mb-2 line-clamp-2 hover:text-green-700 transition-colors font-roboto-slab">
                                                        <a href="{{ route('web.announcement.detail', $item->id) }}" class="hover:text-green-700 transition-colors">
                                                            {{ $item->judul ?? 'Judul Pengumuman' }}
                                                        </a>
                                                    </h3>
                                                    <a href="{{ route('web.announcement.detail', $item->id) }}"
                                                        class="text-xs sm:text-base text-slate-900 line-clamp-2 mb-4 text-justify font-lato leading-relaxed hover:text-black transition-colors block">
                                                        {{ $excerpt }}
                                                    </a>
                                                </div>
                                                <div class="flex items-center justify-between mt-auto border-t border-gray-50 pt-3">
                                                    <p class="text-xs sm:text-sm text-slate-900 font-lato">
                                                        <span class="inline-flex items-center gap-2">
                                                            <span>{{ $date }}</span>
                                                            <span aria-hidden="true" style="display:inline-block;width:1px;height:10px;background:rgba(0,0,0,1);vertical-align:middle;"></span>
                                                            <span>{{ $time }}</span>
                                                        </span>
                                                    </p>
                                                    <a href="{{ route('web.announcement.detail', $item->id) }}"
                                                        class="inline-flex items-center gap-1.5 text-green-700 hover:text-green-800 font-bold text-xs sm:text-sm transition-colors duration-300 group">
                                                        Lihat Pengumuman
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 sm:h-4 sm:w-4 group-hover:translate-x-1 transition-transform duration-300"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </article>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-xs sm:text-sm text-slate-900">Tidak ada pengumuman yang sesuai.</p>
                            @endif
                        </div>

                        <div class="space-y-4">
                            <h3 class="text-sm sm:text-base font-bold text-gray-900 font-roboto-slab">Agenda</h3>

                            @if(isset($agendaResults) && $agendaResults->count() > 0)
                                <div class="space-y-4">
                                    @foreach($agendaResults as $item)
                                        <article class="bg-white shadow-sm overflow-hidden border border-gray-100 hover:shadow-lg transition-all duration-300 flex flex-col group p-4 sm:p-5 min-h-[180px]">
                                            <div class="flex flex-col justify-between h-full">
                                                <div>
                                                    <h3 class="text-sm sm:text-xl font-bold text-black mb-2 line-clamp-2 hover:text-green-700 transition-colors font-roboto-slab">
                                                        <a href="{{ route('web.agenda.detail', $item->id) }}" class="hover:text-green-700 transition-colors">
                                                            {{ $item->judul ?? 'Judul Agenda Kegiatan' }}
                                                        </a>
                                                    </h3>

                                                    <a href="{{ route('web.agenda.detail', $item->id) }}"
                                                        class="text-xs sm:text-base text-slate-900 line-clamp-2 mb-4 text-justify font-lato leading-relaxed hover:text-black transition-colors block">
                                                        {{ strip_tags($item->deskripsi ?? 'Detail deskripsi agenda belum tersedia untuk saat ini.') }}
                                                    </a>

                                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-4">
                                                        <div class="flex items-center gap-2 text-xs sm:text-sm text-slate-900">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                            </svg>
                                                            <span class="font-bold">Tanggal:</span>
                                                            <span class="text-xs sm:text-sm">
                                                                {{ isset($item->tanggal_mulai) ? \Carbon\Carbon::parse($item->tanggal_mulai)->format('d/m/Y') : '-' }}
                                                                @if(isset($item->tanggal_selesai))
                                                                    - {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d/m/Y') }}
                                                                @endif
                                                            </span>
                                                        </div>
                                                        <div class="flex items-center gap-2 text-xs sm:text-sm text-slate-900">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                            <span class="font-bold">Waktu:</span>
                                                            <span class="text-xs sm:text-sm">
                                                                @php
                                                                    $start = isset($item->waktu_mulai) ? \Carbon\Carbon::parse($item->waktu_mulai)->format('H.i') : '08.00';
                                                                    $end = isset($item->waktu_selesai) ? \Carbon\Carbon::parse($item->waktu_selesai)->format('H.i') : 'Selesai';
                                                                @endphp
                                                                {{ $start }} – {{ $end }} WIB
                                                            </span>
                                                        </div>
                                                        <div class="flex items-center gap-2 text-xs sm:text-sm text-slate-900 sm:col-span-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 0 1 6 0z" />
                                                            </svg>
                                                            <span class="font-bold">Lokasi:</span>
                                                            <span class="truncate text-xs sm:text-sm">{{ $item->lokasi ?? 'Kampus MTs Nurul Falaah' }}</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="flex items-center justify-end mt-auto border-t border-gray-50 pt-3">
                                                    <a href="{{ route('web.agenda.detail', $item->id) }}"
                                                        class="inline-flex items-center gap-1.5 text-green-700 hover:text-green-800 font-bold text-xs sm:text-sm transition-colors duration-300 group">
                                                        Lihat Agenda
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 sm:h-4 sm:w-4 group-hover:translate-x-1 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </article>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-xs sm:text-sm text-slate-900">Tidak ada agenda yang sesuai.</p>
                            @endif
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
@endsection

@section('sidebar')
    <div class="space-y-10 pt-4 sm:pt-6 lg:pt-[52px]">
        @include('website.components.content.category-widget')
        @include('website.components.content.social-media-widget')
        @include('website.components.content.calendar-widget')
    </div>
@endsection

