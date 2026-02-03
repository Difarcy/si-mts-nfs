@extends('website.layouts.main')

@section('title', 'Berita')

@section('content')
    <div class="space-y-6 pt-4 sm:pt-6">
        <!-- Breadcrumb -->
        <x-website.components.layout.breadcrumb :items="[['label' => 'INFORMASI'], ['label' => 'BERITA']]" />

        <!-- Header Section -->
        <x-website.components.layout.page-title title="Daftar Berita" />

        <div class="w-full space-y-4" data-website-search-scope>
            <!-- Search Form -->
            <x-website.components.ui.search-bar placeholder="Cari berita..." />

            <!-- News List -->
            @php
                $fallbackImages = ['img/banner1.jpg', 'img/banner2.jpg', 'img/banner3.jpg'];
            @endphp

            @if($newsPosts->isEmpty())
                <div class="flex flex-col items-center justify-center min-h-[400px] text-center w-full">
                    <p class="text-[11px] sm:text-base font-semibold text-slate-900 tracking-wider">
                        Belum Ada Berita
                    </p>
                </div>
            @else
                <div class="space-y-4 sm:space-y-5">
                    @foreach($newsPosts as $index => $post)
                        @php
                            $image = $post->thumbnail
                                ? asset('storage/' . $post->thumbnail)
                                : asset($fallbackImages[$index % count($fallbackImages)]);

                            $dateObj = $post->tanggal_publikasi ?? now();
                            $date = \Carbon\Carbon::parse($dateObj)->translatedFormat('d F Y');
                            $time = \Carbon\Carbon::parse($dateObj)->format('H:i');

                            $excerpt = Str::limit(strip_tags($post->deskripsi), 150);
                        @endphp
                        <article
                            class="bg-white shadow-sm overflow-hidden border border-gray-100 hover:shadow-lg transition-all duration-300 flex flex-col sm:flex-row group"
                            data-website-search-item data-search="{{ e(($post->judul ?? '') . ' ' . $excerpt) }}">
                            <a href="{{ route('web.news.detail', $post->id) }}" class="relative w-full sm:w-[38%] shrink-0">
                                <div class="w-full aspect-video bg-gray-50 overflow-hidden">
                                    <img src="{{ $image }}" alt="{{ $post->judul ?? 'Berita' }}"
                                        class="w-full h-full object-cover js-img-fallback" loading="lazy"
                                        data-fallback-src="{{ asset('images/background/default-backgrounds.png') }}">
                                </div>
                            </a>
                            <div class="w-full sm:w-[62%] p-2 sm:p-2.5 flex flex-col justify-between">
                                <div>
                                    <h3
                                        class="text-sm sm:text-xl font-bold text-black mb-0.5 line-clamp-2 hover:text-green-700 transition-colors font-roboto-slab">
                                        <a href="{{ route('web.news.detail', $post->id) }}"
                                            class="hover:text-green-700 transition-colors">
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
                                            <span aria-hidden="true"
                                                style="display:inline-block;width:1px;height:10px;background:rgba(0,0,0,1);vertical-align:middle;"></span>
                                            <span>{{ $time }}</span>
                                        </span>
                                    </p>
                                    <a href="{{ route('web.news.detail', $post->id) }}"
                                        class="inline-flex items-center gap-1.5 text-green-700 hover:text-green-800 font-bold text-xs sm:text-sm transition-colors duration-300 group">
                                        Baca Berita
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

                <!-- Pagination -->
                @if(method_exists($newsPosts, 'links'))
                    <div class="mt-8">
                        <x-website.components.ui.pagination :items="$newsPosts" />
                    </div>
                @endif
            @endif
        </div>
    </div>
@endsection

@section('sidebar')
    {{-- Offset untuk sejajar dengan Page Title di desktop --}}
    <div class="space-y-10 pt-4 sm:pt-6 lg:pt-[52px]">
        @include('website.components.content.announcement-widget')
        @include('website.components.content.article-widget')
    </div>
@endsection
