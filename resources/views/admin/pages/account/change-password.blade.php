@extends('admin.layouts.admin')

@section('title', 'Ubah Password')

@section('content')
    <div class="max-w-3xl">
        <div class="flex flex-col gap-3 pb-4">
            {{-- Page Header --}}
            <x-admin.ui.page-header title="Ubah Password" subtitle="Ubah password akun administrator Anda">
            </x-admin.ui.page-header>

            {{-- Form Card --}}
            <x-admin.ui.card bodyClass="p-4 sm:p-6">
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-3 sm:px-4 py-2 sm:py-3 rounded relative mb-4 text-[11px] sm:text-sm">
                        <span class="block sm:inline">{{ $errors->first() }}</span>
                    </div>
                @endif

                <form class="space-y-4" method="POST" action="{{ route('admin.ubah-password.update') }}" x-data="{ currentPassword: '' }">
                    @csrf
                    {{-- Current Password --}}
                    <x-admin.form.input type="password" name="current_password" label="Kata Sandi Saat Ini"
                        placeholder="Masukkan kata sandi saat ini" required x-model="currentPassword" autocomplete="current-password" />

                    {{-- New Password --}}
                    <x-admin.form.input type="password" name="password" label="Kata Sandi Baru"
                        placeholder="Masukkan kata sandi baru (min. 8 karakter, harus mengandung angka)" required x-bind:disabled="currentPassword.trim().length === 0" class="disabled:opacity-50 disabled:cursor-not-allowed" autocomplete="new-password" />

                    {{-- Confirm Password --}}
                    <x-admin.form.input type="password" name="password_confirmation" label="Konfirmasi Kata Sandi Baru"
                        placeholder="Ulangi kata sandi baru" required x-bind:disabled="currentPassword.trim().length === 0" class="disabled:opacity-50 disabled:cursor-not-allowed" autocomplete="new-password" />

                    {{-- Submit Button --}}
                    <div class="flex items-center justify-end pt-4 border-t border-gray-200">
                        <x-admin.form.button variant="primary" type="submit">
                            Ubah Password
                        </x-admin.form.button>
                    </div>
                </form>
            </x-admin.ui.card>
        </div>
    </div>
@endsection
