@extends('admin.layouts.admin')

@section('title', 'Ubah Username')

@section('content')
    <div class="max-w-3xl">
        <div class="flex flex-col gap-3 pb-4">
            {{-- Page Header --}}
            <x-admin.ui.page-header title="Ubah Username" subtitle="Ubah username akun administrator Anda">
            </x-admin.ui.page-header>

            {{-- Form Card --}}
            <x-admin.ui.card bodyClass="p-4 sm:p-6">
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-3 sm:px-4 py-2 sm:py-3 rounded relative mb-4 text-[11px] sm:text-sm">
                        <span class="block sm:inline">{{ $errors->first() }}</span>
                    </div>
                @endif

                <form class="space-y-4" method="POST" action="{{ route('admin.ubah-username.update') }}" x-data="{ currentPassword: '' }">
                    @csrf
                    {{-- Current Password --}}
                    <x-admin.form.input type="password" name="current_password" label="Kata Sandi Saat Ini"
                        placeholder="Masukkan kata sandi saat ini untuk verifikasi" required x-model="currentPassword" autocomplete="current-password" />

                    {{-- New Username --}}
                    <div class="space-y-0.5">
                        <x-admin.form.input type="text" name="username" label="Username Baru"
                            placeholder="Masukkan username baru (huruf, angka, underscore, dan dash)" required
                            maxlength="50" pattern="[a-zA-Z0-9_\-]+" x-bind:disabled="currentPassword.trim().length === 0" class="disabled:opacity-50 disabled:cursor-not-allowed" />
                        <p class="text-[10px] sm:text-xs text-slate-900 mt-1">
                            Hanya boleh menggunakan huruf, angka, underscore (_), dan dash (-). Maksimal 50 karakter.
                        </p>
                    </div>

                    {{-- Submit Button --}}
                    <div class="flex items-center justify-end pt-4 border-t border-gray-200">
                        <x-admin.form.button variant="primary" type="submit">
                            Ubah Username
                        </x-admin.form.button>
                    </div>
                </form>
            </x-admin.ui.card>
        </div>
    </div>
@endsection
