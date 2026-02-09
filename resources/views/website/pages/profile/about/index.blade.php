@extends('website.layouts.full')

@section('title', 'Tentang Sekolah')

@section('content')
    <div class="pt-4 sm:pt-6 space-y-6">
        <x-website.components.layout.breadcrumb :items="[['label' => 'PROFIL'], ['label' => 'TENTANG SEKOLAH']]" />
        <x-website.components.layout.page-title title="Tentang Sekolah" />

        <article class="overflow-hidden w-full">
            <!-- Header Title -->
            <div class="text-center mb-12">
                <h2 class="text-xs sm:text-lg font-bold text-black font-roboto-slab leading-tight">
                    MTs Nurul Falaah Soreang
                </h2>
            </div>

            <!-- Landscape Photo Section (No Shadow, Small Radius, No Crop) -->
            <div class="max-w-5xl mx-auto mb-12">
                @if($tentangSekolah?->foto)
                    <div class="relative w-full h-[250px] sm:h-[450px] overflow-hidden rounded-md border border-gray-200 bg-gray-50 flex items-center justify-center">
                        <img src="{{ asset('storage/' . $tentangSekolah->foto) }}" alt="Gedung Sekolah"
                            class="max-w-full max-h-full object-contain">
                    </div>
                @else
                    <div class="w-full h-[250px] sm:h-[450px] flex items-center justify-center text-center bg-gray-50 rounded-md border-2 border-dashed border-gray-200">
                        <p class="text-sm sm:text-lg font-medium text-slate-500 tracking-wider font-inter">Belum Ada Foto Gedung Sekolah</p>
                    </div>
                @endif
            </div>

            <!-- Content Grid -->
            <div class="space-y-10 w-full">
                <!-- Deskripsi Profil -->
                <section class="w-full">
                    <div class="prose prose-lg max-w-none w-full text-black leading-relaxed text-justify font-inter">
                        @if($tentangSekolah?->deskripsi)
                            {!! nl2br(e($tentangSekolah->deskripsi)) !!}
                        @else
                            <div class="py-20 flex items-center justify-center text-center w-full">
                                <p class="text-xs sm:text-base font-semibold text-slate-900 tracking-wider">Belum Ada Deskripsi
                                    Profil Sekolah</p>
                            </div>
                        @endif
                    </div>
                </section>

                <!-- Sejarah Section -->
                <section class="relative pt-2 border-t border-gray-100 w-full">
                    <x-website.components.layout.page-title title="Sejarah" class="text-2xl sm:text-3xl" />

                    <div class="prose prose-lg max-w-none w-full text-black leading-relaxed text-justify font-inter">
                        @if($tentangSekolah?->sejarah)
                            {!! nl2br(e($tentangSekolah->sejarah)) !!}
                        @else
                            <div class="py-20 flex items-center justify-center text-center w-full">
                                <p class="text-xs sm:text-base font-semibold text-slate-900 tracking-wider">Belum Ada Sejarah
                                    Singkat Sekolah</p>
                            </div>
                        @endif
                    </div>
                </section>
            </div>
        </article>
    </div>
@endsection