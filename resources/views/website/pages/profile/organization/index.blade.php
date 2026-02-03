@extends('website.layouts.main')

@section('title', 'Struktur Organisasi')

@section('content')
    <div class="pt-4 sm:pt-6 space-y-6">
        <x-website.components.layout.breadcrumb :items="[['label' => 'PROFIL'], ['label' => 'STRUKTUR ORGANISASI']]" />
        <x-website.components.layout.page-title title="Struktur Organisasi" />

        <div>
            <h2 class="text-xs sm:text-[18px] font-bold text-black mb-8 text-center font-roboto-slab">
                Bagan Struktur Organisasi
            </h2>

            @if($strukturOrganisasi?->struktur)
                <x-website.components.ui.image-preview :src="asset('storage/' . $strukturOrganisasi->struktur)" alt="Struktur Organisasi" />
            @else
                <div class="flex flex-col items-center justify-center min-h-[400px] text-center w-full">
                    <p class="text-[11px] sm:text-base font-semibold text-slate-900 tracking-wider">
                        Belum Ada Struktur Organisasi
                    </p>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('sidebar')
    {{-- Offset untuk sejajar dengan Page Title di desktop --}}
    <div class="space-y-10 pt-4 sm:pt-6 lg:pt-[52px]">
        @include('website.components.content.headmaster-greeting')
        @include('website.components.content.category-widget')
    </div>
@endsection
