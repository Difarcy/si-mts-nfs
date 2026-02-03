@extends('website.layouts.main')

@section('title', 'Pengumuman')

@section('content')
    <div class="space-y-6 pt-4 sm:pt-6">
        <!-- Breadcrumb -->
        <x-website.components.layout.breadcrumb :items="[['label' => 'INFORMASI'], ['label' => 'PENGUMUMAN']]" />

        <!-- Header Section -->
        <x-website.components.layout.page-title title="Daftar Pengumuman" />

        <div class="w-full space-y-4" data-website-search-scope>
            <!-- Search Form Mock -->
            <!-- Search Bar -->
            <x-website.components.ui.search-bar placeholder="Cari pengumuman..." />

            <!-- Announcements List -->
            @php
                $announcementsList = $pengumuman ?? collect();
            @endphp

            @if($announcementsList->isEmpty())
                <div class="flex flex-col items-center justify-center min-h-[400px] text-center w-full">
                    <p class="text-[11px] sm:text-base font-semibold text-slate-900 tracking-wider">
                        Belum Ada Pengumuman
                    </p>
                </div>
            @else
                <div class="space-y-4 sm:space-y-5">
                    @foreach($announcementsList as $item)
                        @php
                            $dateObj = $item->tanggal_publikasi ?? $item->created_at ?? now();
                            $date = \Carbon\Carbon::parse($dateObj)->translatedFormat('d F Y');
                            $time = \Carbon\Carbon::parse($dateObj)->format('H:i');
                            $excerpt = Str::limit(strip_tags($item->deskripsi), 250);
                        @endphp
                        <article
                            class="bg-white shadow-sm overflow-hidden border border-gray-100 hover:shadow-lg transition-all duration-300 flex flex-col group p-4 sm:p-5 min-h-[180px]"
                            data-website-search-item data-search="{{ e(($item->judul ?? '') . ' ' . $excerpt) }}">
                            <div class="flex flex-col justify-between h-full">
                                <div>
                                    <h3
                                        class="text-sm sm:text-xl font-bold text-black mb-2 line-clamp-2 hover:text-green-700 transition-colors font-roboto-slab">
                                        <a href="{{ route('web.announcement.detail', $item->id) }}"
                                            class="hover:text-green-700 transition-colors">
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
                                            <span aria-hidden="true"
                                                style="display:inline-block;width:1px;height:10px;background:rgba(0,0,0,1);vertical-align:middle;"></span>
                                            <span>{{ $time }}</span>
                                        </span>
                                    </p>
                                    <a href="{{ route('web.announcement.detail', $item->id) }}"
                                        class="inline-flex items-center gap-1.5 text-green-700 hover:text-green-800 font-bold text-xs sm:text-sm transition-colors duration-300 group">
                                        Lihat Pengumuman
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-3 w-3 sm:h-4 sm:w-4 group-hover:translate-x-1 transition-transform duration-300"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- Pagination Placeholder -->
                @if(method_exists($announcementsList, 'links'))
                    <div class="mt-8">
                        <x-website.components.ui.pagination :items="$announcementsList" />
                    </div>
                @endif
            @endif
        </div>
    </div>
@endsection

@section('sidebar')
    {{-- Offset untuk sejajar dengan Page Title di desktop --}}
    <div class="space-y-10 pt-4 sm:pt-6 lg:pt-[52px]">
        @include('website.components.content.news-widget')
        @include('website.components.content.article-widget')
    </div>
@endsection
