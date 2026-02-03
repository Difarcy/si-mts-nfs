@extends('website.layouts.main')

@section('title', 'Artikel')

@section('content')
    <div class="space-y-6 pt-4 sm:pt-6">
        <!-- Breadcrumb -->
        <x-website.components.layout.breadcrumb :items="[['label' => 'INFORMASI'], ['label' => 'ARTIKEL']]" />

        <!-- Header Section -->
        <x-website.components.layout.page-title title="Daftar Artikel" />

        <div class="w-full space-y-4" data-website-search-scope>
            <!-- Search Form Mock -->
            <!-- Search Bar -->
            <x-website.components.ui.search-bar placeholder="Cari artikel..." />

            <!-- Articles List -->
            @php
                $articlePosts = $posts ?? collect();
                $fallbackImages = ['img/banner1.jpg', 'img/banner2.jpg', 'img/banner3.jpg'];
            @endphp

            @if($articlePosts->isEmpty())
                <div class="flex flex-col items-center justify-center min-h-[400px] text-center w-full">
                    <p class="text-[11px] sm:text-base font-semibold text-slate-900 tracking-wider">
                        Belum Ada Artikel
                    </p>
                </div>
            @else
                <div class="space-y-4 sm:space-y-5">
                    @foreach($articlePosts as $index => $post)
                        @php
                            $image = ($post->thumbnail ?? null)
                                ? asset('storage/' . $post->thumbnail)
                                : asset($fallbackImages[$index % count($fallbackImages)]);
                            $dateObj = $post->tanggal_publikasi ?? $post->created_at ?? now();
                            $date = \Carbon\Carbon::parse($dateObj)->translatedFormat('d F Y');
                            $time = \Carbon\Carbon::parse($dateObj)->format('H:i');
                            $excerpt = Str::limit(strip_tags($post->deskripsi), 150);
                        @endphp
                        <article
                            class="bg-white shadow-sm overflow-hidden border border-gray-100 hover:shadow-lg transition-all duration-300 flex flex-col sm:flex-row group"
                            data-website-search-item data-search="{{ e(($post->judul ?? '') . ' ' . $excerpt) }}">
                            <a href="{{ route('web.article.detail', $post->id) }}" class="relative w-full sm:w-[38%] shrink-0">
                                <div class="w-full aspect-video bg-gray-50 overflow-hidden">
                                    <img src="{{ $image }}" alt="{{ $post->judul ?? 'Artikel' }}"
                                        class="w-full h-full object-cover js-img-fallback" loading="lazy"
                                        data-fallback-src="{{ asset('images/background/default-backgrounds.png') }}">
                                </div>
                            </a>
                            <div class="w-full sm:w-[62%] p-2 sm:p-2.5 flex flex-col justify-between">
                                <div>
                                    <h3
                                        class="text-sm sm:text-xl font-bold text-black mb-0.5 line-clamp-2 hover:text-green-700 transition-colors font-roboto-slab">
                                        <a href="{{ route('web.article.detail', $post->id) }}"
                                            class="hover:text-green-700 transition-colors">
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
                                            <span aria-hidden="true"
                                                style="display:inline-block;width:1px;height:10px;background:rgba(0,0,0,1);vertical-align:middle;"></span>
                                            <span>{{ $time }}</span>
                                        </span>
                                    </p>
                                    <a href="{{ route('web.article.detail', $post->id) }}"
                                        class="inline-flex items-center gap-1.5 text-green-700 hover:text-green-800 font-bold text-xs sm:text-sm transition-colors duration-300 group">
                                        Baca Artikel
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
                @if(method_exists($articlePosts, 'links'))
                    <div class="mt-8">
                        <x-website.components.ui.pagination :items="$articlePosts" />
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
        @include('website.components.content.agenda-widget')
    </div>
@endsection
