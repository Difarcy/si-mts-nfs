@extends('website.layouts.main')

@section('title', 'Agenda')

@section('content')
    <div class="space-y-6 pt-4 sm:pt-6">
        <!-- Breadcrumb -->
        <x-website.components.layout.breadcrumb :items="[['label' => 'INFORMASI'], ['label' => 'AGENDA']]" />

        <!-- Header Section -->
        <x-website.components.layout.page-title title="Daftar Agenda" />

        <div class="w-full space-y-4" data-website-search-scope>
            <!-- Search Form Mock -->
            <!-- Search Bar -->
            <x-website.components.ui.search-bar placeholder="Cari agenda..." />

            <!-- Agenda List -->
            @php
                $agendasList = $agendas ?? collect();
            @endphp

            @if($agendasList->isEmpty())
                <div class="flex flex-col items-center justify-center min-h-[400px] text-center w-full">
                    <p class="text-[11px] sm:text-base font-semibold text-slate-900 tracking-wider">
                        Belum Ada Agenda
                    </p>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($agendasList as $item)
                        <article
                            class="bg-white shadow-sm overflow-hidden border border-gray-100 hover:shadow-lg transition-all duration-300 flex flex-col group p-4 sm:p-5 min-h-[180px]"
                            data-website-search-item
                            data-search="{{ e(($item->judul ?? '') . ' ' . ($item->lokasi ?? '') . ' ' . strip_tags($item->deskripsi ?? '')) }}">
                            <div class="flex flex-col justify-between h-full">
                                <div>
                                    <h3
                                        class="text-sm sm:text-xl font-bold text-black mb-2 line-clamp-2 hover:text-green-700 transition-colors font-roboto-slab">
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
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-700" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
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
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-700" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
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
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-700" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
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
                @if(method_exists($agendasList, 'links'))
                    <div class="mt-8">
                        <x-website.components.ui.pagination :items="$agendasList" />
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
        @include('website.components.content.announcement-widget')
    </div>
@endsection
