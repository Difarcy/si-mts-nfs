@extends('website.layouts.main')

@section('title', 'Prestasi Siswa')

@section('content')
    <div class="pt-4 sm:pt-6 space-y-6">
        <x-website.components.layout.breadcrumb :items="[['label' => 'PROFIL'], ['label' => 'PRESTASI SISWA']]" />
        <x-website.components.layout.page-title title="Prestasi Siswa" />

        @php
            $achievements = isset($achievements) ? $achievements : (isset($prestasi) ? $prestasi : collect());
        @endphp

        <div class="w-full">
            @if($achievements->isEmpty())
                <div class="flex flex-col items-center justify-center min-h-[400px] text-center w-full">
                    <p class="text-[11px] sm:text-base font-semibold text-slate-900 tracking-wider">
                        Belum Ada Prestasi Siswa Terdaftar
                    </p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($achievements as $achievement)
                        <div class="group bg-white rounded-xl shadow-md hover:shadow-xl overflow-hidden transition-all duration-300 flex flex-col h-full border border-gray-100">
                            <a href="{{ route('web.achievement.detail', $achievement) }}" class="relative aspect-[4/3] overflow-hidden bg-gray-50 block">
                                @if($achievement->foto_siswa)
                                    <img src="{{ asset('storage/' . $achievement->foto_siswa) }}" alt="{{ $achievement->judul }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-black" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                                <div class="absolute top-3 right-3">
                                    <x-website.components.ui.badge :variant="strtolower($achievement->peringkat)">
                                        {{ $achievement->peringkat ?? 'Prestasi' }}
                                    </x-website.components.ui.badge>
                                </div>
                            </a>
                            <div class="p-4 flex-grow flex flex-col">
                                <a href="{{ route('web.achievement.detail', $achievement) }}" class="block">
                                    <h3
                                        class="text-sm sm:text-xl font-bold text-black mb-0.5 line-clamp-2 hover:text-green-700 transition-colors font-roboto-slab">
                                        {{ $achievement->nama_lomba ?? $achievement->judul }}
                                    </h3>
                                </a>

                                <a href="{{ route('web.achievement.detail', $achievement) }}" class="block">
                                    <p class="text-sm sm:text-base font-bold text-black mb-1 hover:text-green-700 transition-colors">
                                        {{ $achievement->nama_siswa }} - Kelas {{ $achievement->kelas }}
                                    </p>

                                    <div class="flex items-center gap-2 mb-3 text-xs sm:text-sm font-medium font-lato tracking-wide text-slate-900 hover:text-black transition-colors">
                                        <span>
                                            {{ $achievement->tingkat }}
                                        </span>
                                        <span class="text-black">•</span>
                                        <span>
                                            {{ $achievement->jenis }}
                                        </span>
                                        <span class="text-black">•</span>
                                        <span>
                                            {{ $achievement->tanggal ? \Carbon\Carbon::parse($achievement->tanggal)->isoFormat('D MMM Y') : '-' }}
                                        </span>
                                    </div>
                                </a>
                                
                                <a href="{{ route('web.achievement.detail', $achievement) }}" class="block mt-auto">
                                    <p class="text-xs sm:text-base text-black line-clamp-2 mb-1 text-justify font-lato hover:text-black transition-colors block">
                                        {{ Str::limit(strip_tags($achievement->deskripsi), 100) }}
                                    </p>
                                </a>

                                <div class="mt-auto pt-3 border-t border-gray-50 flex items-center justify-end">
                                    <a href="{{ route('web.achievement.detail', $achievement) }}"
                                        class="inline-flex items-center gap-1.5 text-green-700 hover:text-green-800 font-bold text-xs sm:text-sm transition-colors duration-300 group">
                                        Baca Selengkapnya
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-3 w-3 sm:h-4 sm:w-4 group-hover:translate-x-1 transition-transform duration-300"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if(method_exists($achievements, 'links'))
                    <div class="mt-10">
                        {{ $achievements->links() }}
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
        @include('website.components.content.agenda-widget')
    </div>
@endsection
