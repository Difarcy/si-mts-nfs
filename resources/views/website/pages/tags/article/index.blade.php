@extends('website.layouts.main')

@section('title', 'Tag: ' . $decodedTag . ' | MTs Nurul Falaah Soreang')

@section('content')
    <div class="space-y-6 pt-4 sm:pt-6">
        <x-website.components.layout.breadcrumb :items="[['label' => 'INFORMASI'], ['label' => 'ARTIKEL', 'url' => route('web.article')], ['label' => 'TAG: ' . $decodedTag]]" />

        <x-website.components.layout.page-title :title="'Tag: ' . $decodedTag" />

        <div class="w-full space-y-4">
            @php
                $tagPosts = $posts ?? collect();
                $fallbackImages = ['img/banner1.jpg', 'img/banner2.jpg', 'img/banner3.jpg'];
            @endphp

            @if($tagPosts->isEmpty())
                <div class="bg-white rounded-xl p-16 text-center border border-gray-100 shadow-sm flex flex-col items-center">
                    <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-300" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                    </div>
                    <p class="text-[11px] sm:text-sm font-semibold text-gray-400 text-center tracking-wider uppercase">
                        Tidak ada konten dengan tag "{{ $decodedTag }}"
                    </p>
                </div>
            @else
                <div class="space-y-4 sm:space-y-5">
                    @foreach($tagPosts as $index => $post)
                        @php
                            $image = ($post->thumbnail ?? null)
                                ? asset('storage/' . $post->thumbnail)
                                : asset($fallbackImages[$index % count($fallbackImages)]);
                            $dateObj = $post->tanggal_publikasi ?? $post->created_at ?? now();
                            $date = \Carbon\Carbon::parse($dateObj)->translatedFormat('d F Y');
                            $time = \Carbon\Carbon::parse($dateObj)->format('H:i');
                            $excerpt = Str::limit(strip_tags($post->deskripsi), 150);
                        @endphp
                        <article class="bg-white shadow-sm overflow-hidden border border-gray-100 hover:shadow-lg transition-all duration-300 flex flex-col sm:flex-row group">
                            <div class="relative w-full sm:w-[38%] shrink-0">
                                <div class="w-full aspect-video bg-gray-50 overflow-hidden">
                                    <img src="{{ $image }}" alt="{{ $post->judul ?? 'Artikel' }}"
                                        class="w-full h-full object-cover js-img-fallback" loading="lazy"
                                        data-fallback-src="{{ asset('images/background/default-backgrounds.png') }}">
                                </div>
                            </div>
                            <div class="w-full sm:w-[62%] p-2 sm:p-2.5 flex flex-col justify-between">
                                <div>
                                    <h3 class="text-sm sm:text-xl font-bold text-gray-900 mb-0.5 line-clamp-2 hover:text-green-700 transition-colors font-roboto-slab">
                                        <a href="{{ route('web.article.detail', $post->id) }}" class="hover:text-green-700 transition-colors">
                                            {{ $post->judul ?? 'Judul Artikel' }}
                                        </a>
                                    </h3>
                                    <p class="text-xs sm:text-base text-gray-600 line-clamp-2 mb-1 text-justify font-lato">
                                        {{ $excerpt }}
                                    </p>
                                </div>
                                <div class="flex items-center justify-between mt-auto">
                                    <p class="text-xs sm:text-xs text-gray-500 font-lato">
                                        <span class="inline-flex items-center gap-2">
                                            <span>{{ $date }}</span>
                                            <span aria-hidden="true" style="display:inline-block;width:1px;height:10px;background:rgba(0,0,0,.45);vertical-align:middle;"></span>
                                            <span>{{ $time }}</span>
                                        </span>
                                    </p>
                                    <a href="{{ route('web.article.detail', $post->id) }}"
                                        class="inline-flex items-center gap-1.5 text-green-700 hover:text-green-800 font-bold text-xs sm:text-sm transition-colors duration-300 group">
                                        Baca Artikel
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-3 w-3 sm:h-4 sm:w-4 group-hover:translate-x-1 transition-transform duration-300"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                @if(method_exists($tagPosts, 'links'))
                    <div class="mt-10">
                        <x-website.components.ui.pagination :items="$tagPosts" />
                    </div>
                @endif
            @endif
        </div>
    </div>
@endsection

@section('sidebar')
    <div class="space-y-10 pt-4 sm:pt-6 lg:pt-[52px]">
        @include('website.components.content.news-widget')
        @include('website.components.content.agenda-widget')
    </div>
@endsection
