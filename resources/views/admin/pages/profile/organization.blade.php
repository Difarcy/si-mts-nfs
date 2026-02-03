@extends('admin.layouts.admin')

@section('title', 'Struktur Organisasi')

@section('content')
    <div class="flex flex-col gap-3 max-w-6xl mx-auto pb-4">
        <x-admin.ui.page-header title="Struktur Organisasi" subtitle="Pengelolaan konten halaman Struktur Organisasi">
            <x-slot:actions>
                <x-admin.form.button type="submit" variant="primary" form="profile-organization-form">
                    Simpan
                </x-admin.form.button>
            </x-slot:actions>
        </x-admin.ui.page-header>

        <x-admin.ui.card bodyClass="p-4 sm:p-6">
            <form id="profile-organization-form" action="{{ route('admin.profil.organization.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <x-admin.form.upload-image
                    name="struktur_organisasi"
                    label="Struktur Organisasi"
                    helperText="PNG, JPG up to 10MB"
                    :existing="$organization?->struktur ? asset('storage/' . $organization->struktur) : null"
                    :existingValue="$organization?->struktur"
                    containerStyle="height: 700px;"
                    objectFit="object-contain" />
            </form>
        </x-admin.ui.card>
    </div>
@endsection
