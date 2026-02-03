@extends('admin.layouts.admin')

@section('title', 'Agenda')

@section('content')
    <div class="flex flex-col gap-3" data-page="agenda-list">
        {{-- Header --}}
        <x-admin.ui.page-header title="Agenda" subtitle="Kelola jadwal kegiatan dan agenda sekolah">
            <x-slot:actions>
                @if($agenda->count() > 0)
                    <x-admin.form.button variant="add" href="{{ route('admin.konten.agenda.create') }}" data-action="add-agenda"
                        class="sm:w-24">
                        <x-slot:icon>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </x-slot:icon>
                        Tambah
                    </x-admin.form.button>
                @endif
            </x-slot:actions>
        </x-admin.ui.page-header>

        {{-- main content area --}}
        <x-admin.ui.card data-admin-list="true" data-admin-list-mode="server" bodyClass="p-3 sm:p-4">
            <x-slot:header>
                <div class="flex flex-wrap gap-1.5 sm:gap-2 items-center">
                    {{-- Pencarian --}}
                    <x-admin.form.input-search placeholder="Cari agenda..." name="search" value="{{ request('search') }}"
                        :autocomplete="'off'" />

                    <div class="flex gap-1.5 sm:gap-2">
                        {{-- Dropdown Status --}}
                        <x-admin.form.filter-sort name="status">
                            <option value="">Semua Status</option>
                            <option value="publish" {{ request('status') === 'publish' ? 'selected' : '' }}>Publish</option>
                            <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="nonaktif" {{ request('status') === 'nonaktif' ? 'selected' : '' }}>Nonaktif
                            </option>
                        </x-admin.form.filter-sort>

                        {{-- Dropdown Sort --}}
                        <x-admin.form.filter-sort name="sort">
                            <option value="latest" {{ request('sort', 'latest') === 'latest' ? 'selected' : '' }}>Terbaru
                            </option>
                            <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Terlama</option>
                            <option value="az" {{ request('sort') === 'az' ? 'selected' : '' }}>A-Z</option>
                            <option value="za" {{ request('sort') === 'za' ? 'selected' : '' }}>Z-A</option>
                        </x-admin.form.filter-sort>
                    </div>
                </div>
            </x-slot:header>

            <div id="agenda-list-container">
                @include('admin.partials.content.agenda.list', ['agenda' => $agenda])
            </div>

            <x-slot:footer>
                <div id="agenda-pagination-container">
                    @include('admin.partials.content.agenda.pagination', ['agenda' => $agenda])
                </div>
            </x-slot:footer>
        </x-admin.ui.card>
    </div>
@endsection