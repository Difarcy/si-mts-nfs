@extends('website.layouts.main')

@section('title', ($post->judul ?? 'Artikel') . ' | MTs Nurul Falaah Soreang')

@section('content')
    <div class="space-y-6 pt-4 sm:pt-6">
        <!-- Breadcrumb -->
        <x-website.components.layout.breadcrumb :items="[
            ['label' => 'INFORMASI'],
            ['label' => 'ARTIKEL', 'url' => route('web.article')],
            ['label' => $post->judul ?? 'Detail Artikel']
        ]" />

        <x-website.components.layout.page-title title="Detail Artikel" />

        @php
            $dateObj = $post->tanggal_publikasi ?? $post->created_at ?? now();
            $date = \Carbon\Carbon::parse($dateObj)->translatedFormat('d F Y');
            $time = \Carbon\Carbon::parse($dateObj)->format('H:i');
            $shareUrl = url()->current();
            $shareText = (string) ($post->judul ?? 'Artikel');
            $shareUrlEncoded = rawurlencode($shareUrl);
            $shareTextEncoded = rawurlencode($shareText);
        @endphp

        <div class="space-y-2">
            @php
                $rawTags = $post->tags ?? null;
                $tagsList = collect(is_array($rawTags) ? $rawTags : preg_split('/[,\n]/', (string) $rawTags))
                    ->map(fn($t) => trim((string) $t))
                    ->filter()
                    ->values();
            @endphp

            @if($tagsList->count() > 0)
                <div class="flex flex-wrap gap-2">
                    @foreach($tagsList as $tag)
                        <a href="{{ route('web.tags.article', ['tag' => $tag]) }}"
                            class="px-2 py-0.5 text-xs sm:text-sm font-bold text-white bg-green-700 font-lato">
                            {{ $tag }}
                        </a>
                    @endforeach
                </div>
            @endif

            <h1 class="text-lg sm:text-xl md:text-2xl lg:text-3xl font-bold text-black font-roboto-slab leading-tight">
                {{ $post->judul ?? 'Belum ada' }}
            </h1>

            <p class="text-[13px] sm:text-sm text-black font-lato leading-relaxed">
                <span class="inline-flex items-center gap-2 flex-wrap">
                    <span>{{ $date }}</span>
                    <span class="w-px h-2.5 bg-black"></span>
                    <span>{{ $time }}</span>
                    <span class="w-px h-2.5 bg-black"></span>
                    <span>{{ $post->penulis ?? 'Admin' }}</span>
                </span>
            </p>
        </div>

        @php
            // Ambil hanya gambar tambahan yang diupload (thumbnail tidak ditampilkan di detail)
            $images = collect();
            if (isset($post->gambar) && is_array($post->gambar)) {
                $images = collect($post->gambar)->filter()->values();
            }
        @endphp

        @if($images->isNotEmpty())
            <div class="grid {{ $images->count() === 1 ? 'grid-cols-1' : 'grid-cols-1 sm:grid-cols-2' }} gap-3">
                @foreach($images as $path)
                    <div class="overflow-hidden border border-gray-100 bg-gray-50 aspect-video rounded-lg">
                        <img src="{{ str_starts_with($path, 'http') ? $path : asset('storage/' . $path) }}"
                            alt="{{ $post->judul ?? 'Artikel' }}" class="w-full h-full object-cover" loading="lazy">
                    </div>
                @endforeach
            </div>
        @endif

        <div class="prose prose-base sm:prose-base max-w-none text-black leading-relaxed font-lato text-justify">
            {!! nl2br(e($post->deskripsi ?? 'Belum ada')) !!}
        </div>

        <!-- Share Section -->
        <div class="pt-6 border-t border-gray-100">
            <p class="text-[13px] sm:text-sm text-slate-900 font-lato mb-3">Bagikan Informasi Ini</p>
            <div class="flex items-center gap-2">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrlEncoded }}" target="_blank"
                    rel="noopener noreferrer"
                    class="w-10 h-10 flex items-center justify-center bg-blue-600 rounded-lg transform hover:-translate-y-1 transition-transform shadow-sm">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                    </svg>
                </a>
                <a href="https://www.instagram.com/?url={{ $shareUrlEncoded }}" target="_blank" rel="noopener noreferrer"
                    class="w-10 h-10 flex items-center justify-center bg-gradient-to-br from-purple-600 via-pink-600 to-orange-500 rounded-lg transform hover:-translate-y-1 transition-transform shadow-sm">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M7.5 2h9A5.5 5.5 0 0 1 22 7.5v9A5.5 5.5 0 0 1 16.5 22h-9A5.5 5.5 0 0 1 2 16.5v-9A5.5 5.5 0 0 1 7.5 2zM7.5 4A3.5 3.5 0 0 0 4 7.5v9A3.5 3.5 0 0 0 7.5 20h9A3.5 3.5 0 0 0 20 16.5v-9A3.5 3.5 0 0 0 16.5 4h-9z" />
                        <path d="M12 7a5 5 0 1 1 0 10 5 5 0 0 1 0-10zm0 2a3 3 0 1 0 0 6 3 3 0 0 0 0-6z" />
                        <path d="M17 6.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                    </svg>
                </a>
                <a href="https://wa.me/?text={{ $shareTextEncoded }}%20{{ $shareUrlEncoded }}" target="_blank"
                    rel="noopener noreferrer"
                    class="w-10 h-10 flex items-center justify-center bg-green-500 rounded-lg transform hover:-translate-y-1 transition-transform shadow-sm">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L0 24l6.335-1.662c1.879 1.02 3.996 1.56 6.148 1.562h.006c6.558 0 11.894-5.335 11.897-11.891a11.85 11.85 0 00-3.488-8.412" />
                    </svg>
                </a>
                <a href="https://twitter.com/intent/tweet?url={{ $shareUrlEncoded }}&text={{ $shareTextEncoded }}"
                    target="_blank" rel="noopener noreferrer"
                    class="w-10 h-10 flex items-center justify-center bg-black rounded-lg transform hover:-translate-y-1 transition-transform shadow-sm">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                    </svg>
                </a>
            </div>
        </div>

        <x-website.components.content.related-posts :relatedPosts="$relatedPosts ?? collect()" />

        <x-website.components.content.comments contentType="article" :contentId="$post->id" :comments="$comments ?? collect()" />
    </div>
@endsection

@section('sidebar')
    {{-- Offset untuk sejajar dengan Page Title di desktop --}}
    <div class="space-y-10 pt-4 sm:pt-6 lg:pt-[52px]">
        @include('website.components.content.news-widget')
        @include('website.components.content.agenda-widget')
    </div>
@endsection
