{{-- ============================================================
NAVBAR - TOMBOL-TOMBOL DI KANAN HEADER (MOBILE OPTIMIZED)
Berisi: Bantuan, Ubah Username, Ubah Password, Keluar
============================================================ --}}
<div
    class="flex flex-nowrap items-center justify-end gap-2 overflow-x-auto whitespace-nowrap [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">

    {{-- Tombol Bantuan (Abu-abu) --}}
    <x-admin.form.button variant="secondary" href="{{ route('admin.bantuan.index') }}">
        <x-slot:icon>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                </path>
            </svg>
        </x-slot:icon>
        <span class="hidden sm:inline">Bantuan</span>
    </x-admin.form.button>

    {{-- Tombol Ubah Username (Hijau) --}}
    <x-admin.form.button variant="primary" href="{{ route('admin.ubah-username.index') }}">
        <x-slot:icon>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
        </x-slot:icon>
        <span class="hidden sm:inline">Ubah Username</span>
    </x-admin.form.button>

    {{-- Tombol Ubah Password (Hijau) --}}
    <x-admin.form.button variant="primary" href="{{ route('admin.ubah-password.index') }}">
        <x-slot:icon>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                </path>
            </svg>
        </x-slot:icon>
        <span class="hidden sm:inline">Ubah Password</span>
    </x-admin.form.button>

    {{-- Tombol Keluar (Merah) --}}
    <x-admin.form.button variant="danger" type="button" id="btn-logout-trigger">
        <x-slot:icon>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                </path>
            </svg>
        </x-slot:icon>
        <span class="hidden sm:inline">Keluar</span>
    </x-admin.form.button>
    <form action="{{ route('admin.logout') }}" method="POST" id="logout-form" class="hidden">
        @csrf
    </form>
</div>