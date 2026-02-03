@extends('admin.layouts.admin')

@section('title', 'Visi, Misi, Tujuan')

@section('content')
    <div class="flex flex-col gap-3 max-w-6xl mx-auto pb-4">
        <x-admin.ui.page-header title="Visi, Misi, Tujuan" subtitle="Pengelolaan konten halaman Visi, Misi, Tujuan">
            <x-slot:actions>
                <x-admin.form.button type="submit" variant="primary" form="profile-vision-form">
                    Simpan
                </x-admin.form.button>
            </x-slot:actions>
        </x-admin.ui.page-header>

        <x-admin.ui.card bodyClass="p-4 sm:p-6">
            <form id="profile-vision-form" action="{{ route('admin.profil.vision.update') }}" method="POST" class="space-y-6">
                @csrf
                <x-admin.form.textarea name="visi" label="Visi" placeholder="Masukkan visi sekolah" rows="5">{{ old('visi', $vision?->visi) }}</x-admin.form.textarea>

                <x-admin.form.textarea name="misi" label="Misi" placeholder="Masukkan misi sekolah" rows="8">{{ old('misi', $vision?->misi) }}</x-admin.form.textarea>

                <x-admin.form.textarea name="tujuan" label="Tujuan" placeholder="Masukkan tujuan sekolah" rows="8">{{ old('tujuan', $vision?->tujuan) }}</x-admin.form.textarea>
            </form>
        </x-admin.ui.card>
    </div>
@endsection
