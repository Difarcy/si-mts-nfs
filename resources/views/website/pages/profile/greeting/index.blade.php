@extends('website.layouts.full')

@section('title', 'Kepala Madrasah')

@section('content')
    <div class="pt-4 sm:pt-6 space-y-6">
        {{-- Breadcrumb and Page Title ALWAYS at the top --}}
        <x-website.components.layout.breadcrumb :items="[['label' => 'PROFIL'], ['label' => 'KEPALA MADRASAH']]" />
        <x-website.components.layout.page-title title="Kepala Madrasah" />

        <div class="flex flex-col lg:flex-row gap-4 lg:gap-8">

            <!-- Left Side (30% on desktop) -->
            <div class="w-full lg:w-[30%] flex-shrink-0">
                <div class="relative">
                    @if($kepalaMadrasah?->foto)
                        <div class="w-full aspect-[3/4] bg-gray-200 overflow-hidden relative">
                            <img src="{{ asset('storage/' . $kepalaMadrasah->foto) }}" alt="Kepala Madrasah"
                                class="w-full h-full object-cover">
                        </div>
                    @else
                        <div class="w-full aspect-[3/4] bg-gray-200 flex flex-col items-center justify-center relative">
                            <span class="text-[10px] sm:text-xs font-semibold text-slate-900 tracking-wider uppercase">Belum ada
                                foto</span>
                        </div>
                    @endif
                </div>

                <!-- Name & Position -->
                <div class="mt-4 text-center">
                    <h2 class="text-[13px] sm:text-base text-black font-bold text-center font-roboto-slab leading-tight">
                        {{ $kepalaMadrasah?->nama ?? 'Kepala Madrasah' }}
                    </h2>
                    <p class="text-[10px] sm:text-xs text-slate-900 mt-1 text-center font-roboto-slab">
                        - Kepala Madrasah -
                    </p>
                </div>
            </div>

            <!-- Right Side (70% on desktop) -->
            <div class="flex-grow space-y-8">
                <div class="mb-6">
                    <h3
                        class="text-[13px] sm:text-[18px] font-bold text-black font-roboto-slab leading-tight inline-block border-b border-green-600 pb-1">
                        Sambutan Kepala Madrasah
                    </h3>
                </div>

                <div class="prose prose-lg max-w-none text-black leading-relaxed text-justify font-inter">
                    @if($kepalaMadrasah?->sambutan)
                        {!! $kepalaMadrasah->sambutan !!}
                    @else
                        <div class="min-h-[400px] flex flex-col items-center justify-center text-center w-full">
                            <p class="text-xs sm:text-base font-semibold text-slate-900 tracking-wider">
                                Belum Ada Sambutan Kepala Madrasah
                            </p>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection
