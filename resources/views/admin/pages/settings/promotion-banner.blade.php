@extends('admin.layouts.admin')

@section('title', 'Banner Promosi')

@section('content')
    <div class="flex flex-col gap-3 pb-4">
        {{-- Page Header --}}
        <x-admin.ui.page-header title="Banner Promosi" subtitle="Kelola banner promosi untuk informasi spesial">
            <x-slot:actions>
                <x-admin.form.button type="submit" variant="primary" form="promotion-banner-form" class="cursor-not-allowed opacity-50">
                    <x-slot:icon>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </x-slot:icon>
                    Simpan
                </x-admin.form.button>
            </x-slot:actions>
        </x-admin.ui.page-header>

        {{-- Main Content --}}
        <x-admin.ui.card bodyClass="p-4 sm:p-6">
            <form id="promotion-banner-form" method="POST" action="{{ route('admin.pengaturan.promotion-banner.update') }}" class="space-y-6"
                enctype="multipart/form-data">
                @csrf

                <div class="space-y-2">
                    <label class="block text-[12px] sm:text-sm text-black">
                        Upload Gambar Banner Promosi
                    </label>

                    <div class="text-xs text-slate-500 mb-2">
                        Tampilkan informasi PPDB, event sekolah, atau pengumuman penting dalam bentuk banner promosi.
                        Ukuran rekomendasi 1920×600 px, maksimal 10MB.
                    </div>

                    @php
                        $bannerPromosiPath = isset($bannerPromosi) && $bannerPromosi && $bannerPromosi->path ? $bannerPromosi->path : '';
                        $bannerPromosiUrl = $bannerPromosiPath ? asset('storage/' . $bannerPromosiPath) : '';
                    @endphp

                    <x-admin.form.upload-image
                        label=""
                        name="banner_promosi"
                        height="aspect-21/9 sm:aspect-1920/600"
                        helperText="Ukuran rekomendasi 1920×600 px. Maksimal file 10MB."
                        :existing="$bannerPromosiUrl"
                        :existingValue="$bannerPromosiPath"
                        objectFit="object-cover"
                    />
                </div>
            </form>
        </x-admin.ui.card>
    </div>
@endsection
