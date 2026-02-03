@extends('admin.layouts.admin')

@section('title', 'Logo')

@section('content')
    <div class="flex flex-col gap-3 pb-4">
        {{-- Page Header --}}
        <x-admin.ui.page-header title="Logo" subtitle="Unggah logo baru untuk identitas website sekolah">
            <x-slot:actions>
                <x-admin.form.button type="submit" variant="primary" form="logo-form" class="cursor-not-allowed opacity-50">
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
            <form id="logo-form" method="POST" action="{{ route('admin.pengaturan.logo.update') }}" class="space-y-6"
                enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Upload Section --}}
                    <div class="space-y-2">
                        <label class="block text-[12px] sm:text-sm text-black">
                            Upload Logo Baru
                        </label>
                        <x-admin.form.upload-image label="" name="logo" objectFit="object-contain" />
                    </div>

                    {{-- Current Logo Section --}}
                    <div class="space-y-2">
                        <label class="block text-[12px] sm:text-sm text-black">
                            Logo Saat Ini
                        </label>
                        <div
                            class="w-full h-[250px] sm:h-[400px] border-2 border-dashed border-gray-200 rounded-lg flex items-center justify-center bg-gray-50 p-3">
                            @php
                                $logoUrl = $logo && $logo->path
                                    ? (str_starts_with($logo->path, 'images/') ? asset($logo->path) : asset('storage/' . $logo->path))
                                    : asset('images/logo/logo.png');
                            @endphp
                            <img src="{{ $logoUrl }}" onerror="this.src='https://via.placeholder.com/150?text=No+Logo'"
                                alt="Logo Saat Ini" class="max-w-full max-h-full object-contain" data-current-logo>
                        </div>
                    </div>
                </div>
            </form>
        </x-admin.ui.card>
    </div>
@endsection