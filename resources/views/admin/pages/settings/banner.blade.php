@extends('admin.layouts.admin')

@section('title', 'Banner')

@section('content')
    <div class="flex flex-col gap-3 pb-4">
        {{-- Page Header --}}
        <x-admin.ui.page-header title="Banner" subtitle="Kelola banner slide di halaman utama website">
            <x-slot:actions>
                <x-admin.form.button type="submit" variant="primary" form="banner-form" class="cursor-not-allowed opacity-50">
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
            <form id="banner-form" method="POST" action="{{ route('admin.pengaturan.banner.store') }}" class="space-y-6"
                enctype="multipart/form-data" data-no-submit-protection>
                @csrf
                
                <div class="space-y-2">
                    <label class="block text-[12px] sm:text-sm text-black">
                        Upload Gambar Banner
                    </label>
                    <div class="text-xs text-slate-500 mb-2">
                        Upload hingga 6 gambar. Geser gambar untuk mengubah urutan.
                    </div>
                    
                    <x-admin.form.upload-image 
                        label="" 
                        name="banner" 
                        multiple="true" 
                        max-files="6" 
                        containerStyle="height: 560px;"
                        :existing="$existingImages" 
                    />
                </div>
            </form>
        </x-admin.ui.card>
    </div>
@endsection
