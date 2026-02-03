@extends('admin.layouts.admin')

@section('title', 'Kepala Madrasah')

@section('content')
    <div class="flex flex-col gap-3 max-w-6xl mx-auto pb-4">
        <x-admin.ui.page-header title="Kepala Madrasah" subtitle="Pengelolaan konten halaman Kepala Madrasah">
            <x-slot:actions>
                <x-admin.form.button type="submit" variant="primary" form="profile-greeting-form">
                    Simpan
                </x-admin.form.button>
            </x-slot:actions>
        </x-admin.ui.page-header>

        <x-admin.ui.card bodyClass="p-4 sm:p-6">
            <form id="profile-greeting-form" action="{{ route('admin.profil.greeting.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="lg:col-span-2 space-y-5">
                        <x-admin.form.input name="nama" label="Nama" :value="old('nama', $greeting?->nama)" placeholder="Nama Kepala Madrasah" />
                        <x-admin.form.textarea name="sambutan" label="Sambutan" placeholder="Tulis sambutan kepala madrasah" rows="10">{{ old('sambutan', $greeting?->sambutan) }}</x-admin.form.textarea>
                    </div>

                    <div class="lg:col-span-1 space-y-5">
                        <x-admin.form.upload-image
                            name="foto_kepala_madrasah"
                            label="Foto Kepala Madrasah"
                            helperText="PNG, JPG up to 10MB"
                            :existing="$greeting?->foto ? asset('storage/' . $greeting->foto) : null"
                            :existingValue="$greeting?->foto"
                            height="h-[400px]" />
                    </div>
                </div>
            </form>
        </x-admin.ui.card>
    </div>
@endsection
