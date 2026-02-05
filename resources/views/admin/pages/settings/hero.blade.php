@extends('admin.layouts.admin')

@section('title', 'Hero')

@section('content')
    <div class="flex flex-col gap-3 pb-4">
        {{-- Page Header --}}
        <x-admin.ui.page-header title="Hero" subtitle="Kelola konten hero section di halaman utama website">
            <x-slot:actions>
                <x-admin.form.button type="submit" variant="primary" form="hero-form" class="cursor-not-allowed opacity-50"
                    disabled>
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
            <form id="hero-form" method="POST" action="{{ route('admin.pengaturan.hero.update') }}" class="space-y-6"
                data-no-submit-protection>
                @csrf

                {{-- Opsi Tampilan --}}
                <div class="space-y-3 pb-6 border-b border-gray-100">
                    <h3 class="text-sm font-bold text-gray-900">Opsi Tampilan</h3>
                    <p class="text-xs text-gray-500 mb-3">Centang untuk menampilkan elemen tersebut di website.</p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                        <x-admin.form.checkbox name="show_logo" label="Logo" :checked="$hero->show_logo" />
                        <x-admin.form.checkbox name="show_tagline" label="Tagline" :checked="$hero->show_tagline" />
                        <x-admin.form.checkbox name="show_judul" label="Judul" :checked="$hero->show_judul" />
                        <x-admin.form.checkbox name="show_deskripsi" label="Moto / Slogan"
                            :checked="$hero->show_deskripsi" />
                        <x-admin.form.checkbox name="show_button" label="Tombol" :checked="$hero->show_button" />
                    </div>
                </div>

                {{-- Konten Hero --}}
                <div class="space-y-4">
                    <h3 class="text-sm font-bold text-gray-900">Konten Hero</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <x-admin.form.input name="tagline" label="Tagline" :value="$hero->tagline"
                            placeholder="Masukan Tagline" />
                        <x-admin.form.input name="judul" label="Judul" :value="$hero->judul" placeholder="Masukan Judul" />
                    </div>

                    <div>
                        <x-admin.form.textarea name="deskripsi" label="Moto / Slogan"
                            placeholder="Maksimal 2 kalimat atau 3 baris" rows="3"
                            data-hero-slogan="1">{{ trim($hero->deskripsi) }}</x-admin.form.textarea>
                        <p class="text-[11px] text-gray-400 -mt-0.5 sm:-mt-1">Maksimal 2 kalimat atau 3 baris.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <x-admin.form.input name="button_text" label="Teks Tombol" :value="$hero->button_text"
                            placeholder="Masukan Teks Tombol" />
                        <x-admin.form.input name="button_url" label="Link Tombol" :value="$hero->button_url"
                            placeholder="Masukan Link Tombol" />
                    </div>
                </div>
            </form>
        </x-admin.ui.card>
    </div>
@endsection