@extends('admin.layouts.admin')

@section('title', 'Tentang Sekolah')

@section('content')
    <div class="flex flex-col gap-3 max-w-6xl mx-auto pb-4">
        <x-admin.ui.page-header title="Tentang Sekolah" subtitle="Pengelolaan konten halaman Tentang Sekolah">
            <x-slot:actions>
                <x-admin.form.button type="submit" variant="primary" form="profile-about-form">
                    Simpan
                </x-admin.form.button>
            </x-slot:actions>
        </x-admin.ui.page-header>

        <x-admin.ui.card bodyClass="p-4 sm:p-6">
            <form id="profile-about-form" action="{{ route('admin.profil.about.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <x-admin.form.upload-image
                    name="foto_sekolah"
                    label="Foto Sekolah"
                    helperText="PNG, JPG up to 10MB"
                    :existing="$about?->foto ? asset('storage/' . $about->foto) : null"
                    :existingValue="$about?->foto"
                    height="h-[300px] sm:h-[480px]" />

                <x-admin.form.textarea name="deskripsi" label="Deskripsi" placeholder="Masukkan deskripsi tentang sekolah" rows="20">{{ old('deskripsi', $about?->deskripsi) }}</x-admin.form.textarea>

                <x-admin.form.textarea name="sejarah" label="Sejarah" placeholder="Masukkan sejarah sekolah" rows="20">{{ old('sejarah', $about?->sejarah) }}</x-admin.form.textarea>
            </form>
        </x-admin.ui.card>
    </div>
@endsection
