@extends('admin.layouts.admin')

@section('title', 'Kontak')

@section('content')
    <div class="flex flex-col gap-3 pb-4">
        {{-- Page Header --}}
        <x-admin.ui.page-header title="Kontak" subtitle="Kelola informasi kontak dan alamat sekolah">
            <x-slot:actions>
                <x-admin.form.button type="submit" variant="primary" form="kontak-form" class="cursor-not-allowed opacity-50" disabled>
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
            <form id="kontak-form" method="POST" action="{{ route('admin.pengaturan.kontak.update') }}" class="space-y-4">
                @csrf
                {{-- WhatsApp & Email --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-admin.form.input label="Nomor WhatsApp" name="whatsapp" type="tel" placeholder="Masukan Nomor WhatsApp" :value="$kontak->whatsapp ?? ''" inputmode="numeric" pattern="[0-9]+" maxlength="20" oninput="this.value=this.value.replace(/[^0-9]/g,'')" />
                    <x-admin.form.input label="Email" name="email" type="email" placeholder="Masukan Email" :value="$kontak->email ?? ''" />
                </div>

                {{-- Telepon & Koordinat --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <x-admin.form.input label="Nomor Telepon" name="telepon" type="tel" placeholder="Masukan Nomor Telepon" :value="$kontak->telepon ?? ''" inputmode="numeric" pattern="[0-9]+" maxlength="20" oninput="this.value=this.value.replace(/[^0-9]/g,'')" />
                        <p class="text-[10px] sm:text-xs text-gray-400 mt-1">
                            Nomor telepon kantor/sekolah (opsional).
                        </p>
                    </div>
                    <div>
                        <x-admin.form.input label="Koordinat Maps" name="koordinat" placeholder="-7.033700223497851, 107.53694989434773" :value="$kontak->koordinat ?? ''" inputmode="decimal" pattern="-?[0-9]+(\.[0-9]+)?,\s*-?[0-9]+(\.[0-9]+)?" oninput="this.value=this.value.replace(/[^0-9.,\s-]/g,'')" />
                        <p class="text-[10px] sm:text-xs text-slate-900 mt-1">
                            Contoh: -7.025253, 107.519760
                        </p>
                    </div>
                </div>

                {{-- Alamat --}}
                <div class="space-y-1">
                    <x-admin.form.textarea label="Alamat Lengkap" name="alamat" placeholder="Masukan Alamat Lengkap" rows="4">{{ $kontak->alamat ?? '' }}</x-admin.form.textarea>
                </div>

                {{-- Deskripsi Footer --}}
                <div class="space-y-1">
                    <x-admin.form.textarea label="Deskripsi Footer" name="deskripsi" placeholder="Masukan Deskripsi Footer" rows="4">{{ $kontak->deskripsi ?? '' }}</x-admin.form.textarea>
                </div>
            </form>
        </x-admin.ui.card>
    </div>
@endsection
