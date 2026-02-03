@extends('admin.layouts.admin')

@section('title', 'Social Media')

@section('content')
    <div class="flex flex-col gap-3 pb-4">
        {{-- Page Header --}}
        <x-admin.ui.page-header title="Social Media" subtitle="Kelola tautan media sosial resmi sekolah">
            <x-slot:actions>
                <x-admin.form.button type="submit" variant="primary" form="social-media-form" class="cursor-not-allowed opacity-50" disabled>
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
            <form id="social-media-form" method="POST" action="{{ route('admin.pengaturan.social-media.update') }}" class="space-y-6">
                @csrf
                
                <div class="space-y-2">
                    <label class="block text-[12px] sm:text-sm text-black">
                        Tautan Media Sosial
                    </label>
                    <div class="text-xs text-slate-500 mb-2">
                        Masukkan URL lengkap profil media sosial sekolah.
                    </div>
                </div>

                {{-- Social Media Inputs --}}
                <div class="space-y-4">
                    {{-- Facebook --}}
                    <div class="flex items-start gap-3">
                        <div class="shrink-0 w-8 h-8 sm:w-9 sm:h-9 flex items-center justify-center bg-blue-600 rounded-lg mt-[16px] sm:mt-[20px]">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <x-admin.form.input label="Facebook" name="facebook" placeholder="Masukan link profil Facebook" :value="$mediaSosial->facebook ?? ''" />
                        </div>
                    </div>

                    {{-- Instagram --}}
                    <div class="flex items-start gap-3">
                        <div class="shrink-0 w-8 h-8 sm:w-9 sm:h-9 flex items-center justify-center bg-gradient-to-br from-purple-600 via-pink-600 to-orange-500 rounded-lg mt-[16px] sm:mt-[20px]">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M7.5 2h9A5.5 5.5 0 0 1 22 7.5v9A5.5 5.5 0 0 1 16.5 22h-9A5.5 5.5 0 0 1 2 16.5v-9A5.5 5.5 0 0 1 7.5 2zM7.5 4A3.5 3.5 0 0 0 4 7.5v9A3.5 3.5 0 0 0 7.5 20h9A3.5 3.5 0 0 0 20 16.5v-9A3.5 3.5 0 0 0 16.5 4h-9z"/>
                                <path d="M12 7a5 5 0 1 1 0 10 5 5 0 0 1 0-10zm0 2a3 3 0 1 0 0 6 3 3 0 0 0 0-6z"/>
                                <path d="M17 6.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <x-admin.form.input label="Instagram" name="instagram" placeholder="Masukan link profil Instagram" :value="$mediaSosial->instagram ?? ''" />
                        </div>
                    </div>

                    {{-- YouTube --}}
                    <div class="flex items-start gap-3">
                        <div class="shrink-0 w-8 h-8 sm:w-9 sm:h-9 flex items-center justify-center bg-red-600 rounded-lg mt-[16px] sm:mt-[20px]">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <x-admin.form.input label="YouTube" name="youtube" placeholder="Masukan link channel YouTube" :value="$mediaSosial->youtube ?? ''" />
                        </div>
                    </div>

                    {{-- Twitter / X --}}
                    <div class="flex items-start gap-3">
                        <div class="shrink-0 w-8 h-8 sm:w-9 sm:h-9 flex items-center justify-center bg-black rounded-lg mt-[16px] sm:mt-[20px]">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <x-admin.form.input label="X" name="x" placeholder="Masukan link profil X" :value="$mediaSosial->x ?? ''" />
                        </div>
                    </div>

                    {{-- TikTok --}}
                    <div class="flex items-start gap-3">
                        <div class="shrink-0 w-8 h-8 sm:w-9 sm:h-9 flex items-center justify-center bg-black rounded-lg mt-[16px] sm:mt-[20px]">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <x-admin.form.input label="TikTok" name="tiktok" placeholder="Masukan link profil TikTok" :value="$mediaSosial->tiktok ?? ''" />
                        </div>
                    </div>
                </div>

            </form>
        </x-admin.ui.card>
    </div>
@endsection
